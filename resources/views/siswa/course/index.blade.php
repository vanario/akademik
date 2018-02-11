@extends('template')

@section('title', 'List Mata Pelajaran Siswa')
@section('page-title', 'Input Mata Pelajaran Siswa')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <a data-toggle="modal" data-target="#add" class="btn bg-purple " font-16" style="margin-bottom:30px;">Tambah</a>

                 <form method="POST" action="{{ url('course') }}">
                    {{ csrf_field() }}
                    <div class="report-list">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="user_id" id="user_id2" class="form-control" placeholder="Nama" autocomplete="off">
                                    <input type="hidden" name="siswa_id" id="userValue2" class="form-control">
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
                            <div class="col-sm-3">
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
                                <th style="vertical-align:top" rowspan="2">No</th>
                                <th style="vertical-align:top" rowspan="2">Mata Pelajaran</th>
                                <th style="vertical-align:top" rowspan="2">Siswa</th>
                                <th style="vertical-align:top" rowspan="2">Kelas</th>
                                <th style="vertical-align:top" rowspan="2">Semester</th>
                                {{-- <th style="vertical-align:top" rowspan="2">Keterangan</th> --}}
                                <th style="vertical-align:top" rowspan="2">Action</th>
                            </tr>

                        </thead>

                        <tbody>
                            <?php $no = $data->firstItem();?>
                            @if($data->count())  
                            @foreach($data as $val)  
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>{{ $val->mapel->nama or "-" }}</td>
                                <td>{{ $val->siswa->nama_depan or "-"}} {{ $val->siswa->nama_belakang or "-"}}</td>
                                <td>{{ $val->kelas->nama or "-"}}</td>
                                <td style="text-align:center">{{ $val->semester->semester or "-"}}</td>
                                {{-- <td>{{ $val->ketarangan or "-"}}</td> --}}
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val->id}}"><span class="fa fa-pencil"></span></a> 
                                    <a href="{{action('Siswa\NilaiController@destroy',$val->id)}}" id="hapus" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                                @else
                                    <tr>
                                        <td class="alert alert-warning" colspan="9">No Records found !!</td>
                                    </tr>
                                @endif
                        </tbody>
                    </table>
                </div>
            {{$data->render()}}
        
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('course.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Data</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Nama </label>
                                    <input type="text" name="siswa_id" id="siswa_id" class="form-control" autocomplete="off" required>
                                    <input type="hidden" name="siswa_id" id="siswaValue" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">                                       
                                <div class="form-group">
                                    <label for="">Mata Pelajaran</label>
                                    <select  name="mata_pelajaran_id" class="form-control" required>
                                        <option value="">Pilih Mata Pelajaran</option>
                                        @foreach($mapel2 as $id => $nama)
                                            <option value="{{$id}}">{{$nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label for="">Kelas</label>
                                    <select  name="kelas_id" class="form-control" required>
                                        <option value="">Pilih Kelas</option>
                                        @foreach($kelas as $id => $nama)
                                            <option value="{{$id}}">{{$nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label for="">Semester</label>
                                    <select  name="semester_id" class="form-control" required>
                                        <option value="">Pilih Semester</option>
                                        @foreach($semesters as $id => $semester)
                                            <option value="{{$id}}">{{$semester}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                            <div class="col-sm-6"> 
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
                @foreach($students as $value)
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
            $("#userValue2").val(item.value);
        }
        $('#user_id2').typeahead({
            source: [
                @foreach($students as $value)
                    { id: {{ $value['id'] }}, name: '{{ $value['nama_depan'] }}' },
                @endforeach
            ],
            onSelect: displayResult
        });
    });

</script>

@endsection
