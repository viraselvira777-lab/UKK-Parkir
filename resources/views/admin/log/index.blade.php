@extends('layouts.app') 
@section('content') 
<h3>Log Aktivitas</h3> 
<table class="table table-bordered"> 
    <thead> 
        <tr><th>#</th><th>User</th><th>Aktivitas</th><th>Waktu</th></tr> 
    </thead> 
    <tbody> 
        @foreach($logs as $i => $log) 
        <tr> 
            <td>{{ $logs->firstItem() + $i }}</td> 
            <td>{{ $log->user->nama_lengkap ?? '-' }}</td> 
            <td>{{ $log->aktivitas }}</td> 
            <td>{{ \Carbon\Carbon::parse($log->waktu_aktivitas)->format('d-m-Y H:i') }}</td> 
        </tr> 
        @endforeach 
    </tbody> 
</table> 
{{ $logs->links() }} 
@endsection 