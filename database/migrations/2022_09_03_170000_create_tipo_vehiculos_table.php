<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->float('cuota');

            $table->timestamps();
        });

        DB::table('tipo_vehiculos')->insert(
            array(
                ['tipo' => 'Oficial',
                'cuota' => 0],
                ['tipo' => 'Residente',
                'cuota' => 1],
                ['tipo' => 'No residente',
                'cuota' => 3]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_vehiculos');
    }
};
