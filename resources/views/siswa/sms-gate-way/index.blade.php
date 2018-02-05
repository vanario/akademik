@extends('template')

@section('title', 'Sms')
@section('content')

<div class="row">
    <section class="content">
        <form method="POST" action="{{ url('sms-gateway/send') }}">
            {{ csrf_field() }}
            <div class="modal-dialog">
                <div class="box-list">
                    <div class="row">
                        <div class="form-group">
                            <label for="">* Keterangan</label>
                        </div>
                        <div class="form-group">
                            <label for="">Siswa</label>
                            <input type="text" id="user_id" class="form-control" autocomplete="off" required>
                            <input type="hidden" name="user_id" id="userValue" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <select  name="kelas" class="form-control">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $id => $nama)
                                    <option value="{{$id}}">{{$nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun Ajaran</label>
                            <select  name="tahun_ajaran" class="form-control">
                                <option value="">Pilih Tahun Ajar</option>
                                @foreach($tahunajar as $id => $tahun_ajaran)
                                    <option value="{{$id}}">{{$tahun_ajaran}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Konten</label>
                            <textarea name="konten" id="konten" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-green btn-block">Filter</button>
                        </div>
                    </div>
                </div>     
            </div>
        </form>
    </section>
</div>
@endsection

@section('script')
@include('sweet::alert')
<script src="{{ asset('adminlte/bower_components/bootstrap-typeahead.js') }}"></script>  
<script src="{{ asset('adminlte/bower_components/jquery.mockjax.js') }}"></script>  
<script type="text/javascript">
    $(function() {
        function displayResult(item) {            
            $("#userValue").val(item.value);
        }
        $('#user_id').typeahead({
            source: [
                @foreach($user as $value)
                    { id: {{ $value['id'] }}, name: '{{ $value['name'] }}' },
                @endforeach
            ],
            onSelect: displayResult
        });
    });

</script>
@endsection