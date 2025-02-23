<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Ujian TOEFL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }

        .admission-card {
            width: 10cm;
            padding: 1.5cm;
            margin: 20px auto;
            border: 2px solid #1e40af;
            border-radius: 8px;
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #1e40af;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            color: #1e40af;
            margin: 0;
            margin-bottom: 5px;
        }

        .details {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .participant-info {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .schedule-info {
            margin-bottom: 15px;
        }

        .location {
            margin-top: 15px;
            font-weight: bold;
        }

        .registration-number {
            font-family: monospace;
            font-size: 18px;
            font-weight: bold;
            color: #1e40af;
            margin: 10px 0;
        }

        @page {
            size: auto;
            margin: 0;
        }
    </style>
</head>
<body>

    @if(isset($pendaftaran) && $pendaftaran->jadwal)
    <div class="admission-card">
        <div class="header">
            <h1 class="title">TOEFL Prediction Test</h1>
        </div>

        <div class="details">
            <div class="participant-info">
                <div>Nama: <strong>{{ $pendaftaran->user->name ?? 'Tidak Diketahui' }}</strong></div>
                <div class="registration-number">No: {{ $pendaftaran->id_pendaftaran }}</div>
            </div>

            <div class="schedule-info">
                <div>{{ \Carbon\Carbon::parse($pendaftaran->jadwal->tanggal_test)->locale('id')->isoFormat('dddd, D MMMM Y') }}</div>
                <div>{{ $pendaftaran->jadwal->jam_test }} - Selesai WIB</div>
                <div class="location">{{ $pendaftaran->jadwal->lokasi }}</div>                                      
            </div>

            <div style="font-size: 14px; margin-top: 20px; color: #666;">
                * Harap membawa kartu ini dan KTP saat test
            </div>
        </div>
    </div>
    @else
    <div style="text-align: center; margin: 20px; color: red;">
        <p>Data pendaftaran tidak ditemukan atau belum tersedia.</p>
    </div>
    @endif

    <div class="no-print" style="text-align: center; margin: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #1e40af; color: white; border: none; border-radius: 4px; cursor: pointer;">
            <i class="fas fa-print"></i> Cetak Kartu
        </button>
    </div>

</body>
</html>
