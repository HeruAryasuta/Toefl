<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Nilai TOEFL</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h3 style="text-align: center;">Daftar Nilai TOEFL - {{ $tanggal_test }}</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Listening</th>
                <th>Structure</th>
                <th>Reading</th>
                <th>Total Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilai as $index => $n)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $n->listening }}</td>
                <td>{{ $n->structure }}</td>
                <td>{{ $n->reading }}</td>
                <td>{{ $n->total_nilai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
