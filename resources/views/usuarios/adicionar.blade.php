@extends('layouts.principal')

@section('title', $titulo)

@section('users')

@csrf

@isset($user)
    @method('PUT')
@else
    @method('POST')
@endisset

    <div class="container">

        <h3 class="fw-light text-decoration-underline d-flex justify-content-center my-2">{{ $titulo }}</h3>

        <div class="container" >

            @isset($user)
                <input type="hidden" name="id" value="{{ $user->id }}">
            @endisset

            <div class="form-group">
                <label for="exampleInputEmail1">Nome Completo</label>
                <input type="text"
                    class="form-control"
                    name="nome"
                    required
                    autocomplete="off"
                    @isset($user)
                        value="{{ $user->name }}"
                    @endisset
                    >
            </div>
            <div class="form-group">
                <label>E-Mail</label>
                <input type="email"
                    class="form-control"
                    name="email"
                    required
                    autocomplete="off"
                    @isset($user)
                        value="{{ $user->email }}"
                    @endisset
                    >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input type="password"
                    class="form-control"
                    name="senha"
                    @isset($user)
                        
                    @else
                        required
                    @endisset
                    autocomplete="off">
            </div>
            <div class="form-group">
                <label>Perfil</label>
                <select class="form-select"
                    name="perfis[]"
                    multiple aria-label="size 4 multiple select example">
                    
                    @foreach ($roles as $role)
                        @if ( $role->selected )
                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                        @else
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                        
                    @endforeach
                    
                </select>
 
                        {{--<option value="0" {{ $user->is_admin == "0" ? "selected" : ""}}>Não</option>--}}

            </div>

            @isset($user)
                <button type="submit" class="btn btn-primary mt-2">Alterar</button>
            @else
                <button type="submit" class="btn btn-primary mt-2">Salvar</button>
            @endisset
            

        </div>

    </div>

@endsection