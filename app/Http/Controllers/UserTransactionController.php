<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class UserTransactionController extends Controller
{
    // 1. Menampilkan History Transaksi / Tiket Saya
    public function index()
    {
        // Ambil transaksi milik user yang sedang login
        // Kita gunakan 'with' untuk mengambil data event terkait sekaligus (Eager Loading)
        $transactions = Transaction::with('event')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.transactions.index', compact('transactions'));
    }

    // 2. Proses Booking / Daftar Event
    public function store($eventId)
    {
        $event = Event::findOrFail($eventId);
        $userId = Auth::id();

        // VALIDASI A: Cek apakah user sudah pernah daftar event ini?
        $existingTransaction = Transaction::where('user_id', $userId)
            ->where('event_id', $eventId)
            ->first();

        if ($existingTransaction) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar di event ini!');
        }

        // VALIDASI B: Cek kuota event (Opsional, tapi penting)
        // Kita hitung jumlah peserta yang statusnya TIDAK rejected
        $currentParticipants = Transaction::where('event_id', $eventId)
            ->where('status', '!=', 'rejected')
            ->count();

        if ($currentParticipants >= $event->quota) {
            return redirect()->back()->with('error', 'Maaf, kuota event ini sudah penuh.');
        }

        // LOGIKA STATUS:
        // Jika harga 0 (Gratis) -> status 'confirmed' (Langsung masuk)
        // Jika berbayar -> status 'pending' (Menunggu pembayaran)
        $status = ($event->price == 0) ? 'confirmed' : 'pending';

        // Simpan Transaksi
        Transaction::create([
            'user_id' => $userId,
            'event_id' => $eventId,
            'status' => $status,
            'payment_proof' => null, // Belum upload bukti
        ]);

        return redirect()->route('user.transactions.index')
            ->with('success', 'Berhasil mendaftar! Silakan cek status tiket Anda.');
    }
    // 3. Menampilkan Halaman Pembayaran
    public function showPayment($id)
    {
        $transaction = Transaction::with(['event.user.banks'])->findOrFail($id);

        // Keamanan: Pastikan transaksi ini milik user yang sedang login
        if ($transaction->user_id != Auth::id()) {
            abort(403);
        }

        // Ambil daftar rekening milik EO penyelenggara event ini
        // Event -> User (EO) -> Banks
        $banks = $transaction->event->user->banks;

        return view('user.transactions.payment', compact('transaction', 'banks'));
    }

    // 4. Proses Upload Bukti Bayar
    public function uploadProof(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // Upload File
        if ($request->hasFile('payment_proof')) {
            // Hapus bukti lama jika ada (untuk replace)
            if ($transaction->payment_proof) {
                Storage::disk('public')->delete($transaction->payment_proof);
            }

            $path = $request->file('payment_proof')->store('payment_proofs', 'public');

            $transaction->update([
                'payment_proof' => $path,
                // Status tetap 'pending' sampai diapprove EO, 
                // tapi kita tahu dia sudah upload karena kolom payment_proof terisi.
            ]);
        }

        return redirect()->route('user.transactions.index')
            ->with('success', 'Bukti pembayaran berhasil diupload! Tunggu konfirmasi panitia.');
    }
    public function downloadTicket($id)
    {
        $transaction = Transaction::with(['event', 'user'])->findOrFail($id);

        // Keamanan: Cek pemilik transaksi
        if ($transaction->user_id != Auth::id()) {
            abort(403);
        }

        // Keamanan: Tiket hanya bisa didownload jika status 'confirmed'
        if ($transaction->status != 'confirmed') {
            return redirect()->back()->with('error', 'Tiket belum tersedia. Tunggu konfirmasi panitia.');
        }

        // Generate PDF
        $pdf = Pdf::loadView('pdf.ticket', compact('transaction'));

        // Download file dengan nama unik
        return $pdf->download('Tiket_EventPro_' . $transaction->event->id . '_' . rand(1000, 9999) . '.pdf');
    }
}