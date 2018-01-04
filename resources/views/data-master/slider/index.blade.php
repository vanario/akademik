@extends('template')

@section('title', 'List Data Penduduk')
@section('page-title', 'Input Gambar')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">

                <a data-toggle="modal" data-target="#add" class="btn bg-purple " font-16" style="margin-bottom:30px;">Tambah</a>

                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Judul</th>
                                <th>Caption</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = $data->firstItem();?>
                            @if($data->count())  
                            @foreach($data as $val)  
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>{{ $val->image or "-" }}</td>
                                <td>{{ $val->title or "-"}}</td>
                                <td>{{ $val->description or "-" }}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val->id}}"><span class="fa fa-pencil"></span></a>      
                                    <a href="{{action('Master\SliderController@destroy',$val->id)}}" id="hapus" ><i class="fa fa-trash"></i></a>
                                </td>
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

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Gambar Slider</h4>
                        </div>
                        <div class="modal-body">                                       
                            <div class="form-group">
                                <label for="">Judul</label>
                                <input type="text" name="title" id="title" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" name="description" id="description" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <input type="file" id="inputimage" name="gambar" class="validate">
                            </div>

                            <div class="form-group">
                                <img src="" id="image-preview" style="max-width:200px;max-height:200px;" />
                            </div>        
                        </div>
                        <div class="modal-footer">
                            <div>
                                 <input type="submit" value="Simpan" class="btn btn-subscribe" >
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>      

        @foreach($data as $val)
        <div class="modal fade" id="edit{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('slider.update',$val->id) }}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Gambar Slider</h4>
                        </div>
                        <div class="modal-body">                                         
                            <div class="form-group">
                                <label for="">Judul</label>
                                <input type="text" name="title" value="{{$val->title}}" id="title" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" name="description" value="{{$val->description}}" id="description" class="form-control input-sm" required>
                            </div>
                             <div class="form-group">
                                <input type="file" id="inputimage" name="gambar" class="validate">
                            </div>
                            <div class="form-group">
                                <img src="{{ $val->image or "" }}" id="image-preview" style="max-width:200px;max-height:200px;" />
                            </div>                
                        </div>
                        <div class="modal-footer">
                            <div>
                                <input type="submit"  value="Simpan" class="btn btn-subscribe" >
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>  
        @endforeach
    </section>
</div>

@endsection

@section('script')
@include('sweet::alert')
<script type="text/javascript">

    $(function() {

        readURL('input');

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();           

                reader.onload = function (e) {
                    $('#image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#inputimage").change(function(){
            readURL(this);
        });

        
    })
        
               

</script>

@endsection


