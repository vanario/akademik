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
        <div class="header-table-left">
            <table>
                <tbody>                                   
                    <tr>
                        <td>Nama Madrasah </td>
                        <td>: Madrasah Al-Islam Turen</td>
                    </tr>
                    <tr>
                        <td>Alamat </td>
                        <td>: {{ $value->data_siswa->alamat or "-" }}</td>
                    </tr> 
                    <tr>
                        <td>Nama Peserta Didik </td>
                        <td>: {{ $value->data_siswa->nama_depan or "-" }} </td>
                    </tr> 
                    <tr>
                        <td>No Induk Peserta Didik </td>
                        <td>: {{ $value->data_siswa->nis or "-" }} </td>
                    </tr>                                                                      
                    
                </tbody>
            </table>
        </div>
        <div class="header-table-right">
            <table>
                <tbody>                                   
                    <tr>
                        <td>Kelas </td>
                        <td>: {{ $value->kelas->nama or "-" }} </td>
                    </tr>
                    <tr>
                        <td>Semester </td>
                        <td>: {{ $value->semester->semester or "-" }} </td>
                    </tr>
                    <tr>
                        <td>Tahun Ajaran </td>
                        <td>: {{ $value->tahun_ajaran->tahun_ajaran or "-" }}</td>
                    </tr>                                                                      
                    
                </tbody>
            </table>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>KKM</th>
                <th>Nilai</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = $data->firstItem();?>
            @if($data->count())  
            @foreach ($data as $val)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $val->mapel->nama or "-" }}</td>
                <td>{{ $val->mapel->kkm or "-" }}</td>
                @php($ulangan_harian = ($val->ulangan_harian1+$val->ulangan_harian2+$val->ulangan_harian3)/3)
                @php($nilai_tugas = ($val->nilai_tugas1+$val->nilai_tugas2+$val->nilai_tugas3)/3)
                @php($nilai_mapel = round(($ulangan_harian+$nilai_tugas+$val->ujian_praktik+$val->uts+$val->nilai)/5))
                <td>{{ $nilai_mapel}}</td>
                <td>{{ $val->ketarangan or "-" }}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <h5>{{ "Data Tidak Ada" }}</h5>
            </tr>
            @endif
        </tbody>
    </table>
    {{$data->render()}}
</div>

</body>
</html>
