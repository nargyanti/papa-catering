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
                                <td>Rp {{number_format($rekapData->nominal_pemasukan,0,',','.')}}</td>
                                <td>Rp {{number_format($rekapData->nominal_pengeluaran,0,',','.')}}</td>
                                <td>
                                    @php 
                                        $saldo = $saldo + $rekapData->nominal_pemasukan - $rekapData->nominal_pengeluaran;
                                        echo ('Rp '.number_format($saldo,0,',','.'));
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
    {{-- Modal --}}
    {{-- Modal Delete --}}
    <div class="modal fade" id="deletePengeluaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Hapus Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center"><i class="fas fa-exclamation-circle"
                                style="font-size:100px; color: #e86464"></i></p>
                        <p class="text-center" style="font-size:20px; color: #e86464">
                            Yakin untuk menghapus data ini?
                        </p>

                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#deletePengeluaran').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget)
                const value = button.data('idpengeluaran')

                $(this).find('form').attr('action', `#`)
            })
        })
    </script>
@endsection