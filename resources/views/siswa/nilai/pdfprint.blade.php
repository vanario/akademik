@extends('template')

@section('title', 'List Nilai Siswa')
@section('page-title', 'Input Data Nilai Siswa')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <a data-toggle="modal" data-target="#add" class="btn bg-purple " font-16" style="margin-bottom:30px;">Tambah</a>

                <form method="POST" target="_blank" action="{{ url('nilai/pdf') }}">
                    {{ csrf_field() }}
                    <div class="report-list">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="user_id" id="user_id" class="form-control" placeholder="Nama" autocomplete="off">
                                    <input type="hidden" name="user_id" id="userValue" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">Mata Pelajaran</label>
                                    <select  name="mata_pelajaran_id" class="form-control">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        @foreach($mapel as $id => $nama)
                                            <option value="{{$id}}">{{$nama}}</option>
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
                                    <label for="">Aksi</label>
                                    <button type="submit" class="btn btn-green btn-block">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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