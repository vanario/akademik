@extends('template')

@section('title', 'Dashboard')
{{-- @section('page-title', 'Universitas Ahmad Dahlan Yogyakarta') --}}

@section('content')

<div class="container">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
 
        <ol class="carousel-indicators">
            @foreach( $data as $photo )
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
            @endforeach
        </ol>

        <div class="carousel-inner" role="listbox">
        @foreach( $data as $photo )
            <div class="item {{ $loop->first ? 'active' : '' }}">
                <div class="preview-image">
                <img src="{{ $photo->image }}" alt="{{ $photo->title }}" style="max-width:1000%;max-height:800px;" >
                    <div class="carousel-caption">
                        <h3 >{{ $photo->title }}</h3>
                        <p>{{ $photo->description }}</p>
                    </div>
                </div>
           </div>
        @endforeach
        </div>
        <a class="left carousel-control" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>        
    </div>
</div> 
@endsection

            