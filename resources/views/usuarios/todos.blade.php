@extends('layouts.principal')

@section('title', 'Dashboard Upload')

@section('users')

    <div class="container">

        <div class="container">

            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">Criado em</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)

                        <tr>
                            <td>
                                {{ $usuario->name }}
                            </td>
                            <td>
                                {{ $usuario->email }}
                            </td>
                            <td>
                                {{ date( 'd/m/Y H:i' , strtotime($usuario->created_at)) }}
                            </td>
                            <td>
                                <a class="navbar-brand" 
                                    href="{{ route('user.delete.deletar', ['id' => $usuario->id]) }}">
                                    <i class="bi bi-trash ms-2"></i>
                                </a>

                                <a class="navbar-brand" 
                                    href="{{ route('user.put.editar', ['id' => $usuario->id]) }}">
                                        <i class="bi bi-pencil ms-2"></i>
                                </a>
                                    
                                    
                            </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

            <div class="d-flex justify-content-center my-4">
                {{ $usuarios->links() }}
            </div>

        </div>

    </div>

@endsection