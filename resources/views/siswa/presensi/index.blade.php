@extends('template')

@section('title', 'List Presensi')
@section('page-title', 'Input Presensi Siswa')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">

                <a data-toggle="modal" data-target="#add" class="btn bg-purple " font-16" style="margin-bottom:30px;">Tambah</a>

                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Siswa</th>
                                <th>Alpa</th>
                                <th>Sakit</th>
                                <th>Izin</th>
                                <th>Keterangan</th>
                                <th>Kelas</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = $data->firstItem();?>
                            @if($data->count())  
                            @foreach($data as $val)  
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>{{ $val->siswa->nama_depan or "-"}}</td>
                                <td>{{ $val->alpa or "-"}}</td>
                                <td>{{ $val->sakit or "-"}}</td>
                                <td>{{ $val->izin or "-"}}</td>
                                <td>{{ $val->keterangan or "-"}}</td>
                                <td>{{ $val->kelas->nama or "-"}}</td>
                                <td>{{ $val->semester->semester or "-"}}</td>
                                <td>{{ $val->tahun_ajaran->tahun_ajaran or "-"}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val->id}}"><span class="fa fa-pencil"></span></a>      
                                    <a href="{{action('Siswa\PresensiController@destroy',$val->id)}}" id="hapus" ><i class="fa fa-trash"></i></a>
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
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('presensi.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Presensi</h4>
                        </div>
                        <div class="modal-body">                                       
                            <div class="form-group">
                                <label for="">Nama </label>
                                <input type="text" name="siswa_id" id="siswa_id" class="form-control" autocomplete="off" required>
                                <input type="hidden" name="siswa_id" id="siswaValue" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Alpa</label>
                                <input type="text" name="alpa" id="alpa" class="form-control input-sm" >
                            </div>
                            <div class="form-group">
                                <label for="">Sakit</label>
                                <input type="text" name="sakit" id="sakit" class="form-control input-sm" >
                            </div>
                            <div class="form-group">
                                <label for="">Izin</label>
                                <input type="text" name="izin" id="izin" class="form-control input-sm" >
                            </div>  
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control input-sm" >
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
                    <form method="POST" action="{{ route('presensi.update',$val->id) }}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Presensi</h4>
                        </div>
                        <div class="modal-body">                                         
                            <div class="form-group">
                                <label for="">Nama </label>
                                <input type="text" value="{{ $val->siswa->nama_depan or "-" }}" name="siswa_id" id="siswa_id2" class="form-control" autocomplete="off" required>
                                <input type="hidden" value="{{ $val->siswa_id }}" name="siswa_id2" id="siswaValue2" class="form-control">
                            </div>                            
                            <div class="form-group">
                                <label for="">Alpa</label>
                                <input type="text" value="{{ $val->alpa }}" name="alpa" id="alpa" class="form-control input-sm" >
                            </div>
                            <div class="form-group">
                                <label for="">Sakit</label>
                                <input type="text" value="{{ $val->sakit }}" name="sakit" id="sakit" class="form-control input-sm" >
                            </div>
                            <div class="form-group">
                                <label for="">Izin</label>
                                <input type="text" value="{{ $val->izin }}" name="izin" id="izin" class="form-control input-sm" r>
                            </div>  
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" name="keterangan" value="{{ $val->ketarangan }}" id="keterangan" class="form-control input-sm" >
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
                                        <option value="{{ $id }}" {{old('id',$id)==$val->semeseter_id? 'selected':''}}>{{ $semester }}</option>
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
                    { id: {{ $value['id'] }}, name: '{{ $value['nama_depan'] }}' },
                @endforeach
            ],
            onSelect: displayResult
        });
    });

</script>

<script type="text/javascript">
    $(function() {
        function displayResult(item) {            
            $("#siswaValue2").val(item.value);
        }
        $('#siswa_id2').typeahead({
            source: [
                @foreach($siswa as $value)
                    { id: {{ $value['id'] }}, name: '{{ $value['nama_depan'] }}' },
                @endforeach
            ],
            onSelect: displayResult
        });
    });

</script>

@endsection
