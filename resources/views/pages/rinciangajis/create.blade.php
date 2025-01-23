@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Tambah Data Gaji</h1>
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
        <form action="/rinciangajis/store" method="POST">
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
                    <input type="number" name="bulan" id="bulan" class="form-control @error('bulan') is-invalid @enderror" value="{{ old('bulan') }}">
                    @error('bulan')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" name="tahun" id="tahun" min="1900" max="{{ date('Y') }}"  class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun') }}">
                    @error('tahun')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                    <input type="number" name="gaji_pokok" id="gaji_pokok" step="0.01" class="form-control calculate" required>
                </div>
                <div class="form-group">
                    <label for="tunjangan_paket_internet" class="form-label">Tunjangan Paket Internet</label>
                    <input type="number" name="tunjangan_paket_internet" id="tunjangan_paket_internet" step="0.01" class="form-control calculate" required>
                </div>
                <div class="form-group">
                    <label for="tunjangan_transportasi" class="form-label">Tunjangan Transportasi</label>
                    <input type="number" name="tunjangan_transportasi" id="tunjangan_transportasi" step="0.01" class="form-control calculate" required>
                </div>
                <div class="form-group">
                    <label for="tunjangan_bpjs" class="form-label">Tunjangan Bpjs</label>
                    <input type="number" name="tunjangan_bpjs" id="tunjangan_bpjs" step="0.01" class="form-control calculate" required>
                </div>
                <div class="form-group">
                    <label for="tunjangan_uang_makan" class="form-label">Tunjangan Uang Makan</label>
                    <input type="number" name="tunjangan_uang_makan" id="tunjangan_uang_makan" step="0.01" class="form-control calculate" required>
                </div>
                <div class="form-group">
                    <label for="total_penghasilan_bruto" class="form-label">Total Penghasilan Bruto</label>
                    <input type="number" name="total_penghasilan_bruto" id="total_penghasilan_bruto" step="0.01" class="form-control" readonly>
                </div>
                  <div class="form-group">
                    <label for="jaminan_hari_tua" class="form-label">Jaminan Hari Tua</label>
                    <input type="number" name="jaminan_hari_tua" id="jaminan_hari_tua" step="0.01" class="form-control calculate" required>
                </div>
                <div class="form-group">
                    <label for="jaminan_pensiun" class="form-label">Jaminan_pensiun</label>
                    <input type="number" name="jaminan_pensiun" id="jaminan_pensiun" step="0.01" class="form-control calculate" required>
                </div>
                <div class="form-group">
                    <label for="total_bruto" class="form-label">Total Bruto</label>
                    <input type="number" name="total_bruto" id="total_bruto" step="0.01" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="total_diterima" class="form-label">Total Diterima</label>
                    <input type="number" name="total_diterima" id="total_diterima" step="0.01" class="form-control" readonly>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="/rinciangajis" class="btn btn-sm btn-outline-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<script>
    function hitungTotal() {
        const gajipokok = parseFloat(document.getElemenById('gaji_pokok').value) || 0;
        const tunjanganpaketinternet = parseFloat(document.getElementById('tunjangan_paket_internet').value) || 0;
        const tunjangantransportasi  = parseFloat(document.getElementById('tunjangan_transportasi').value) || 0;
        const tunjanganbpjs = parseFloat(document.getElementById('tunjangan_bpjs').value) || 0;
        const tunjanganuangmakan = parseFloat(document.getElementById('tunjangan_uang_makan').value) || 0;
        const jaminanharitua = parseFloat(document.getElementById('jaminan_hari_tua').value) || 0;
        const jaminanpensiun = parseFloat(document.getElementById('jaminan_pensiun').value) || 0;

        // Hitung total penghasilan bruto
        const totalpenghasilanbruto = gajipokok + tunjanganpaketinternet + tunjangantransportasi + tunjanganbpjs + tunjanganuangmakan;
        document.getElementById('total_penghasilan_bruto').value = totalpenghasilanbruto.toFixed(2);

        // Hitung total bruto
        const totalbruto = jaminanharitua + jaminanpensiun;
        document.getElementById('total_bruto').value = totalbruto.toFixed(2);

        // Hitung total diterima
        const totalditerima = totalpenghasilanbruto - totalbruto;
        document.getElementById('total_diterima').value = totalditerima.toFixed(2);
    }
</script>

@endsection
