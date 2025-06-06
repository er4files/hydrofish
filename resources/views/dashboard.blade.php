@extends('layouts.app')

@section('content')
<div class="main scrollable">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>

        <div class="conditionBox">
            <div class="condition">
                <div>
                    <div class="output" id="tdsOutput">{{ $conditions->tds ?? 'N/A' }} ppm</div>

                    <div class="conditionName">TDS Sensor</div>
                </div>
                <div class="iconBox">
                    <ion-icon name="water-outline"></ion-icon>
                </div>
            </div>

            <div class="condition">
                <div>
                    <div class="output" id="turbidityOutput">{{ $conditions->turbidity ?? 'N/A' }} NTU</div>
                    <div class="conditionName">Turbidity Sensor</div>
                </div>
                <div class="iconBox">
                    <ion-icon name="eye-outline"></ion-icon>
                </div>
            </div>

            <div class="condition">
                <div>
                    <div class="output" id="phOutput">{{ $conditions->ph_air ?? 'N/A' }} pH</div>
                    <div class="conditionName">pH Sensor</div>
                </div>
                <div class="iconBox">
                    <ion-icon name="flask-outline"></ion-icon>
                </div>
            </div>

            <div class="condition">
                <div>
                    <div class="output" id="suhuOutput">{{ $conditions->suhu_air ?? 'N/A' }} °C</div>
                    <div class="conditionName">Suhu Air (DS18B20)</div>
                </div>
                <div class="iconBox">
                    <ion-icon name="thermometer-outline"></ion-icon>
                </div>
            </div>

            <div class="condition">
                <div>
                    <div class="output" id="tinggiOutput">{{ $conditions->tinggi_air ?? 'N/A' }} cm</div>
                    <div class="conditionName">Tinggi Air Kolam</div>
                </div>
                <div class="iconBox">
                    <ion-icon name="speedometer-outline"></ion-icon>
                </div>
            </div>

            <div class="condition">
                <div>
                    <div class="output" id="pakanOutput">
                        {{ $conditions->status_pakan == true ? 'ON' : 'OFF' }}
                    </div>
                    <div class="conditionName">Status Pakan Ikan</div>
                </div>
                <div class="iconBox">
                    <ion-icon name="fish-outline"></ion-icon>
                </div>
            </div>
    </div>
</div>
</div>
<script>
    function updateDashboard() {
        fetch('/dashboard-data')
            .then(response => response.json())
            .then(data => {
                document.getElementById('tdsOutput').innerText = data.tds + ' ppm';
                document.getElementById('turbidityOutput').innerText = data.turbidity;
                document.getElementById('phOutput').innerText = data.ph_air + ' pH';
                document.getElementById('suhuOutput').innerText = data.suhu_air + ' °C';
                document.getElementById('tinggiOutput').innerText = data.tinggi_air + ' cm';
                document.getElementById('pakanOutput').innerText = data.status_pakan ? 'ON' : 'OFF';
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Panggil pertama kali saat halaman load
    updateDashboard();
    // Ulangi setiap 5 detik
    setInterval(updateDashboard, 1000);
</script>

@endsection
