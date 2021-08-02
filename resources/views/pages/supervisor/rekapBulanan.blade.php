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
                                <th>Tanggal</th>
                                <th>Pemasukan</th>
                                <th>Pengeluaran</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $saldo = 0; @endphp
                            @foreach ($pemasukan as $pemasukan)
                                <tr>
                                    <td><a href='{{url("/rekapData/{$pemasukan->tahun_bayar}/{$pemasukan->bulan_bayar}/{$pemasukan->hari_bayar}")}}'>{{ $pemasukan->tanggal_bayar }}</a></td>
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
                                    <td><a href='{{url("/rekapData/{$pengeluaran->tahun_keluar}/{$pengeluaran->bulan_keluar}/{$pengeluaran->hari_keluar}")}}'>{{ $pengeluaran->tanggal_pengeluaran }}</a></td>
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