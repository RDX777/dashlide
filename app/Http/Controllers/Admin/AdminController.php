<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Arquivo;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;

class AdminController extends Controller
{

    public function showpermissions()
    {

        echo "<h1>Lista de permissões</h1>";

        $user_id = auth()->user()->id;

        $user = User::with('roles')->find($user_id);
        echo "<h2>" . $user->name . "</h2>";
        echo "<br>";

        foreach ($user->roles as $role) {
            echo "<b>";
            echo $role->id;
            echo " - ";
            echo $role->name;
            echo " --> ";
            echo "</b>";
            $permissions = Role::with('permissions')->find($role->id);

            foreach($permissions->permissions as $permission) {
                echo $permission->name;
                echo ", ";
            }

            echo "<br>";
        }
    }

    public function upload () {

        if (Gate::denies('insere_arquivos')) {
            abort(403, 'Ação não autorizada');
        }
        return view("admin.upload");
    }


    public function indexAdmin () {

        return view("admin.index");
    }    

    public function storeupload (Request $request) {
        if (Gate::denies('insere_arquivos')) {
            abort(403, 'Ação não autorizada');
        }
        
        if ($request->hasFile('arquivo')) {

            $arquivos = $request->files->get('arquivo');

            $tempos = $request->request->get("tempo");

            $ordens = $request->request->get("ordem");

            $esticar = $request->request->get("esticar");

            for ($i = 0; $i < count($arquivos); $i++) {
                $arquivo = new Arquivo;

                $extencao = $arquivos[$i]->getClientOriginalExtension();
                $mimeType = $arquivos[$i]->getClientMimeType();
                $nomeArquivo = md5($arquivos[$i]->getClientOriginalName() . strtotime("now")) . "." . $extencao;
                $arquivos[$i]->move(public_path("img/demonstracao"),  $nomeArquivo);

            
                $arquivo->nomemd5 = $nomeArquivo;
                $arquivo->nome = $arquivos[$i]->getClientOriginalName();
                $arquivo->extencao = $extencao;
                $arquivo->mimetype = $mimeType;
                $arquivo->tempo = $tempos[$i];
                $arquivo->ordem = $ordens[$i];
                $arquivo->esticar = $esticar[$i];

                $arquivo->save();

                unset($arquivo);
            }

            return redirect('/admin/editar')->with("msg_sucesso", "Dados salvos com sucesso!");
       
        }
    }


    public function editar () {

        if (Gate::denies('edita_arquivos')) {
            abort(403, 'Ação não autorizada');
        }

        $json_arquivos = Arquivo::all()
        ->sortBy(['ordem', 'nome']);

        return view("admin.editar", ['arquivos' => $json_arquivos]);
    }


    public function storeeditar (Request $request) {
        if (Gate::denies('edita_arquivos')) {
            abort(403, 'Ação não autorizada');
        }

        $arquivos = $request->request->get("nome");
        $arquivosmd5 = $request->request->get('nomemd5');
        if (! is_array($arquivosmd5)) {
            $arquivosmd5 = []; 
        }

        $tempos = $request->request->get("tempo");

        $ordens = $request->request->get("ordem");

        $esticar = $request->request->get("esticar");

        for ($i = 0; $i < count($arquivosmd5); $i++) {

            $this->update([
                'nomemd5' => $arquivosmd5[$i],
                'tempo' => $tempos[$i],
                'ordem' => $ordens[$i],
                'esticar' => $esticar[$i]
            ]);


        }

        $nomemd5bds = Arquivo::select('nomemd5')->get()->toArray();
        $arquivosmd5bd = [];

        foreach ($nomemd5bds as $nomemd5bd) {
            array_push($arquivosmd5bd, $nomemd5bd['nomemd5']);
        }

        $arquivos_diferenca = array_diff($arquivosmd5bd, $arquivosmd5);

        foreach ($arquivos_diferenca as $arquivo_diferenca) {
            $this->deleteFile ($arquivo_diferenca);
            $this->destroy($arquivo_diferenca);
        }

        return redirect('/admin/upload')->with("msg_sucesso", "Dados editados com sucesso");
        
    }


    private function deleteFile ($nomeArquivo) {
        File::delete("img/demonstracao/" . $nomeArquivo);

    }


    private function update ($dados) {

        Arquivo::where('nomemd5', $dados['nomemd5'])->update([
            'tempo' => $dados['tempo'],
            'ordem' => $dados['ordem'],
            'esticar' => $dados['esticar']
        ]);

    }


    private function destroy ($nomemd5) {

        Arquivo::where('nomemd5', $nomemd5)->delete();
    }


    public function showAll (){

        $json_arquivos = Arquivo::all()
            ->sortBy(['ordem', 'nome']);

        return $json_arquivos;

    }
}


