<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('definitions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('def_doc_word')
                  ->nullable()
                  ->unique();
            $table->mediumText('def_doc_definition')
                  ->nullable();
            $table->foreignId('project_id')
                  ->constrained('projects')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('definitions');
    }
}
