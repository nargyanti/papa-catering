@extends('layouts.template')

@section('title')
    <div>
        <h2>Buku Kas</h2>
    </div>
@endsection

@section('content')
{{-- header --}}
    <div class="mt-2 mb-4">
        {{-- <h4>Tabel Rekap Data Bulanan</h4> --}}
       
        <hr class="hr">
    </div>


{{-- Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Bulan @php echo($date); @endphp</h2>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal Pemasukan</th>
                                <th>Tanggal Pengeluaran</th>
                                <th>Nominal Pemasukan</th>
                                <th>Nominal Pengeluaran</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $saldo = 0; @endphp
                            @foreach ($rekapData as $rekapData)
                                <tr>
                                    <td><a href='{{url("/bukukas/{$rekapData->tahun_masuk}/{$rekapData->bulan_masuk}/{$rekapData->hari_masuk}")}}'>{{ $rekapData->tanggal_pemasukan }}</a></td>
                                    <td><a href='{{url("/bukukas/{$rekapData->tahun_keluar}/{$rekapData->bulan_keluar}/{$rekapData->hari_keluar}")}}'>{{ $rekapData->tanggal_pengeluaran }}</a></td>
                                    <td>{{ $rekapData->nominal_masuk }}</td>
                                    <td>{{ $rekapData->nominal_keluar }}</td>
                                    <td>
                                        @php 
                                            $saldo = $saldo + $rekapData->nominal_masuk - $rekapData->nominal_keluar;
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