<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->text('description');           
        });

        DB::table('roles')->insert(array(
            'name' => 'Administrador',
            'description' => 'Administrador de sistema, usado para manutenções, testes etc.'
        ));

        DB::table('roles')->insert(array(
            'name' => 'Publicador',
            'description' => 'Publicador pode realizar a inserção de novos itens a apresentação.'
        ));

        DB::table('roles')->insert(array(
            'name' => 'Editor',
            'description' => 'Editor pode realizar atualizações e mudar itens da apresentação.'
        ));

        DB::table('roles')->insert(array(
            'name' => 'Controlador de Acessos',
            'description' => 'Realiza o controle de usuarios a pagina.'
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
