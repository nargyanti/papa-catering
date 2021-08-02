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
                                <th>Tahun</th>
                                <th>Pemasukan</th>
                                <th>Pengeluaran</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 0;
                                $saldo = 0;
                            @endphp
                            @foreach ($pemasukan as $pemasukan)
                                <tr>
                                    <td><a href="{{ route('rekapData.rekapTahunan', $pemasukan->tahun_bayar)}}">{{ $pemasukan->tahun_bayar }}</a></td>
                                    <td>{{ $pemasukan->nominal }}</td>
                                    <td>-</td>
                                    <td>
                                        @php 
                                            $saldo = $saldo + $pemasukan->nominal;
                                            echo $saldo;
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($pengeluaran as $pengeluaran)
                                <tr>
                                    <td><a href="{{ route('rekapData.rekapTahunan', $pengeluaran->tahun_keluar )}}">{{ $pengeluaran->tahun_keluar }}</a></td>
                                    <td>-</td>
                                    <td>{{ $pengeluaran->nominal }}</td>
                                    <td>
                                        @php 
                                            $saldo = $saldo - $pengeluaran->nominal;
                                            echo $saldo;
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