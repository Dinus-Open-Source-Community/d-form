<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Recruitment DOSCOM</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #4A90E2; padding-bottom: 10px; }
        .header h1 { margin: 0; color: #4A90E2; }
        .header p { margin: 5px 0; color: #666; }
        .summary { background: #f8f9fa; padding: 15px; margin: 20px 0; border-radius: 5px; }
        .summary-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
        .summary-item { text-align: center; }
        .summary-item .number { font-size: 18px; font-weight: bold; color: #4A90E2; }
        .summary-item .label { font-size: 10px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #4A90E2; color: white; font-weight: bold; }
        .status-approved { background-color: #d4edda; color: #155724; }
        .status-rejected { background-color: #f8d7da; color: #721c24; }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #666; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>DATA RECRUITMENT DOSCOM</h1>
        <p>Developer Student Community</p>
        <p>Generated: {{ $generatedAt->format('d F Y, H:i') }} WIB</p>
        @if($exportType !== 'all')
            <p>Filter: {{ ucfirst($exportType) }}</p>
        @endif
    </div>

    <div class="summary">
        <h3>Ringkasan Data</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="number">{{ $statistics['total'] }}</div>
                <div class="label">Total Pendaftar</div>
            </div>
            <div class="summary-item">
                <div class="number">{{ $statistics['approved'] }}</div>
                <div class="label">Diterima</div>
            </div>
            <div class="summary-item">
                <div class="number">{{ $statistics['pending'] }}</div>
                <div class="label">Menunggu Review</div>
            </div>
            <div class="summary-item">
                <div class="number">{{ $statistics['rejected'] }}</div>
                <div class="label">Ditolak</div>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Lengkap</th>
                <th>NIM</th>
                <th>Divisi</th>
                <th>Status</th>
                <th>Reviewer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recruitments as $index => $recruitment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $recruitment->created_at->format('d/m/Y') }}</td>
                <td>{{ $recruitment->nama_lengkap }}</td>
                <td>{{ $recruitment->nim }}</td>
                <td>{{ $recruitment->divisi_utama }}</td>
                <td class="status-{{ $recruitment->status }}">
                    {{ match($recruitment->status) {
                        'approved' => 'DITERIMA',
                        'rejected' => 'DITOLAK',
                        'pending' => 'MENUNGGU',
                        default => strtoupper($recruitment->status)
                    } }}
                </td>
                <td>{{ $recruitment->reviewer?->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini dibuat secara otomatis oleh sistem DOSCOM</p>
        <p>© {{ date('Y') }} DOSCOM - Developer Student Community</p>
    </div>
</body>
</html>
