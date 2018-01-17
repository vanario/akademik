@extends('template')

@section('title', 'Nilai Siswa')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">      
       
        	<div class="box-list">
                <h4>Detail Nilai</h4>

                <table class="table table-bordered">
                    <tbody>
						@foreach($data as $val) 
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
                        @endforeach
                    </tbody>
                </table>
            </div>                            
       
        </div>
    </section>
</div>

@endsection