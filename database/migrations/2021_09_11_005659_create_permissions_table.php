<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
        });

        DB::table('permissions')->insert(array(
            'name' => 'insere_arquivos',
            'description' => 'Realiza o Upload de novos arquivos'
        ));

        DB::table('permissions')->insert(array(
            'name' => 'edita_arquivos',
            'description' => 'Realiza edição de arquivos ja postados'
        ));

        DB::table('permissions')->insert(array(
            'name' => 'edita_usuarios',
            'description' => 'Controla os usuarios do sistema'
        ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
