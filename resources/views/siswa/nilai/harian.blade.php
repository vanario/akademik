@extends('template')

@section('title', 'List Nilai Siswa')
@section('page-title', 'Input Data Nilai Siswa')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            {{-- <a data-toggle="modal" data-target="#add" class="btn bg-purple " font-16" style="margin-bottom:30px;">Tambah</a> --}}

                 <form method="POST" action="{{ url('nilai') }}">
                    {{ csrf_field() }}
                    <div class="report-list">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">Nama </label>
                                    <input type="text" name="siswa_id" id="siswa_id" class="form-control" autocomplete="off">
                                    <input type="hidden" name="siswa" id="siswaValue" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">Mata Pelajaran</label>
                                    <select  name="mata_pelajaran_id" class="form-control">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        @foreach($mapel2 as $mataPelajaran)
                                            <option value="{{ $mataPelajaran->mapel->id }}">{{ $mataPelajaran->mapel->nama }}</option>
                                        @endforeach
                                    </select>
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
                                    <label for="">Nilai</label>
                                    <select  name="type_nilai" class="form-control">
                                        <option value="">Pilih Semua</option>
                                        <option value="1">Ulangan Harian</option>
                                        <option value="2">Nilai Tugas</option>
                                        <option value="3">Praktik</option>
                                        <option value="4">UTS</option>
                                        <option value="5">UAS</option>
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
                    <div>
                        <b>kelas : {{ $resultClass->nama or '-' }} </b><br>
                        <b>semester : {{ $resultSemesteran->semester or '-' }} </b><br>
                        <b>Mata Pelajaran :  {{ $resultMapel->nama or '-' }} </b>
                    </div>
                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th style="vertical-align:top" rowspan="2">No</th>                                    
                                <th style="vertical-align:top" rowspan="2">NISN</th>
                                <th style="vertical-align:top" rowspan="2">NIS</th>
                                <th style="vertical-align:top" rowspan="2">Siswa</th>
                                <th style="text-align:center" colspan="3">Ulangan Harian</th>
                                <th style="vertical-align:top" rowspan="2">KKM</th>
                                <th style="vertical-align:top" rowspan="2">Nilai Akhir</th>
                                <th style="vertical-align:top" rowspan="2">Keterangan</th>
                                <th style="vertical-align:top" rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <th style="text-align:center">1</th>
                                <th style="text-align:center">2</th>
                                <th style="text-align:center">3</th>
                            </tr>

                        </thead>

                        <tbody>
                            <?php $no = $data->firstItem();?>
                            @if($data->count())  
                            @foreach($data as $val)
                                @php($ulangan_harian = ($val->ulangan_harian1+$val->ulangan_harian2+$val->ulangan_harian3)/3)
                                @php($nilai_tugas = ($val->nilai_tugas1+$val->nilai_tugas2+$val->nilai_tugas3)/3)
                                @php($nilai_akhir = round(($ulangan_harian+$nilai_tugas+$val->ujian_praktik+$val->uts+$val->nilai)/5))  
                                <form method="POST" action="{{ route('nilai.update',$val->id) }}" >
                                    {{ csrf_field() }}
                                    <tr>
                                        <td>{{ $no++}}</td>                                        
                                        <td>{{ $val->siswa->nis or "-" }}</td>
                                        <td>{{ $val->siswa->nisn or "-"}}</td>
                                        <td>{{ $val->siswa->nama_depan or "-"}} {{ $val->siswa->belakang or "-"}}</td>
                                        <td><input type="text" name="ulangan_harian1" value="{{ $val->ulangan_harian1 or "-"}}"></td>
                                        <td><input type="text" name="ulangan_harian2" value="{{ $val->ulangan_harian2 or "-"}}"></td>
                                        <td><input type="text" name="ulangan_harian3" value="{{ $val->ulangan_harian3 or "-"}}"></td>                         
                                        
                                        <td style="text-align:center">{{ $val->mapel->kkm or "-"}}</td>
                                        <td style="text-align:center">{{ $nilai_akhir or "-"}}</td>
                                        <td>
                                            @if($val->mapel->kkm < $nilai_akhir)
                                                Lulus
                                            @else
                                                Belum Tercapai
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($resultMapel))
                                            <input type="submit" value="Simpan" class="btn btn-subscribe">
                                            @endif
                                        </td>
                                    </tr>
                                </form>
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
                    <form method="POST" action="{{ route('nilai.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Nilai</h4>
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
                                    <select  name="mata_pelajaran_id" class="form-control">
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
                            <div class="col-sm-4"> 
                                <div class="form-group" {{$errors->has('ulangan_harian1') ? 'has-error' : ''}}>
                                    <label for="">Nilai Ulangan Harian 1</label>
                                    <input type="text" name="ulangan_harian1" id="ulangan_harian1" class="form-control input-sm" required>
                                    <span class="text-danger">{{ $errors->first('ulangan_harian1') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group" {{$errors->has('ulangan_harian2') ? 'has-error' : ''}}>
                                    <label for="">Nilai Ulangan Harian 2</label>
                                    <input type="text" name="ulangan_harian2" id="ulangan_harian2" class="form-control input-sm" required>
                                    <span class="text-danger">{{ $errors->first('ulangan_harian2') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group" {{$errors->has('ulangan_harian3') ? 'has-error' : ''}}>
                                    <label for="">Nilai Ulangan Harian 3</label>
                                    <input type="text" name="ulangan_harian3" id="ulangan_harian3" class="form-control input-sm" required>
                                    <span class="text-danger">{{ $errors->first('ulangan_harian3') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group" {{$errors->has('nilai_tugas1') ? 'has-error' : ''}}>
                                    <label for="">Nilai Tugas 1</label>
                                    <input type="text" name="nilai_tugas1" id="nilai_tugas1" class="form-control input-sm" required>
                                    <span class="text-danger">{{ $errors->first('nilai_tugas1') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group" {{$errors->has('nilai_tugas2') ? 'has-error' : ''}}>
                                    <label for="">Nilai Tugas 2</label>
                                    <input type="text" name="nilai_tugas2" id="nilai_tugas2" class="form-control input-sm" required>
                                    <span class="text-danger">{{ $errors->first('nilai_tugas2') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group" {{$errors->has('nilai_tugas3') ? 'has-error' : ''}}>
                                    <label for="">Nilai Tugas 3</label>
                                    <input type="text" name="nilai_tugas3" id="nilai_tugas3" class="form-control input-sm" required>
                                    <span class="text-danger">{{ $errors->first('nilai_tugas3') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group" {{$errors->has('ujian_praktik') ? 'has-error' : ''}}>
                                    <label for="">Ujian Praktik</label>
                                    <input type="text" name="ujian_praktik" id="ujian_praktik" class="form-control input-sm" required>
                                    <span class="text-danger">{{ $errors->first('ujian_praktik') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group" {{$errors->has('uts') ? 'has-error' : ''}}>
                                    <label for="">Nilai UTS</label>
                                    <input type="text" name="uts" id="uts" class="form-control input-sm" required>
                                    <span class="text-danger">{{ $errors->first('uts') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">  
                                <div class="form-group" {{$errors->has('nilai') ? 'has-error' : ''}}>
                                    <label for="">Nilai UAS</label>
                                    <input type="text" name="nilai" id="nilai" class="form-control input-sm" required>
                                    <span class="text-danger">{{ $errors->first('nilai') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control input-sm" required>
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
                @foreach($siswa as $value)
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
        $('#user_id2').typeahead({
            source: [
                @foreach($siswa as $value)
                    { id: {{ $value['id'] }}, name: '{{ $value['nama_depan'] }} {{ $value['nama_belakang'] }}' },
                @endforeach
            ],
            onSelect: displayResult
        });
    });

</script>

@endsection
