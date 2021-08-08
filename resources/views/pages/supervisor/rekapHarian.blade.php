@extends('layouts.template')

@section('title')
    <div>
        <h2>Buku Kas</h2>
    </div>
@endsection

@section('content')
{{-- header --}}
    <div class="mt-2 mb-4">
        {{-- <h4>Tabel Rekap Harian</h4> --}}
       
        <hr class="hr">
    </div>


{{-- Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Tanggal @php echo($date); @endphp </h2>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Pemasukan</th>
                                <th>ID Pengeluaran</th>
                                <th>Nominal Pemasukan</th>
                                <th>Nominal Pengeluaran</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; $saldo = 0; @endphp
                            @foreach ($rekapData as $rekapData)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $rekapData->id_pemasukan }}</td>
                                    <td>{{ $rekapData->id_pengeluaran }}</td>
                                    <td>{{ $rekapData->nominal_pemasukan }}</td>
                                    <td>{{ $rekapData->nominal_pengeluaran }}</td>
                                    <td>
                                        @php 
                                            if($rekapData->nominal_pemasukan == 0){
                                                $saldo = $saldo - $rekapData->nominal_pengeluaran;
                                            } else if($rekapData->nominal_pengeluaran == 0){
                                                $saldo = $saldo + $rekapData->nominal_pemasukan;
                                            }
                                            echo $saldo;
                                        @endphp
                                    </td>
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