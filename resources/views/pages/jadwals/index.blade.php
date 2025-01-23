@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Data Jadwal</h1>
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
        <div class="card">
            <div class="card-header">
                <a href="/jadwals/create" class="btn btn-primary">
                    Tambah Data
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>User_Id</th>
                            <th>Bulan</th>
                            <th>Tanggal</th>
                            <th>Shift</th>
                            <th>Jam</th>
                            <th>Posisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwals as $jadwal)
                        <tr class="text-center">
                            <td>{{ $jadwal->user_id }}</td>
                            <td>{{ $jadwal->bulan }}</td>
                            <td>{{ $jadwal->tanggal }}</td>
                            <td>{{ $jadwal->shift }}</td>
                            <td>{{ $jadwal->jam }}</td>
                            <td>{{ $jadwal->posisi }}</td>
                            <td class="text-center">
                                <div class="d-flex center-button">
                                <a href="/jadwals/edit/{{ $jadwal->id }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                                <form action="/jadwals/{{ $jadwal->id }}" method="POST">
                                    @csrf
                                    @method('UPDATE')
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection
