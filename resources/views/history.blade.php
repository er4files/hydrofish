@extends('layouts.app')

@section('content')
<div class="main scrollable">
    <div class="topbar">
        <div class="toggle">
            <ion-icon name="menu-outline"></ion-icon>
        </div>
    </div>

    <div class="tableBox">
        <!-- Grafik Data Sensor -->
        <div class="table-card">
            <h3 class="table-title">Grafik Data Sensor</h3>
            <div class="chart-container" style="position: relative; height:400px;">
                <canvas id="sensorChart"></canvas>
            </div>
        </div>

        <!-- Riwayat Data Sensor -->
        <div class="table-card">
            <h3 class="table-title">Riwayat Data Sensor</h3>
            <div class="table-wrapper">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>TDS (ppm)</th>
                            <th>Turbidity</th>
                            <th>pH Air</th>
                            <th>Suhu Air (°C)</th>
                            <th>Tinggi Air (cm)</th>
                        </tr>
                    </thead>
                    <tbody>
                       @forelse ($sensorLogs as $log)
    @if(is_array($log) && isset($log['timestamp']))
        <tr>
            <td>{{ \Carbon\Carbon::parse($log['timestamp'])->format('d-m-Y H:i') }}</td>
            <td>{{ $log['tds'] ?? '-' }}</td>
            <td>{{ $log['turbidity'] ?? '-' }}</td>
            <td>{{ $log['ph_air'] ?? '-' }}</td>
            <td>{{ $log['suhu_air'] ?? '-' }}</td>
            <td>{{ $log['tinggi_air'] ?? '-' }}</td>
        </tr>
    @else
        <tr><td colspan="6">Data sensor tidak valid</td></tr>
    @endif
@empty
    <tr><td colspan="6">Tidak ada data sensor.</td></tr>
@endforelse

                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                <div class="pagination-left">
                    @if ($sensorLogs->onFirstPage())
                        <span class="disabled">Previous</span>
                    @else
                        <a href="{{ $sensorLogs->previousPageUrl() }}">Previous</a>
                    @endif
                </div>
                <div class="pagination-center">
                    <span class="page-info">
                        Page {{ $sensorLogs->currentPage() }} of {{ $sensorLogs->lastPage() }}
                    </span>
                </div>
                <div class="pagination-right">
                    @if ($sensorLogs->hasMorePages())
                        <a href="{{ $sensorLogs->nextPageUrl() }}">Next</a>
                    @else
                        <span class="disabled">Next</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.7/dayjs.min.js"></script>

<script>
    // Data sensorLogs yang sudah dipaginasi dan valid
    const sensorLogs = @json($sensorLogs->items());

    // Filter data valid
    const validLogs = sensorLogs.filter(log => log && log.timestamp);

    // Buat array label dan dataset dari data yang ada
    const labels = validLogs.map(log => dayjs(log.timestamp).format('HH:mm'));
    const tdsData = validLogs.map(log => log.tds ?? null);
    const phData = validLogs.map(log => log.ph_air ?? null);
    const suhuData = validLogs.map(log => log.suhu_air ?? null);
    const tinggiData = validLogs.map(log => log.tinggi_air ?? null);

    // Balik array agar grafik dari data terbaru ke lama (opsional)
    labels.reverse();
    tdsData.reverse();
    phData.reverse();
    suhuData.reverse();
    tinggiData.reverse();

    const ctx = document.getElementById('sensorChart').getContext('2d');
    const sensorChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'TDS (ppm)',
                    data: tdsData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    fill: true,
                    tension: 0.3
                },
                {
                    label: 'pH Air',
                    data: phData,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    fill: true,
                    tension: 0.3
                },
                {
                    label: 'Suhu Air (°C)',
                    data: suhuData,
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.1)',
                    fill: true,
                    tension: 0.3
                },
                {
                    label: 'Tinggi Air (cm)',
                    data: tinggiData,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.1)',
                    fill: true,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: { display: true, text: 'Waktu' }
                },
                y: {
                    title: { display: true, text: 'Nilai Sensor' },
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

@endsection
