<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .detail {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #007BFF;
            color: white;
            text-align: left;
        }
        .total-row {
            background-color: #dff0d8;
            font-weight: bold;
        }
        .total-row td {
            font-size: 16px;
            color: #000000;
        }
        .footer {
            margin-bottom: 20px;
            text-align: center;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="header">
    <h1>Rincian Gaji</h1>
    </div>
    @foreach ( $rinciangaji as $rinciangaji)
    <div class="detail">
        <p><strong>Nama_jabatan:</strong>{{ $rinciangaji->nama_jabatan }}</p>
        <p><strong>User ID:</strong>{{ $rinciangaji->user_id }}</p>
        <p><strong>Bulan:</strong>{{ $rinciangaji->bulan }}</p>
        <p><strong>Tahun:</strong>{{ $rinciangaji->tahun }}</p>
    </div>
    <table>
        <tr>
            <th>Keterangan</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td>Gaji Pokok</td>
            <td>{{ number_format(($rinciangaji->gaji_pokok), 3, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Tunjangan Paket Internet</td>
            <td>{{ number_format(($rinciangaji->tunjangan_paket_internet), 3, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Tunjangan Transportasi</td>
            <td>{{ number_format(($rinciangaji->tunjangan_transportasi), 3, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Tunjangan BPJS</td>
            <td>{{ number_format(($rinciangaji->tunjangan_bpjs), 3, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Tunjangan Uang Makan</td>
            <td>{{ number_format(($rinciangaji->tunjangan_uang_makan), 3, ',', '.') }}</td>
        </tr>
        <tr class="total-row">
            <td><strong>Total Penghasilan Bruto</strong></td>
            <td><strong>{{ number_format(($rinciangaji->total_penghasilan_bruto), 3, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td>Jaminan Hari Tua</td>
            <td>{{ number_format(($rinciangaji->jaminan_hari_tua), 3, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Jaminan Pensiun</td>
            <td>{{ number_format(($rinciangaji->jaminan_pensiun), 3, ',', '.') }}</td>
        </tr>
        <tr class="total-row">
            <td><strong>Total Bruto</strong></td>
            <td><strong>{{ number_format(($rinciangaji->total_bruto), 3, ',', '.') }}</strong></td>
        </tr>
        <tr class="total-row">
            <td><strong>Total Diterima</strong></td>
            <td><strong>{{ number_format(($rinciangaji->total_diterima), 3, ',', '.') }}</strong></td>
        </tr>
    </table>
    @endforeach
    <div class="footer"></div>
    <p>terimakasih atas kerja anda di perusahaan ini</p>
</body>
</html>
