@extends('layouts.app')
@section('content')
@if (session('gagal'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-times"></i> Gagal!</h5>
            {{ session('gagal') }}
          </div>
    @endif
@if (session('sukses'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
            {{ session('sukses') }}
          </div>
    @endif
          <h2>{{$detail->nama_grup}} - {{$detail->nama_mapel}}</h2>
    <table class="table table-striped">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Total</th>
        </tr>
        <?php $no=1; ?>
        @foreach ($data as $d)
            <tr>
                <td>{{$no++}}</td>
            <td>{{$d->name}}</td>
            <td>{{$d->plus - $d->minus}}</td>
             </tr>
        @endforeach
    </table>
@endsection