<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran TOEFL Berhasil</title>
</head>
<body>
    <h2>Halo, {{ $user->name }}</h2>
    <p>Terima kasih telah mendaftar untuk tes TOEFL.</p>
    <p>Berikut adalah detail pendaftaran Anda:</p>
    <ul>
        <li><strong>Nama:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Tanggal Tes:</strong> {{ $jadwal->tanggal }}</li>
        <li><strong>Lokasi:</strong> {{ $jadwal->lokasi }}</li>
    </ul>
    <p>Silakan lakukan pembayaran melalui Midtrans.</p>
    <p>Terima kasih!</p>
</body>
</html>
