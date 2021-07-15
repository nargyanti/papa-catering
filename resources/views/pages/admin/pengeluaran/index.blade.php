@extends('layouts.template')

@section('title')
    <div>
        <h2>Daftar Pengeluaran</h2>
    </div>
@endsection

@section('content')

    {{-- Notification --}}
    @include('layouts.messageAlert')

    {{-- header --}}
    <div class="mt-2 mb-4">
        {{-- <h4>Table Pemasukan</h4> --}}
        <div class="col justify-content-end">
            <div class="input-group">
                <a href="{{ route('pengeluaran.create') }}"><button class="btn btn-primary ml-2" type="button"
                        id="button-addon2">Tambah Pengeluaran</button></a>
            </div>
        </div>
        <hr class="hr">
    </div>


    {{-- Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Table Pengeluaran</h2>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Admin</th>
                                <th>Tanggal Pengeluaran</th>
                                <th>Jenis Beban</th>
                                <th>Jenis Pengeluaran</th>
                                <th>Metode Transaksi</th>
                                <th>Foto Bukti</th>
                                <th>Nominal</th>
                                <th>keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1 @endphp
                            @foreach ($pengeluaran as $pengeluaran)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $pengeluaran->nama_lengkap }}</td>
                                    <td>{{ $pengeluaran->tanggal_pengeluaran }}</td>
                                    <td>{{ $pengeluaran->jenis_beban }}</td>
                                    <td>{{ $pengeluaran->jenis_pengeluaran }}</td>
                                    <td>{{ $pengeluaran->metode_transaksi }}</td>
                                    <td>
                                        @if ($pengeluaran->metode_transaksi === 'Cash')
                                            <p>-</p>
                                        @else
                                            @if ($pengeluaran->foto_bukti == null)
                                                <p>Foto bukti belum diunggah</p>
                                            @else
                                                <a href="{{ route('previewPengeluaran', $pengeluaran->id) }}"
                                                    class="btn btn-success">Preview</a>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $pengeluaran->nominal }}</td>
                                    <td>{{ $pengeluaran->keterangan }}</td>
                                    <td>
                                        <a type="button" href="{{ route('pengeluaran.edit', $pengeluaran->id) }}"
                                            class="btn btn-warning"><i class="fa fa-edit" style="color: white"></i></a>
                                        <button type="button" class="btn btn-danger"
                                            data-idpengeluaran="{{ $pengeluaran->id }}" data-toggle="modal"
                                            data-target="#deletePengeluaran"><i class="fa fa-trash"></i></button>
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

                $(this).find('form').attr('action', `{{ route('pengeluaran.destroy', '') }}/${value}`)
            })
        })
    </script>


@endsection
