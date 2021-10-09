@extends('layouts.adminmain')

@section('title', 'Dashboard Upload')

@section('content')

@isset($user)
    @if (Request::segment(2) == "editar")
        <form action="{{ route('user.put.editar', ['id' => $user->id]) }}" method="post">        
    @else
        <form action="{{ route('user.delete.deletar', ['id' => $user->id]) }}" method="post">
    @endif
    
@else
    <form action="{{ route('user.post.adicionar') }}" method="post">
@endisset

        <div class="container">

            <div class="mb-2 mt-4 row d-flex justify-content-center">

                <div class="col-md-6">
                    <div class="input-group mb-3 col-md-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Nome</span>
                        </div>
                        <input type="text"
                            class="form-control col-md-1"
                            aria-label="Default"
                            aria-describedby="inputGroup-sizing-default"
                            id="nome"
                            @isset($busca)
                                value="{{ $busca }}"
                            @endisset
                            autocomplete="off">
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="button"
                        class="form-control btn btn-outline-primary"
                        id="busca">
                            Buscar
                    </button>
                </div>

                <div class="col-md-2">
                    <button class="form-control btn btn-outline-primary"
                        type="button"
                        id="adicionar">
                            Adicionar
                    </button>
                </div>
                <div class="col-md-2">
                    <button class="form-control btn btn-outline-primary"
                        type="button"
                        id="todos">
                            Todos
                    </button>
                </div>
            </div>

        </div>

        @yield('users')

    </form>

    <script src="{{ asset('js/usuariosprincipal.js') }}"></script>

@endsection