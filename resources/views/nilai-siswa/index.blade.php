@extends('template')

@section('title', 'Nilai Akhir')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
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
        </div>
    </section>
</div>

@endsection