@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Ubah Data Jadwal</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
        <li class="breadcrumb-item active">Data Jadwal</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <form action="{{ route('jadwals.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Laravel membutuhkan ini untuk mendukung metode PUT -->
            <div class="card">
                <div class="card-body">
                <div class="form-group">
                <label for="user_id" class="form-label">User_Id</label>
                <input type="text" name="user_id" id="user_id" class="form-control" value="{{ $jadwal->user_id }}" required>
            </div>
                <div class="form-group">
                <label for="bulan" class="form-label">Bulan</label>
                <input type="date" name="bulan" id="bulan" class="form-control" value="{{ $jadwal->bulan }}" required>
            </div>
                <div class="form-group">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $jadwal->tanggal }}" required>
            </div>
                <div class="form-group">
                <label for="shift" class="form-label">Shift</label>
                <input type="text" name="shift" id="shift" class="form-control" value="{{ $jadwal->shift }}" required>
            </div>
                <div class="form-group">
                <label for="jam" class="form-label">Jam</label>
                <input type="time" name="jam" id="jam" class="form-control" value="{{ $jadwal->jam }}" required>
            </div>
                 <div class="form-group">
                <label for="posisi" class="form-label">Posisi</label>
                <input type="text" name="posisi" id="posisi" class="form-control" value="{{ $jadwal->posisi }}" required>
            </div>
            <div class="card-footer">
            <div class="d-flex justify-content-end">
            <a href="/jadwals" class="btn btn-sm btn-outline-secondary mr-2">Batal</a>
            <button type="submit" class="btn btn-sm btn-warning">Edit</button>
    </div>
    </div>
    </div>
</div>
</form>
</div>
</div>


<script>
document.getElementById('btnEdit').addEventListener('click', function(e) {
e.preventDefault(); // mencegah tombol mengirim form langsung
Swal.fire({
 title: 'Konfirmasi Edit?',
 text: "Apakah Anda Yakin Akan Mengedit Data Ini.",
 icon: 'warning',
 showCancelButton: true,
 confirmButtonColor: '#3085d6',
 cancelButtonColor: '#d33',
 confirmButtonText: 'Ya, edit',
 cancelButtonText: 'Batal'

}).then(result) => {
    if (result.isConfirmed) {
        document.getElementById('editForm').submit();
}
});
});
</script>
@endsection
