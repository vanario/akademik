@extends('template')

@section('title', 'List Ekstrakurikuler')
@section('page-title', 'Input Ekstrakurikuler Siswa')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <a data-toggle="modal" data-target="#add" class="btn bg-purple " font-16" style="margin-bottom:30px;">Tambah</a>
                <form method="POST" action="{{ url('ekstrak') }}">
                    {{ csrf_field() }}
                    <div class="report-list">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="user_id" id="user_id2" class="form-control" placeholder="Nama" autocomplete="off">
                                    <input type="hidden" name="user_id2" id="userValue2" class="form-control">
                                </div>
                            </div>                            
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">Kelas</label>
                                    <select  name="kelas_id" class="form-control">
                                        <option value="">Pilih Kelas</option>
                                        @foreach($kelas as $id => $nama)
                                            <option value="{{$id}}">{{$nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">Semester</label>
                                    <select  name="semester_id" class="form-control">
                                        <option value="">Pilih Semester</option>
                                        @foreach($semesters as $id => $semester)
                                            <option value="{{$id}}">{{$semester}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">Tahun Ajar</label>
                                    <select  name="tahun_ajaran_id" class="form-control">
                                        <option value="">Pilih Tahun Ajar</option>
                                        @foreach($tahunajar as $id => $tahun_ajaran)
                                            <option value="{{$id}}">{{$tahun_ajaran}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">Aksi</label>
                                    <button type="submit" class="btn btn-green btn-block">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="box-list" style="margin-top: 20px;">

                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Ekstrak</th>
                                <th>Nis</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Nama Ekstra</th>
                                <th>Nilai</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Ket</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = $data->firstItem();?>
                            @if($data->count())  
                            @foreach($data as $val)  
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>{{ $val->kode_ekstrak or "-"}}</td>
                                <td>{{ $val->nis or "-"}}</td>
                                <td>{{ $val->siswa->name or "-"}}</td>
                                <td>{{ $val->kelas->nama or "-"}}</td>
                                <td>{{ $val->nama_ekstrak or "-"}}</td>
                                <td>{{ $val->nilai or "-"}}</td>
                                <td>{{ $val->semesters->semester or "-"}}</td>
                                <td>{{ $val->tahun_ajaran->tahun_ajaran or "-"}}</td>
                                <td>{{ $val->keterangan or "-"}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val->id}}"><span class="fa fa-pencil"></span></a>      
                                    <a href="{{action('Siswa\EkstrakurikulerController@destroy',$val->id)}}" id="hapus" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">No Records found !!</td>
                                    </tr>
                                @endif
                        </tbody>
                    </table>
                {{$data->render()}}
            
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('ekstrak.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Ekstrakurikuler</h4>
                        </div>
                        <div class="modal-body">                                       
                            <div class="form-group">
                                <label for="">Nis</label>
                                <input type="text" name="nis" id="nis" class="form-control input-sm" >
                            </div>
                            <div class="form-group">
                                <label for="">Nama </label>
                                <input type="text" name="siswa_id" id="siswa_id" class="form-control" autocomplete="off" required>
                                <input type="hidden" name="siswa_id" id="siswaValue" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Kode Ekstrakurikuler</label>
                                <input type="text" name="kode_ekstrak" id="kode_ekstrak" class="form-control input-sm" >
                            </div>
                            <div class="form-group">
                                <label for="">Nama Ekstrak</label>
                                <input type="text" name="nama_ekstrak" id="nama_ekstrak" class="form-control input-sm" >
                            </div>
                            <div class="form-group">
                                <label for="">Nilai</label>
                                <input type="text" name="nilai" id="nilai" class="form-control input-sm" >
                            </div>  
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select  name="kelas_id" class="form-control" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach($kelas as $id => $nama)
                                        <option value="{{$id}}">{{$nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Semester</label>
                                <select  name="semester_id" class="form-control" required>
                                    <option value="">Pilih Semester</option>
                                    @foreach($semesters as $id => $semester)
                                        <option value="{{$id}}">{{$semester}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tahun Ajar</label>
                                <select  name="tahun_ajaran_id" class="form-control" required>
                                    <option value="">Pilih Tahun Ajar</option>
                                    @foreach($tahunajar as $id => $tahun_ajaran)
                                        <option value="{{$id}}">{{$tahun_ajaran}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control input-sm" >
                            </div>                                                       
                        </div>
                        <div class="modal-footer">
                            <div>
                                 <input type="submit" value="Simpan" class="btn btn-subscribe" >
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>      

        @foreach($data as $val)
        <div class="modal fade" id="edit{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('ekstrak.update',$val->id) }}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Ekstrakurikuler</h4>
                        </div>
                        <div class="modal-body">   
                            <div class="form-group">
                                <label for="">Nis</label>
                                <input type="text" value="{{ $val->nis }}"  name="nis" id="nis" class="form-control input-sm" >
                            </div>
                            <div class="form-group">
                                <label for="">Kode Ekstrakurikuler</label>
                                <input type="text" value="{{ $val->kode_ekstrak }}" 
                                name="kode_ekstrak" id="kode_ekstrak" class="form-control input-sm" >
                            </div>
                            <div class="form-group">
                                <label for="">Nama Ekstrak</label>
                                <input type="text" value="{{ $val->nama_ekstrak }}" name="nama_ekstrak" id="nama_ekstrak" class="form-control input-sm" >
                            </div>
                            <div class="form-group">
                                <label for="">Nilai</label>
                                <input type="text" value="{{ $val->nilai }}" name="nilai" id="nilai" class="form-control input-sm" >
                            </div>  
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select  name="kelas_id" class="form-control" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach($kelas as $id => $nama)
                                        <option value="{{ $id }}" {{old('id',$id)==$val->kelas_id? 'selected':''}}>{{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Semester</label>
                                <select  name="semester_id" class="form-control" required>
                                    <option value="">Pilih Semester</option>
                                    @foreach($semesters as $id => $semester)
                                        <option value="{{ $id }}" {{old('id',$id)==$val->semester_id? 'selected':''}}>{{ $semester }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tahun Ajar</label>
                                <select  name="tahun_ajaran_id" class="form-control" required>
                                    <option value="">Pilih Tahun Ajar</option>
                                    @foreach($tahunajar as $id => $tahun_ajaran)
                                        <option value="{{ $id }}" {{old('id',$id)==$val->tahun_ajaran_id? 'selected':''}}>{{ $tahun_ajaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" name="keterangan" value="{{ $val->keterangan }}" id="keterangan" class="form-control input-sm" >
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
    </section>
</div>

@endsection

@section('script')

@include('sweet::alert')
<script src="{{ asset('adminlte/bower_components/bootstrap-typeahead.js') }}"></script>  
<script src="{{ asset('adminlte/bower_components/jquery.mockjax.js') }}"></script>  
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">
    $(function() {
        function displayResult(item) {            
            $("#siswaValue").val(item.value);
        }
        $('#siswa_id').typeahead({
            source: [
                @foreach($siswa as $value)
                    { id: {{ $value['id'] }}, name: '{{ $value['name'] }}' },
                @endforeach
            ],
            onSelect: displayResult
        });
    });

</script>

<script type="text/javascript">
    $(function() {
        function displayResult(item) {            
            $("#userValue2").val(item.value);
        }
        $('#user_id2').typeahead({
            source: [
                @foreach($siswa as $value)
                    { id: {{ $value['id'] }}, name: '{{ $value['name'] }}' },
                @endforeach
            ],
            onSelect: displayResult
        });
    });

</script>

@endsection
