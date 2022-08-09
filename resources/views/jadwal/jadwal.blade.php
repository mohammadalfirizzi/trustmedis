@extends('layouts.main')

@section('contents')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">* Data Jadwal Dokter Rumah Sakit Trust Medika</h1>
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
                                <h5 class="mt-1 ml-2"> Data Jadwal Dokter</h5>
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
                                            <th>Nama Dokter</th>
                                            <th>Nama Poli</th>
                                            <th>Hari</th>
                                            <th>Jadwal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwalFull as $jd)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$jd->pegawai_nama}}</td>
                                            <td>{{$jd->unit_nama}}</td>
                                            <td>{{$jd->hari_nama}}</td>
                                            <td>{{$jd->jadwal_mulai}} - {{$jd->jadwal_selesai}}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="#}}" data-toggle="modal" data-target="#editData{{$jd->jadwal_id}}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$jd->jadwal_id}}" href="#}}">
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

                <div class="card card-primary  card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="form-inline col-md-9">
                                <h5 class="mt-1 ml-2"> Data Jadwal Dokter</h5>
                            </div>
                            <!-- <div class="col-md-3 float-right">
                                <a href="#}}" id="btnTambah" data-toggle="modal" data-target="#addData" class="btn btn-primary float-lg-right"><i class="fa fa-money-check mr-2" aria-hidden="true"></i>
                                    Tambah Data
                                </a>
                            </div> -->
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Klinik</th>
                                            @foreach ($hari as $h)
                                            <th>{{$h->hari_nama}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwal as $j)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$j->unit_nama}}</td>
                                            @foreach ($hari as $h)
                                            <td></td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>{{$j->pegawai_nama}}</td>
                                            @foreach ($hari as $h)
                                            <td>@if ($h->hari_id == $j->jadwal_hari_id)
                                                {{$j->jadwal_mulai}} - {{$j->jadwal_selesai}}
                                                @endif
                                            </td>
                                            @endforeach
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


<!-- Modal Edit Data -->
@foreach ($jadwalFull as $jd)
<div class="modal fade" id="editData{{$jd->jadwal_id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Data Jadwal Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('jadwal.edit')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama Dokter </label>
                        <div class="col-sm-6">
                            <select required name="jadwal_dokter_id" class="form-control" id="exampleSelectBorder">
                                @foreach ($dokter as $d)
                                <option value="{{$d->pegawai_id}}" {{ ($jd->jadwal_dokter_id == $d->pegawai_id) ? 'selected' : ''   }}>{{$d->pegawai_nama}}</option>
                                @endforeach
                            </select>
                            <input type="text" name="jadwal_id" value="{{$jd->jadwal_id}}" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama Poli </label>
                        <div class="col-sm-6">
                            <select required name="jadwal_unit_id" class="form-control" id="exampleSelectBorder">
                                @foreach ($poli as $p)
                                <option value="{{$p->unit_id}}" {{($jd->jadwal_unit_id == $p->unit_id) ? 'selected' : ''  }}>{{$p->unit_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Hari Praktik </label>
                        <div class="col-sm-6">
                            <select required name="jadwal_hari_id" class="form-control" id="exampleSelectBorder">
                                @foreach ($hari as $h)
                                <option value="{{$h->hari_id}}" {{($jd->jadwal_hari_id == $h->hari_id) ? 'selected' : ''  }}>{{$h->hari_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Jadwal Buka </label>
                        <div class="col-sm-6">
                            <input type="time" name="jadwal_mulai" class="form-control" value="{{$jd->jadwal_mulai}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Jadwal Selesai </label>
                        <div class="col-sm-6">
                            <input type="time" name="jadwal_selesai" class="form-control" value="{{$jd->jadwal_selesai}}">
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
<!-- End Modal Edit Data -->

<!-- Modal Delete Data -->
@foreach ($jadwalFull as $jd)
<div id="delete{{ $jd->jadwal_id }}" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <form action="{{ route('jadwal.delete') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Apakah Anda Yakin?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda Yakin untuk menghapus ini?.</p>
                    <input type="hidden" name="jadwal_id" value="{{ $jd->jadwal_id }}">
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
<!-- End Modal Edit Data -->


<!-- Modal Untuk Nambah Data -->
<div class="modal fade" id="addData">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Jadwal Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('jadwal.add')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama Dokter </label>
                        <div class="col-sm-6">
                            <select required name="jadwal_dokter_id" class="form-control" id="exampleSelectBorder">
                                @foreach ($dokter as $d)
                                <option value="{{$d->pegawai_id}}">{{$d->pegawai_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama Poli </label>
                        <div class="col-sm-6">
                            <select required name="jadwal_unit_id" class="form-control" id="exampleSelectBorder">
                                @foreach ($poli as $p)
                                <option value="{{$p->unit_id}}">{{$p->unit_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Hari Praktik </label>
                        <div class="col-sm-6">
                            <select required name="jadwal_hari_id" class="form-control" id="exampleSelectBorder">
                                @foreach ($hari as $h)
                                <option value="{{$h->hari_id}}">{{$h->hari_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Jadwal Buka </label>
                        <div class="col-sm-6">
                            <input type="time" name="jadwal_mulai" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Jadwal Selesai </label>
                        <div class="col-sm-6">
                            <input type="time" name="jadwal_selesai" class="form-control">
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
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "bAutoWidth": false
    });
    var table = $('#example2').DataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "bAutoWidth": false,
        "ordering": false,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
</script>

@endsection