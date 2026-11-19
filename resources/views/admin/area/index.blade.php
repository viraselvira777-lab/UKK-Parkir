```blade
@extends('layouts.app')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h3>Data Area</h3>

<a href="{{ route('admin.area.create') }}" class="btn btn-primary mb-3">
    + Tambah Area
</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nama Area</th>
            <th>Kapasitas</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($areas as $i => $item)
        <tr>
            <td>{{ $areas->firstItem() + $i }}</td>
            <td>{{ $item->nama_area }}</td>
            <td>{{ $item->kapasitas }}</td>

            <td>
                <a href="{{ route('admin.area.edit', $item->id_area) }}"
                   class="btn btn-sm btn-warning">
                    Edit
                </a>

                <form action="{{ route('admin.area.destroy', $item->id_area) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Yakin hapus area ini?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-sm btn-danger">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $areas->links() }}

@endsection