<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat TOEFL</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .certificate { border: 10px solid #000; padding: 20px; width: 80%; margin: auto; }
        h1 { font-size: 30px; }
        p { font-size: 20px; }
        .signature { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <div class="certificate">
        <h1>SERTIFIKAT TOEFL</h1>
        <p>Diberikan kepada</p>
        <h2>{{ $nilai->pendaftaran->nama }}</h2>
        <p>Telah mengikuti tes TOEFL dengan skor total <strong>{{ $nilai->total_nilai }}</strong> pada tanggal {{ $nilai->tanggal_test }}.</p>
        <div class="signature">
            <p><strong>Pusat Bahasa Universitas Malikussaleh</strong></p>
            <p>__________________________</p>
        </div>
    </div>
</body>
</html>
