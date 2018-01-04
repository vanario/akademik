@extends('template')

@section('title', 'Laporan Patroli')

@section('content')

    <div class="content-list">
        <div class="title" >
            <h4>Detail Data Penduduk</h4>    
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class=" box-list">
                    <h6>Nama :</h6>                
                    <h6>Alamat :</h6>                
                    <h6>Umur :</h6>                
                    <h6>Jenis Kelamin :</h6>                
                </div>
            </div>

            <div class="col-md-8">
                <div class=" box-list">
                    <h6>lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsumlorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsumlorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsumlorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsumlorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsumlorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsumlorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsumlorem ipsum</h6>              
                </div>
            </div>    
        </div>
            <!-- start: header nav tabs-->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#kurang-mampu" aria-controls="days" role="tab" data-toggle="tab">Kurang-mampu</a></li>
            <li role="presentation"><a href="#cukup" aria-controls="cukup" role="tab" data-toggle="tab">Cukup</a></li>
            <li role="presentation"><a href="#mampu" aria-controls="mampu" role="tab" data-toggle="tab">Mampu</a></li>
        </ul><!-- end: header nav tabs-->
            <!-- start: content tabs panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="kurang-mampu">
                <div class="box-list">
                    <table class="table table-striped">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Catatan</th>
                            <th>Detail</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>                                      
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>  
                                <td>
                                    <a href="" target="_blank"><i class="fa fa-print"></i> Print</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="cukup">
                <div class="box-list">
                    <table class="table table-striped">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Catatan</th>
                            <th>Detail</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>                                      
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>  
                                <td>
                                    <a href="" target="_blank"><i class="fa fa-print"></i> Print</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="mampu">
                <div class="box-list">
                    <table class="table table-striped">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Catatan</th>
                            <th>Detail</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>                                      
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>  
                                <td>
                                    <a href="" target="_blank"><i class="fa fa-print"></i> Print</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>          

@endsection