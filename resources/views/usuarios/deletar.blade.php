@extends('layouts.principal')

@section('title', 'Deletar Usuário')

@section('users')

@csrf

@method('DELETE')

    <div class="container">

        <h3 class="fw-light text-decoration-underline d-flex justify-content-center my-2">Deseja deletar o usuário?</h3>

        <div class="container border mt-4">

            <div class="form-group">
                    <label>Nome Completo: </label>
                    <label>{{ $user->name }}</label>
            </div>

            <div class="form-group">
                    <label>E-Mail: </label>
                    <label>{{ $user->email }}</label>
            </div>

        </div>

        <div class="container">
            <button type="submit" class="btn btn-danger mt-3">Deletar</button>
        </div>

</div>

@endsection