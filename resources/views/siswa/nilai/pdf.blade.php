<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/pdfcss.php">
    <title>Nilai Siswa</title>
</head>

<body>

<div class="container">
    <div class="header-table">
        <h4>Daftar Nilai Mts Al-ISLAM TURENT</h4>
        <h4>Tahun Ajaran {{ $value->tahun_ajaran->tahun_ajaran or "-" }}</h4>
        <div class="header-table-left">
            <table>
                <tbody>                                   
                    <tr>
                        <td>Kelas :</td>
                        <td>: {{ $value->data_siswa->nis or "-" }} </td>
                    </tr> 
                </tbody>
            </table>
        </div>
        <div class="header-table-right">
            <table>
                <tbody>                                   
                    <tr>
                        <td>Semester </td>
                        <td>: {{ $value->semester->semester or "-" }} </td>
                    </tr>                    
                </tbody>
            </table>
        </div>
    </div>

    <table class="table table-striped" style="width: 100%;">

        <thead>
            <tr>
                <th style="vertical-align:top" rowspan="2">No</th>
                <th style="vertical-align:top" rowspan="2">Mata Pelajaran</th>
                <th style="vertical-align:top" rowspan="2">Siswa</th>
                <th style="vertical-align:top" rowspan="2">Kelas</th>
                <th style="vertical-align:top" rowspan="2">Semester</th>
                {{-- <th style="vertical-align:top" rowspan="2">Tahun Ajaran</th> --}}
                <th style="text-align:center" colspan="3">Ulangan Harian</th>
                <th style="text-align:center" colspan="3">Nilai Tugas</th>                                
                <th style="vertical-align:top" rowspan="2">Praktik</th>
                <th style="vertical-align:top" rowspan="2">UTS</th>
                <th style="vertical-align:top" rowspan="2">UAS</th>
                <th style="vertical-align:top" rowspan="2">Nilai Akhir</th>
                {{-- <th style="vertical-align:top" rowspan="2">Keterangan</th> --}}
            </tr>
            <tr>
                <th style="text-align:center">1</th>
                <th style="text-align:center">2</th>
                <th style="text-align:center">3</th>
                <th style="text-align:center">1</th>
                <th style="text-align:center">2</th>
                <th style="text-align:center">3</th>
            </tr>

        </thead>

        <tbody>
            <?php $no = $data->firstItem();?>
            @if($data->count())  
            @foreach($data as $val)  
            <tr>
                <td>{{ $no++}}</td>
                <td>{{ $val->mapel->nama or "-" }}</td>
                <td>{{ $val->siswa->name or "-"}}</td>
                <td>{{ $val->kelas->nama or "-"}}</td>
                <td style="text-align:center">{{ $val->semester->semester or "-"}}</td>
                {{-- <td>{{ $val->tahun_ajaran->tahun_ajaran or "-"}}</td> --}}
                <td>{{ $val->ulangan_harian1 or "-"}}</td>
                <td>{{ $val->ulangan_harian2 or "-"}}</td>
                <td>{{ $val->ulangan_harian3 or "-"}}</td>
                <td>{{ $val->nilai_tugas1 or "-"}}</td>
                <td>{{ $val->nilai_tugas2 or "-"}}</td>
                <td>{{ $val->nilai_tugas3 or "-"}}</td>
                <td style="text-align:center">{{ $val->ujian_praktik or "-"}}</td>
                <td>{{ $val->uts or "-"}}</td>
                <td>{{ $val->nilai or "-"}}</td>
                @php($ulangan_harian = ($val->ulangan_harian1+$val->ulangan_harian2+$val->ulangan_harian3)/3)
                @php($nilai_tugas = ($val->nilai_tugas1+$val->nilai_tugas2+$val->nilai_tugas3)/3)
                @php($nilai_akhir = round(($ulangan_harian+$nilai_tugas+$val->ujian_praktik+$val->uts+$val->nilai)/5))
                <td style="text-align:center">{{ $nilai_akhir or "-"}}</td>
                {{-- <td>{{ $val->ketarangan or "-"}}</td> --}}                
            </tr>
            @endforeach
                @else
                    <tr>
                        <td class="alert alert-warning" colspan="9">No Records found !!</td>
                    </tr>
                @endif
        </tbody>
    </table>
    {{$data->render()}}
</div>

</body>
</html>
