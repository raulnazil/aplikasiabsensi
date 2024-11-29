@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Ubah Data</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
        <li class="breadcrumb-item active">Karyawan</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <form action="{{ route('absensis.update', $absensi->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Laravel membutuhkan ini untuk mendukung metode PUT -->
            <div class="card">
                <div class="card-body">
                <div class="form-group">
                <label for="user_id" class="form-label">User_Id</label>
                <input type="text" name="user_id" id="user_id" class="form-control" value="{{ $absensi->user_id }}" required>
            </div>
                <div class="form-group">
                <label for="bulan" class="form-label">Bulan</label>
                <input type="date" name="bulan" id="bulan" class="form-control" value="{{ $absensi->bulan }}" required>
            </div>
                <div class="form-group">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $absensi->tanggal }}" required>
            </div>
                <div class="form-group">
                <label for="shift" class="form-label">Shift</label>
                <input type="text" name="shift" id="shift" class="form-control" value="{{ $absensi->shift }}" required>
            </div>
                <div class="form-group">
                <label for="jam" class="form-label">Jam</label>
                <input type="time" name="jam" id="jam" class="form-control" value="{{ $absensi->jam }}" required>
            </div>
                 <div class="form-group">
                <label for="posisi" class="form-label">Posisi</label>
                <input type="text" name="posisi" id="posisi" class="form-control" value="{{ $absensi->posisi }}" required>
            </div>
            <div class="card-footer">
            <div class="d-flex justify-content-end">
            <a href="/absensis" class="btn btn-sm btn-outline-secondary mr-2">Batal</a>
            <button type="submit" class="btn btn-sm btn-warning">Edit</button>
    </div>
    </div>
    </div>
</div>
</form>
</div>
</div>
@endsection
