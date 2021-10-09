@extends('layouts.home')

@section('title', 'Dashboard')

@section('content')

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner" id="demonstracao">

            <div class="spinner-border text-light" id="loading" role="status">
                <span class="sr-only"></span>
            </div>

        </div>
    </div>

    <script src="./js/home.js"></script>

@endsection