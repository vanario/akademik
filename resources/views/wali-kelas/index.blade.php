@extends('template')

@section('title', 'Nilai Siswa')
@section('content')

<div class="row">
    <section class="content">
        <form method="POST" action="{{-- {{ url('wali_kelas') }} --}}">
            {{ csrf_field() }}
            <div class="report-list">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="user_id" id="user_id" class="form-control" placeholder="Nama" autocomplete="off">
                            <input type="hidden" name="user_id" id="userValue" class="form-control">
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
        <div class="box-list">

                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr >
                                <th>No</th>
                                <th>Nama</th>                              
                                <th>Mata Pelajaran</th> 
                                <th>Kelas</th>                               
                                <th>Semester</th>                               
                                <th>Tahun Ajaran</th>                               
                                <th>Nilai Akhir</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = $data->firstItem();?>
                            @if($data->count())
                            @foreach($data as $val)  
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>{{ $val->siswa->name or "-" }}</td>
                                <td>{{ $val->mapel->nama or "-" }}</td>
                                <td>{{ $val->kelas->nama or "-" }}</td>
                                <td>{{ $val->semester->semester or "-" }}</td>
                                <td>{{ $val->tahun_ajaran->tahun_ajaran or "-" }}</td>
                                @php($ulangan_harian = ($val->ulangan_harian1+$val->ulangan_harian2+$val->ulangan_harian3)/3)
                                @php($nilai_tugas = ($val->nilai_tugas1+$val->nilai_tugas2+$val->nilai_tugas3)/3)
                                @php($nilai_mapel = round(($ulangan_harian+$nilai_tugas+$val->ujian_praktik+$val->uts+$val->nilai)/5))
                                <td>{{ $nilai_mapel}}</td>                            
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
    </section>
</div>

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
        $('#user_id').typeahead({
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
@endsection