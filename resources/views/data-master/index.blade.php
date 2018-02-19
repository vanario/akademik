@extends('template')

@section('title', 'List Master Data')

@section('page-title', 'List Master Data')

@section('content')

<div class="content-list">
    <div class="wrapper-master">
        <div class="row">
            <div class="col-sm-4">
                <div class="box-list">
                    <h1 class="box-list__title title-purple">Jadwal</h1>
                    {{-- <h5 class="box-list__meta"><em>33 Data</em></h5> --}}
                    <a href="{{ url('jadwal') }}" class="box-list__button font-16 padd-16-top">Details</a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="box-list">
                    <h1 class="box-list__title title-purple">Kelas</h1>
                    {{-- <h5 class="box-list__meta"><em>33 Data</em></h5> --}}
                    <a href="{{ url('kelas') }}" class="box-list__button font-16 padd-16-top">Details</a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="box-list">
                    <h1 class="box-list__title title-purple">Mata Pelajaran</h1>
                    {{-- <h5 class="box-list__meta"><em>33 Data</em></h5> --}}
                    <a href="{{ url('mapel') }}" class="box-list__button font-16 padd-16-top">Details</a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="box-list">
                    <h1 class="box-list__title title-purple">Semester</h1>
                    {{-- <h5 class="box-list__meta"><em>33 Data</em></h5> --}}
                    <a href="{{ url('semester') }}" class="box-list__button font-16 padd-16-top">Details</a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="box-list">
                    <h1 class="box-list__title title-purple">Tahun Ajaran</h1>
                    {{-- <h5 class="box-list__meta"><em>33 Data</em></h5> --}}
                    <a href="{{ url('tahun-ajar') }}" class="box-list__button font-16 padd-16-top">Details</a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="box-list">
                    <h1 class="box-list__title title-purple">Slider</h1>
                    {{-- <h5 class="box-list__meta"><em>33 Data</em></h5> --}}
                    <a href="{{ url('slider') }}" class="box-list__button font-16 padd-16-top">Details</a>
                </div>
            </div>
        </div>
    </div>  
</div>

@endsection
