@extends('layouts.adminmain')

@section('title', 'Dashboard página inicial')

@section('content')

<div class="container mt-4">

    <div class="p-5 mb-4 bg-light border rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Apresentação fotos e videos em forma de slide.</h1>
            <p class="col-md-8 fs-4">Usando este recurso de qualquer computador ou celular, você podera enviar fotos e videos para apresentação em um telão via browser.</p>
            <hr class="my-3">
            <p class="col-md-8 fs-4">Não é compativel com algumas Smart TVs</p>
            <p class="col-md-8 fs-4">Videos: .mp4, .mkv</p>
            <p class="col-md-8 fs-4">Imagens: .jpg, .jpeg, .png</p>
            @guest
                <a class="btn btn-primary btn-lg" href="/auth/login" role="button">Entrar</a>
            @endguest
                       
        </div>
    </div>

</div>

@endsection