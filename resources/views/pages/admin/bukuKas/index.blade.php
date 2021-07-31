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
                                $no = 1;
                            @endphp
                            @foreach ($pengeluaran as $pengeluaran)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $pengeluaran->nama_lengkap }}</td>
                                    <td>{{ $pengeluaran->tanggal_pengeluaran }}</td>
                                    <td>{{ $pengeluaran->jenis_beban }}</td>
                                    <td>{{ $pengeluaran->jenis_pengeluaran }}</td>
                                    <td>{{ $pengeluaran->metode_transaksi }}</td>
                                    <td>
                            @endforeach
                            <!-- <tr>
                                <td><a href="{{ route('bukukas.rekapTahunan', 2021)}}">2021</a></td>
                                <td>225000</td>
                                <td>25000</td>
                                <td>300000</td>
                            </tr>
                            <tr>
                                <td><a href="#">2020</a></td>
                                <td>125000</td>
                                <td>50000</td>
                                <td>375000</td>
                            </tr>
                            <tr>
                                <td><a href="#">2019</a></td>
                                <td>250000</td>
                                <td>200000</td>
                                <td>425000</td>
                            </tr>
                            <tr>
                                <td><a href="#">2018</a></td>
                                <td>300000</td>
                                <td>100000</td>
                                <td>625000</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection