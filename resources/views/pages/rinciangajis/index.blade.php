@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Data Rincian Gaji</h1>
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
                <a href="/rinciangajis/create" class="btn btn-primary">
                    Tambah Data
                </a>
                <a href="{{ route('rincian_gaji.pdf') }}" class="btn btn-secondary">
                    <i class="fas fa-print"></i> Cetak PDF
                </a>
            </div>
            <div class="card-body table responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>User_Id</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan Paket Internet</th>
                            <th>Tunjangan Transportasi</th>
                            <th>Tunjangan Bpjs</th>
                            <th>Tunjangan Uang Makan</th>
                            <th>Total Penghasilan Bruto</th>
                            <th>Jaminan Hari Tua</th>
                            <th>Jaminan Pensiun</th>
                            <th>Total Bruto</th>
                            <th>Total Diterima</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rinciangaji as $rinciangaji)
                        <tr class="text-center">
                            <td>{{ $rinciangaji->user_id }}</td>
                            <td>{{ $rinciangaji->bulan }}</td>
                            <td>{{ $rinciangaji->tahun }}</td>
                            <td>{{ $rinciangaji->gaji_pokok }}</td>
                            <td>{{ $rinciangaji->tunjangan_paket_internet }}</td>
                            <td>{{ $rinciangaji->tunjangan_transportasi }}</td>
                            <td>{{ $rinciangaji->tunjangan_bpjs }}</td>
                            <td>{{ $rinciangaji->tunjangan_uang_makan }}</td>
                            <td>{{ $rinciangaji->total_penghasilan_bruto }}</td>
                            <td>{{ $rinciangaji->jaminan_hari_tua }}</td>
                            <td>{{ $rinciangaji->jaminan_pensiun }}</td>
                            <td>{{ $rinciangaji->total_bruto }}</td>
                            <td>{{ $rinciangaji->total_diterima }}</td>
                            <td class="text-center">
                                <a href="/rinciangajis/edit/{{ $rinciangaji->id }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                                <form action="/rinciangajis/{{ $rinciangaji->id }}" method="POST">
                                    @csrf
                                    @method('UPDATE')
                                    @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger mr-2">Hapus</button>
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
