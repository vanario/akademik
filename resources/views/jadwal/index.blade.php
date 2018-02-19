@extends('template')

@section('title', 'List Jadwal')
@section('page-title', 'Jadwal')
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
                                <th>Kelas</th>
                                <th>NIP</th>
                                <th>Guru</th>
                                <th>Mata Pelajaran</th>
                                <th>Hari / Jam</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = $schedules->firstItem();?>
                            @if($schedules->count())  
                                @foreach($schedules as $val)  
                                <tr>
                                    <td>{{ $no++}}</td>
                                    <td>{{ $val->kelas->nama or "-"}}</td>
                                    <td>{{ $val->guru->nip or "-" }}</td>
                                    <td>{{ $val->guru->nama_depan or "-" }} {{ $val->guru->nama_belakang or "-" }}</td>
                                    <td>{{ $val->mapel->nama or "-"}}</td>
                                    <td>{{ $val->hari or "-"}}, {{ $val->jam or "-"}}</td>
                                    <td>{{ $val->keterangan or "-"}}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#edit{{$val->id}}"><span class="fa fa-pencil"></span></a>      
                                        <a href="{{ action('Jadwal\JadwalController@destroy',$val->id) }}" id="hapus" ><i class="fa fa-trash"></i></a>
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
                {{$schedules->render()}}
            </div>
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('jadwal.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Jadwal</h4>
                        </div>
                        <div class="modal-body"> 
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select  name="kelas_id" class="form-control" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach($kelas as $id => $nama)
                                        <option value="{{ $id }}">{{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Guru</label>
                                <input type="text" name="guru_id" id="guru_id" class="form-control" autocomplete="off" required>
                                <input type="hidden" name="guru_id" id="userValue" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Mata Pelajaran</label>
                                <select  name="mapel_id" class="form-control" required>
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach($mapel as $id => $nama)
                                        <option value="{{$id}}">{{$nama}}</option>
                                    @endforeach
                                </select>
                            </div>                            
                            <div class="form-group">
                                <label for="">Jam</label>
                                <input type="text" name="jam" id="jam" class="form-control input-sm" required>
                            </div>                          
                            <div class="form-group">
                                <label for="">Hari</label>
                                <select  name="hari" class="form-control" required>
                                    <option value="">Pilih Hari</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div> 
                            {{-- <div class="form-group">
                                <label for="">Semester</label>
                                <select  name="semester_id" class="form-control" required>
                                    <option value="">Pilih Semester</option>
                                    @foreach($semesters as $id => $semester)
                                        <option value="{{$id}}">{{$semester}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="">Tahun Ajar</label>
                                <select  name="tahun_ajaran_id" class="form-control" required>
                                    <option value="">Pilih Tahun Ajar</option>
                                    @foreach($tahunajar as $id => $tahun_ajaran)
                                        <option value="{{$id}}">{{$tahun_ajaran}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control input-sm" required>
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

        @foreach($schedules as $val)
        <div class="modal fade" id="edit{{ $val->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('jadwal.update',$val->id) }}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Jadwal Guru : {{ $val->guru->nama_depan }} {{ $val->guru->nama_belakang }}</h4>
                        </div>
                        <div class="modal-body">
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
                                <label for="">Mata Pelajaran</label>
                                <select  name="mapel_id" class="form-control" required>
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach($mapel as $id => $nama)
                                        <option value="{{ $id }}" {{old('id',$id)==$val->mapel_id? 'selected':''}}>{{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Jam</label>
                                <input type="text" name="jam" value="{{ $val->jam }}" id="jam" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Hari</label>
                                <select  name="hari" class="form-control" required>
                                    <option value="">Pilih Hari</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div> 
                            {{-- <div class="form-group">
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
                            </div> --}}
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" name="keterangan" value="{{ $val->keterangan }}" id="keterangan" class="form-control input-sm" required>
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
            $("#userValue").val(item.value);
        }
        $('#guru_id').typeahead({
            source: [
                @foreach($guru as $value)
                    { id: {{ $value['id'] }}, name: '{{ $value['nama_depan'] }} {{ $value['nama_belakang'] }}' },
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
        $('#guru_id2').typeahead({
            source: [
                @foreach($guru as $value)
                    { id: {{ $value['id'] }}, name: '{{ $value['nama_depan'] }} {{ $value['nama_belakang'] }}' },
                @endforeach
            ],
            onSelect: displayResult
        });
    });

</script>

@endsection



