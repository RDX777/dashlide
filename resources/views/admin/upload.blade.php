@extends('layouts.adminmain')

@section('title', 'Dashboard Upload')

@section('content')


<form action="{{ route('post.upload') }}" method="post" enctype="multipart/form-data">

    @csrf
    <div class="container mt-2" id="executando">

        <h3 class="fw-light text-decoration-underline d-flex justify-content-center mt-2">Upload de arquivos</h3>

        <p class="fw-lighter fst-italic d-flex justify-content-center">Atenção: Caso a ordem seja igual, o sistema seguira pelo nome do arquivo</p>
        
        <div class="fw-lighter fst-italic d-flex justify-content-center">

            <ul class="my-5fw-lighter fst-italic text-right">
                <li>Tempo: em segundos</li>
                <li>Ordem: em numeros</li>
            </ul>
        </div>

        <div class="container mb-3 mt-1 row g-4">
            
            <div class="col-md-6">
                <label for="formFile" class="form-label">Arquivo a enviar</label>
                <input class="form-control" type="file" id="formFile" name="arquivo[]" autocomplete="off" accept=".jpg, .jpeg, .png, .mp4, .mkv" required>
            </div>
            <div class="col-md-1">
                <label for="formFile" class="form-label">Tempo</label>
                <input class="form-control" type="text" id="formFile" value="" name="tempo[]" autocomplete="off" required>
            </div>
            <div class="col-md-1">
                <label for="formFile" class="form-label">Ordem</label>
                <input class="form-control" type="text" id="formFile" name="ordem[]" value="" autocomplete="off" required>
            </div>
            <div class="col-md-2">
                <label for="formFile" class="form-label">Esticar</label><br>
                <select class="form-select" name="esticar[]" required>
                    <option selected></option>
                    <option value="TelaCheia">Sim</option>
                    <option value="TelaNormal">Não</option>
                </select>
            </div>
            <div class="col-md-1">
                <label for="formFile" class="form-label">Adicionar</label>
                <button class="form-control btn btn-outline-primary" type="button">+</button>
            </div>
            <div class="col-md-1">
                <label for="formFile" class="form-label">Remover</label>
            </div>

        </div>

        <div class="mt-3" id="adicionais">

        </div>

    </div>



    <div class="container d-flex justify-content-center">

        <div class="my-5 d-flex justify-content-center">
            <button class="btn btn-primary" type="submit">Salvar</button>
        </div>
    </div>

</form>

<script src="{{ url(mix('js/upload.js')) }}"></script>

@endsection