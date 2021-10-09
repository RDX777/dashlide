<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Role;
use App\Models\Role_User;

class UsuarioController extends Controller
{
    public function show (Request $request) 
    {

        if (Gate::denies('edita_usuarios')) {
            abort(403, 'Ação não autorizada');
        }

        $busca = request('busca');

        if (isset($busca)) {
            $usuarios = User::select('id','name', 'email', 'created_at')->
            where('name', 'like', '%'.$busca.'%')->
            orWHere('email', 'like', '%'.$busca.'%')->
            simplePaginate(env('PAGINATION'));
        } else {
            $usuarios = User::select('id','name', 'email', 'created_at')->
            simplePaginate(env('PAGINATION'));
        }

        return view("usuarios.todos", compact('usuarios', 'busca'));
    }


    public function Adicionar(Request $request)
    {

        if (Gate::denies('edita_usuarios')) {
            abort(403, 'Ação não autorizada');
        }

        $titulo = "Adicionar Usuário";

        $roles = Role::select()->get();

        return view("usuarios.adicionar", compact('titulo', 'roles'));
    }


    public function store (Request $request)
    {

        if (Gate::denies('edita_usuarios')) {
            abort(403, 'Ação não autorizada');
        }

        $user = new User;
        $nome = $request->request->get("nome");
        $email = $request->request->get("email");
        $senha = Hash::make($request->request->get("senha"));
        $perfis = $request->request->get("perfis");

        $userexist = User::select('email')->
        where('email', $email)->
        get()->
        toArray();

        if (count($userexist) == 0) {

            $user->name = $nome;
            $user->email = $email;
            $user->password = $senha;

            $user->save();

            unset($user);

            $id = User::firstWhere('email', $email)->id;

            $this->store_profile($id, $perfis);



            return  redirect(route('user.get.principal'))->with("msg_sucesso", "Dados salvos com sucesso!");
        } else {
            return  redirect(route('user.get.principal'))->with("msg_erro", "Ja existe um usuário com esse e-mail!");
        }



    }


    public function edit ($id) 
    {

        if (Gate::denies('edita_usuarios')) {
            abort(403, 'Ação não autorizada');
        }

        $titulo = "Editar Usuário";
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::select()->get();
        foreach ($roles as $role) {
            $role->selected = null;
            foreach($user->roles as $user_role) {
                if ($role->id === $user_role->id) {
                    $role->selected = true;
                    break;
                } else if ($role->id !== $user_role->id) {
                    $role->selected = false;
                }
            }
        }
        return view("usuarios.adicionar", compact('titulo', 'user', 'roles'));
    }


    public function update (Request $request)
    {

        if (Gate::denies('edita_usuarios')) {
            abort(403, 'Ação não autorizada');
        }

       //Usuarios
        $id = $request->request->get("id");
        $nome = $request->request->get("nome");
        $email = $request->request->get("email");
        $senha = $request->request->get("senha");
        $perfis = $request->request->get("perfis");

        $user = User::findOrFail($request->id);
        if ($id != 1) {
            $user->name = $nome;
            $user->email = $email;
        }
        if (isset($senha)) {
            $user->password = Hash::make($senha);
        }
        $user->updated_at = date("Y-m-d H:i:s");

        $user->save();

        unset($user);

        //Perfis
        if ($id != 1) {
            $this->delete_profile($id);
            $this->store_profile($id, $perfis);
            return redirect(route('user.get.principal'))->with("msg_sucesso", "Dados alterados com sucesso!");
        } else {
            return redirect(route('user.get.principal'))->with("msg_sucesso", "Dados alterados com sucesso! Porém conta root apenas a senha é alterada.");
        }

        

    }


    private function delete_profile($user_id) {
        Role_User::where('user_id', $user_id)->delete();
    }


    private function store_profile($user_id, $roles_id) {
        
        foreach ($roles_id as $role_id) {
            $profile = new Role_User;
            $profile->role_id = $role_id;
            $profile->user_id = $user_id;
            $profile->save();
            unset($profile);
        }
        
    }

    public function delete ($id)
    {
        
        if (Gate::denies('edita_usuarios')) {
            abort(403, 'Ação não autorizada');
        }

        $user = User::findOrFail($id);
        return view("usuarios.deletar", compact('user'));
    }


    public function destroy ($id)
    {

        if (Gate::denies('edita_usuarios')) {
            abort(403, 'Ação não autorizada');
        }

        if ($id != 1) {
            $user = User::findOrFail($id)->delete();

            return redirect(route('user.get.principal'))->with("msg_sucesso", "Usuario deletado com sucesso!");
        } else {
            return redirect(route('user.get.principal'))->with("msg_erro", "A conta root não pode ser excluída!");
        }
    }
}
