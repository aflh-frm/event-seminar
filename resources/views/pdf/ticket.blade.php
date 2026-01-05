<!DOCTYPE html>
<html>

<head>
    <title>E-Ticket EventPro</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            border: 2px dashed #333;
            padding: 20px;
        }

        .header {
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
        }

        .event-title {
            font-size: 28px;
            margin: 10px 0;
            color: #111;
        }

        .info {
            margin-bottom: 20px;
            font-size: 16px;
            color: #555;
        }

        .qr-placeholder {
            background: #eee;
            width: 150px;
            height: 150px;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        }

        .footer {
            font-size: 12px;
            color: #888;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">EventPro E-Ticket</div>
        <p>Kode Booking: #TRX-{{ $transaction->id }}</p>
    </div>

    <h1 class="event-title">{{ $transaction->event->title }}</h1>

    <div class="info">
        <p><strong>Nama Peserta:</strong> {{ $transaction->user->name }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaction->event->event_date)->format('d F Y') }}</p>
        <p><strong>Lokasi:</strong> {{ $transaction->event->location }}</p>
        <p><strong>Harga:</strong> Rp {{ number_format($transaction->event->price, 0, ',', '.') }}</p>
    </div>

    <div class="qr-placeholder">
        [QR CODE AREA]
    </div>

    <div class="footer">
        <p>Tunjukkan tiket ini di lokasi acara.</p>
        <p>&copy; EventPro System</p>
    </div>
</body>

</html>