@extends('layouts.adminmain')

@section('title', 'Dashboard Upload')

@section('content')

<div class="container">

<h3 class="fw-light text-decoration-underline d-flex justify-content-center my-2">Em demostração</h3>

<form action="{{ route('put.editar') }}" method="post" enctype="multipart/form-data">

@csrf
@method('PUT')
    <div class="container mt-2" id="demostracao">

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Nome do Arquivo</th>
                    <th scope="col">Tempo</th>
                    <th scope="col">Ordem</th>
                    <th scope="col">Esticar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($arquivos as $arquivo)

                    <tr id="{{$arquivo->nomemd5}}">
                        <th scope="row" data-toggle="tooltip" data-placement="top" title="Nome do arquivo">
                            {{$arquivo->nome}}
                            <input class="form-control" type="hidden" id="formFile" value="{{$arquivo->nome}}" name="nome[]">
                            <input class="form-control" type="hidden" id="formFile" value="{{$arquivo->nomemd5}}" name="nomemd5[]">
                        </th>
                        <td>
                            <input class="form-control" type="text" id="formFile" value="{{$arquivo->tempo}}" name="tempo[]" autocomplete="off" data-toggle="tooltip" data-placement="top" title="Tempo em Segundos" required>
                        </td>
                        <td>
                            <input class="form-control" type="text" id="formFile" value="{{$arquivo->ordem}}" name="ordem[]" autocomplete="off" data-toggle="tooltip" data-placement="top" title="Apenas Numeros" required>
                        </td>
                        <td>
                        <select class="form-select" name="esticar[]" data-toggle="tooltip" data-placement="top" title="Escolha uma das opções" required>
                            
                            @if ($arquivo->esticar == "TelaCheia")
                                @if ($sim = "selected") @endif
                                @if ($nao = "") @endif
                            @else
                                @if ($sim = "") @endif
                                @if ($nao = "selected") @endif
                                
                            @endif

                            <option value="TelaCheia" {{$sim}}>Sim</option>
                            <option value="TelaNormal" {{$nao}}>Não</option>
                        </select>
                        </td>
                        <td><i class="bi bi-x-lg mx-1" data-toggle="tooltip" data-placement="top" title="Excluir" id="{{$arquivo->nomemd5}}"></i></td>
                    </tr>
                    
                @empty
                    <tr>
                        <td>Nenhum item encontrado</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                @endforelse

            </tbody>
        </table>
        </div>

        <div class="container d-block justify-content-center">

        <div class="mt-5 mb-5 d-flex justify-content-center">
            <button class="btn btn-primary" type="submit">Salvar</button>
        </div>
        </div>

    </div>

</form>

<script src="{{ url(mix('js/editar.js')) }}"></script>

@endsection