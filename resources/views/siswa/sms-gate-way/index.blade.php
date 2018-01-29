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
                            <label for="">Tujuan</label>
                            <input type="text" name="contact" id="nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Konten</label>
                            <textarea name="konten" id="konten" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Aksi</label>
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
@endsection