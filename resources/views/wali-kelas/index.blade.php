@extends('template')

@section('title', 'Nilai Siswa')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <?php $no = $data->firstItem();?>
            @if($data->count())
            @foreach($data as $val)  
                <div class="box-list">
                    <div class="row">
                        <div class="col-sm-3">
                            <h1 class="box-list__title">Nama</h1>
                            <h5 class="box-list__meta">{{ $val->siswa->name or "-" }}</h5>
                        </div>
                        <div  class="col-sm-3">
                            <h1 class="box-list__title">Tahun Ajaran</h1>
                            <h5 class="box-list__meta">{{ $val->tahun_ajaran->tahun_ajaran or "-" }}</h5>
                        </div>
                        <div  class="col-sm-3">
                            <h1 class="box-list__title">Semester</h1>
                            <h5 class="box-list__meta">{{ $val->semester->semester or "-" }}</h5>
                        </div>
                        <div class="col-sm-3">
                            <h1 class="box-list__title">
                                <button class="btn btn-green btn-block" data-toggle="collapse" data-target="#nilai{{$val->id}}" >Detail</button>
                            </h1>
                        </div>
                    </div>
                
                    <div class="collapse" id="nilai{{$val->id}}">
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Detail Nilai</h4>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Mata Pelajaran</td>
                                            <td>{{$val->mapel->nama}}</td>
                                        </tr>
                                        @php($ulangan_harian = ($val->ulangan_harian1+$val->ulangan_harian2+$val->ulangan_harian3)/3)
                                        @php($nilai_tugas = ($val->nilai_tugas1+$val->nilai_tugas2+$val->nilai_tugas3)/3)
                                        @php($nilai_mapel = round(($ulangan_harian+$nilai_tugas+$val->ujian_praktik+$val->uts+$val->nilai)/5))
                                        <tr>
                                            <td>Nilai</td>
                                            <td>{{$nilai_mapel}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>                                                   
                    </div>
                </div>
            @endforeach
            @endif
            {{$data->render()}}
        </div>
    </section>
</div>

@endsection