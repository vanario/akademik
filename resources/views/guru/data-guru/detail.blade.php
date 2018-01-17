@extends('template')

@section('title', 'Detail Guru')

@section('content')

    <div class="content-list">

        <div class="report">
            <div class="report-daily">
                <div class="report-title">
                    <h4>Detail Guru</h4>
                </div>
                <!-- start: header nav tabs-->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#wali" aria-controls="days" role="tab" data-toggle="tab">Wali Kelas</a></li>
                    <li role="presentation"><a href="#month" aria-controls="pengampu" role="tab" data-toggle="tab">Pengampu</a></li>                    
                </ul><!-- end: header nav tabs-->

                <!-- start: content tabs panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="wali">
                        <div class="box-list">
                            <table class="table table-striped">
                                <thead>
                                    <th>Kelas</th>
                                    <th>Semester</th>
                                    <th>Tahun Ajaran</th>
                                </thead>
                                <tbody>
                                    @if($data_wali != "")
                                        @if($data_wali->count() && $data_wali != "") 
                                        @foreach($data_wali as $val)
                                        <tr>
                                            <td>{{$val->kelas or "-"}}</td>
                                            <td>{{$val->tahun_ajaran or "-"}}</td>
                                            <td>{{$val->semester or "-"}}</td>   
                                        </tr>
                                        @endforeach
                                        @endif 
                                            @else
                                                <tr>
                                                    <td colspan="7">No Records found !!</td>
                                                </tr>                                   
                                    @endif                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="pengampu">
                        <div class="box-list">
                            <table class="table table-striped">
                                <thead>
                                    <th>Kelas</th>
                                    <th>Semester</th>
                                    <th>Tahun Ajaran</th>
                                </thead>
                                <tbody>
                                    @if($data_pengampu != "")
                                        @if($data_pengampu->count() && $data_pengampu != "") 
                                            @foreach($data_pengampu as $val)
                                            <tr>
                                                <td>{{$val->kelas or "-"}}</td>
                                                <td>{{$val->tahun_ajaran or "-"}}</td>
                                                <td>{{$val->semester or "-"}}</td>   
                                            </tr>
                                            @endforeach 
                                            @endif
                                                @else
                                                    <tr>
                                                        <td colspan="7">No Records found !!</td>
                                                    </tr>                                   
                                            @endif                                    
                                </tbody>
                            </table>
                        </div>
                    </div>                   
                </div>
            </div>           
    </div>

@endsection
