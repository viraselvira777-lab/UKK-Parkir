
@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Catat Kendaraan Masuk</h3>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('petugas.transaksi.prosesMasuk') }}" method="POST">
        @csrf

        {{-- Kendaraan --}}
        <div class="mb-3">
            <label class="form-label">Kendaraan</label>

            <select name="id_kendaraan" id="kendaraan"
                class="form-select" required>
                <option value="">-- Pilih Kendaraan --</option>

                @foreach($kendaraan as $k)
                    <option value="{{ $k->id_kendaraan }}"
                        data-jenis="{{ $k->jenis_kendaraan }}"
                        {{ old('id_kendaraan') == $k->id_kendaraan ? 'selected' : '' }}>
                        {{ $k->plat_nomor }} - {{ $k->pemilik }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tarif Otomatis --}}
        <div class="mb-3">
            <label class="form-label">Tarif</label>

            <input type="text" id="tarif"
                class="form-control"
                placeholder="Tarif otomatis muncul"
                readonly>
        </div>

        {{-- Area Parkir --}}
        <div class="mb-3">
            <label class="form-label">Area Parkir</label>

            <select name="id_area" class="form-select" required>
                <option value="">-- Pilih Area Parkir --</option>

                @foreach($areas as $area)
                    <option value="{{ $area->id_area }}"
                        {{ old('id_area') == $area->id_area ? 'selected' : '' }}>
                        {{ $area->nama_area }}
                        ({{ $area->terisi }}/{{ $area->kapasitas }})
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>
    </form>
</div>

<script>
    const kendaraanSelect = document.getElementById('kendaraan');
    const tarifInput = document.getElementById('tarif');

    const daftarTarif = @json($tarifs->map(function($t) {
        return [
            'jenis' => $t->jenis_kendaraan,
            'harga' => $t->tarif_per_jam
        ];
    })->values());

    function tampilkanTarif() {
        const selected = kendaraanSelect.options[
            kendaraanSelect.selectedIndex
        ];

        const jenis = selected.dataset.jenis;

        if (!jenis) {
            tarifInput.value = '';
            return;
        }

        const tarif = daftarTarif.find(t =>
            t.jenis.toLowerCase() === jenis.toLowerCase()
        );

        if (tarif) {
            tarifInput.value = 'Rp' +
                Number(tarif.harga).toLocaleString('id-ID') +
                '/jam';
        } else {
            tarifInput.value = 'Tarif belum tersedia';
        }
    }

    kendaraanSelect.addEventListener('change', tampilkanTarif);

    tampilkanTarif();
</script>
@endsection
