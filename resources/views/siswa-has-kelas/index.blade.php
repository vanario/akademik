@extends('template')

@section('title', 'Kenaikan Kelas Siswa')
@section('page-title', 'Kenaikan Kelas Siswa')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <form method="POST" action="{{ url('kenaikan-kelas-siswa/index') }}">
                {{ csrf_field() }}
                <div class="report-list">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="siswa_id" id="siswa_id" class="form-control" placeholder="Nama" autocomplete="off">
                                <input type="hidden" name="siswa_id" id="siswaValue" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select  name="kelas_id" class="form-control">
                                    <option value="">Pilih Kelas</option>
                                    @foreach($classes as $id => $nama)
                                        <option value="{{$id}}">{{$nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Tahun Ajaran</label>
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
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas Awal</th>
                            <th>Kelas Sekarang</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <form method="POST" action="{{ url('kenaikan-kelas-siswa/create') }}">
                            {{ csrf_field() }}
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Naik Ke Kelas</label>
                                        <select  name="kelas" class="form-control">
                                            <option value="">Pilih Kelas</option>
                                            @foreach($classes as $id => $nama)
                                                <option value="{{$id}}">{{$nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Tahun Ajaran</label>
                                        <select  name="tahun_ajaran" class="form-control">
                                            <option value="">Pilih Tahun Ajar</option>
                                            @foreach($tahunajar as $id => $tahun_ajaran)
                                                <option value="{{$id}}">{{$tahun_ajaran}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Semester</label>
                                        <select  name="semester" class="form-control">
                                            <option value="">Pilih Semester</option>
                                            @foreach($semesters as $id => $semester)
                                                <option value="{{$id}}">{{$semester}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @foreach($studentHasClasses as $value)
                                    <td>1</td>
                                    <td>
                                        {{ $value->student->nis }}
                                        <input type="hidden" name="siswa" value="{{ $value->siswa_id }}">
                                    </td>
                                    <td>{{ $value->student->nama_depan }}</td>
                                    <td>{{ $value->classes->nama }}</td>
                                    <td>{{ $value->classes->nama }}</td>
                                    <td>{{ $value->tahunAjar->tahun_ajaran }}</td>
                                    <td>{{ $value->semester->semester }}</td>
                                    <td>
                                        <button type="submit" class="btn btn-green btn-block">Proses</button>   
                                    </td>
                                @endforeach
                            </form>
                        </tr>
                    </tbody>
                </table>
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


@endsection
