@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Tambah Data Jadwal</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
      </ol>
    </div>
  </div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <form action="/jadwals/store" method="POST">
            @csrf
            @method('POST')
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="user_id" class="form-label">User_Id</label>
                    <input type="text" name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" value="{{ old('user_id') }}">
                    @error('user_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bulan" class="form-label">Bulan</label>
                    <input type="date" name="bulan" id="bulan" class="form-control @error('bulan') is-invalid @enderror" value="{{ old('bulan') }}">
                    @error('bulan')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tanggal" class="form-label">tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}">
                    @error('tanggal')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="shift" class="form-label">shift</label>
                    <select name="shift" id="shift" class="form-control">
                        <option value=""></option>
                        <option value="Pagi">Pagi</option>
                        <option value="Sore">Sore</option>
                        <option value="Malam">Malam</option>
                      </select>
                </div>
                <div class="form-group">
                    <label for="jam" class="form-label">jam</label>
                    <input type="time" name="jam" id="jam" class="form-control">
                </div>
                <div class="form-group">
                    <label for="posisi" class="form-label">posisi</label>
                    <select name="posisi" id="posisi" class="form-control">
                        <option value=""></option>
                        <option value="IT Support">IT Support</option>
                        <option value="Staff IT">Staff IT</option>
                        <option value="CEO-Chief Executive Officer">CEO-Chief Executive Officer</option>
                        <option value="CFO-Chief Financial Officer">CFO-Chief Financial Officer</option>
                        <option value="COO-Chief Operating Officer">COO-Chief Operating Officer</option>
                        <option value="Manager">Manager</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Leader">Leader</option>
                        <option value="Admin">Admin</option>
                        <option value="Karyawan">Karyawan</option>
                        <option value="Front-end Developer">Front-end Developer</option>
                        <option value="Back-end Developer">Back-end Developer</option>
                      </select>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="/jadwals" class="btn btn-sm btn-outline-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
