@extends('layouts.main')

@section('contents')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">* Data Poli Rumah Sakit Trust Medika</h1>
                </div>
                <div class="col-sm-3">

                </div>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid">
        <!-- div row utama-->
        <div class="row">
            <div class="col-md-12">
                @if (\Session::has('alert-success'))
                <div class="alert alert-success">
                    <div>{{ Session::get('alert-success') }}</div>
                </div>
                @endif
                <div class="card card-primary  card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="form-inline col-md-9">
                                <h5 class="mt-1 ml-2"> Data Poli</h5>
                            </div>
                            <div class="col-md-3 float-right">
                                <a href="#}}" id="btnTambah" data-toggle="modal" data-target="#addData" class="btn btn-primary float-lg-right"><i class="fa fa-money-check mr-2" aria-hidden="true"></i>
                                    Tambah Data
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Poli</th>
                                            <th>Nama Poli</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($poli as $p)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$p->unit_kode}}</td>
                                            <td>{{$p->unit_nama}}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="#}}" data-toggle="modal" data-target="#editData{{$p->unit_id}}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$p->unit_id}}" href="#}}">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal Untuk Mengedit Data -->
@foreach ($poli as $p)
<div class="modal fade" id="editData{{$p->unit_id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Data Poli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('poli.edit')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama Poli </label>
                        <div class="col-sm-6">
                            <input required type="text" class="form-control" name="unit_nama" value="{{$p->unit_nama}}">
                            <input type="text" value="{{$p->unit_id}}" name="unit_id" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Kode Poli </label>
                        <div class="col-sm-6">
                            <input required type="text" class="form-control" name="unit_kode" value="{{$p->unit_kode}}">
                        </div>
                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach
<!-- End Modal Mengedit Data -->

<!-- Modal Untuk Mengapus Data -->
@foreach ($poli as $p)
<div id="delete{{ $p->unit_id }}" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <form action="{{ route('poli.delete') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Apakah Anda Yakin?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda Yakin untuk menghapus ini?.</p>
                    <input type="hidden" name="unit_id" value="{{ $p->unit_id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- End Modal -->

<!-- Modal Untuk Nambah Data -->
<div class="modal fade" id="addData">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Poli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('poli.add')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama Poli </label>
                        <div class="col-sm-6">
                            <input required type="text" class="form-control" name="unit_nama">
                            <input type="text" value="{{$p->unit_id}}" name="unit_id" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Kode Poli </label>
                        <div class="col-sm-6">
                            <input required type="text" class="form-control" name="unit_kode">
                        </div>
                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- End Modal Nambah Data -->
@endsection

@section('bottomscript')
<!-- Data Tabel -->
<script>
    var table = $('#example1').DataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": false
    });
</script>

@endsection