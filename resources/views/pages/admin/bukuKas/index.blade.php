@extends('layouts.template')

@section('title')
    <div>
        <h2>Buku Kas</h2>
    </div>
@endsection

@section('content')
{{-- header --}}
    <div class="mt-2 mb-4">
        {{-- <h4>Tabel Rekapitulasi Data</h4> --}}
       
        <hr class="hr">
    </div>


{{-- Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Rekap Semua Data</h2>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tahun Pemasukan</th>
                                <th>Tahun Pengeluaran</th>
                                <th>Nominal Pemasukan</th>
                                <th>Nominal Pengeluaran</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $saldo = 0;
                            @endphp
                            @foreach ($rekapData as $rekapData)
                                <tr>
                                    <td><a href='{{url("/bukukas/{$rekapData->tahun_masuk}")}}'>{{ $rekapData->tahun_masuk }}</a></td>
                                    <td><a href='{{url("/bukukas/{$rekapData->tahun_keluar}")}}'>{{ $rekapData->tahun_keluar }}</a></td>
                                    <td>Rp {{number_format($rekapData->nominal_masuk,0,',','.')}}</td>
                                    <td>Rp {{number_format($rekapData->nominal_keluar,0,',','.')}}</td>
                                    <td>
                                        @php 
                                            $saldo = $saldo + $rekapData->nominal_masuk - $rekapData->nominal_keluar;
                                            echo ('Rp '.number_format($saldo,0,',','.'));
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection