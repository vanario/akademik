@extends('template')

@section('title', 'Dashboard')

@section('page-title', 'Kelas')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Kelas</h3>
                        <button type="button" class="btn btn-primary pull-right"  data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Tambah Kelas</button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">                    
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th></th>
                            </tr>
                            @foreach($classes as $class)
                            <tr>
                                <td>{{ $class->id }}</td>
                                <td>{{ $class->nama }}</td>
                                <td>{{ $class->keterangan }}</td>
                                <td>{{ $class->created_at }}</td>
                                <td>{{ $class->updated_at }}</td>
                                <td><a href="" class="btn btn-success" data-toggle="modal" data-target="#edit{{$class->id}}">Edit</a> <a href="" class="btn btn-info">Detail</a> </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="POST" action="" >
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h4>Tambah Kelas</h4>
                                </div>
                                <div class="modal-body">                                       
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" name="nama" id="nama" class="form-control input-sm" required>
                                    </div>    
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Enter ..."></textarea>
                                    </div>    
                                </div>
                                <div class="modal-footer">
                                    <div>
                                         <input type="submit"  value="Simpan" class="btn btn-subscribe" >
                                    </div>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
                @foreach($classes as $class)
                    <div class="modal fade" id="edit{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="put" action="{{ url('class',$class->id) }}" >
                                    {{-- {{ csrf_field() }} --}}
                                    <div class="modal-header">
                                        <h4>Tambah Kelas</h4>
                                    </div>
                                    <div class="modal-body">                                       
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <input type="text" value="{{ $class->nama }}" name="nama" id="nama" class="form-control input-sm" required>
                                        </div>    
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Enter ...">{{ $class->keterangan }}</textarea>
                                        </div>    
                                    </div>
                                    <div class="modal-footer">
                                        <div>
                                             <input type="submit"  value="Simpan" class="btn btn-subscribe" >
                                        </div>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
