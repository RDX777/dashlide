<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Arquivo;

class ArquivosController extends Controller
{
    public function show (){

        $json_arquivos = Arquivo::all()
            ->sortBy(['ordem', 'nome']);

        return $json_arquivos;

    }
}
