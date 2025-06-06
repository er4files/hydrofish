@extends('layouts.app')

@section('content')
<div class="main scrollable">
    <div class="topbar">
        <div class="toggle">
            <ion-icon name="menu-outline"></ion-icon>
        </div>
    </div>

    @if (session('message'))
        <div class="alert">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ url('/setting/jadwal') }}" method="POST" class="settingBox">
        @csrf
        <div class="setting-card">
            <div class="setting-title">
                <h4>Jadwal Pakan</h4>
            </div>
            <div class="setting-content">
                <label for="jadwal_pagi">Jadwal Pagi:</label>
<input type="time" id="jadwal_pagi" name="jadwal_pagi" 
    value="{{ old('jadwal_pagi', $jadwalPakan['pagi'] ?? '') }}">

<label for="jadwal_sore">Jadwal Sore:</label>
<input type="time" id="jadwal_sore" name="jadwal_sore" 
    value="{{ old('jadwal_sore', $jadwalPakan['sore'] ?? '') }}">

<label for="jadwal_malam">Jadwal Malam:</label>
<input type="time" id="jadwal_malem" name="jadwal_malem" 
    value="{{ old('jadwal_malem', $jadwalPakan['malem'] ?? '') }}">

<label for="jumlah_takar">Jumlah Takar:</label>
<input type="number" id="jumlah_takar" name="jumlah_takar" min="1" 
    value="{{ old('jumlah_takar', $jadwalPakan['jumlah_takar'] ?? 1) }}">
            </div>
            <button type="submit" class="saveButton">Simpan Jadwal</button>
        </div>
    </form>
</div>
@endsection
