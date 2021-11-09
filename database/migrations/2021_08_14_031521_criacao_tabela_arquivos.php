<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CriacaoTabelaArquivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivos', function (Blueprint $table) {
            $table->id();
            $table->string('nomemd5', 255)->unique();
            $table->string('nome', 255);
            $table->string('extencao', 11);
            $table->string('mimetype', 50);
            $table->date('data');//->default(new Expression('(CURDATE())'));
            $table->time('hora',$precision = 0);//->default(new Expression('(CURTIME())'));
            $table->integer('tempo');
            $table->integer('ordem');
            $table->set('esticar', ['TelaCheia', 'TelaNormal'])->default("TelaCheia");
        });

        DB::table('arquivos')->insert(array(
            'nomemd5' => '147d2989e66f0c079ab1cbd562fc0256.mp4',
            'nome' => 'Gandalf.mp4',
            'extencao' => 'mp4',
            'mimetype' => 'video/mp4',
            'data' => '2021-11-08',
            'hora' => '21:00:00',
            'tempo' => 60,
            'ordem' => 1,
            'esticar' => 'TelaCheia'
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arquivos');
    }
    
}
