<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataPribadi extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('data_pribadi', function (Blueprint $table) {

            $table->string("id")->index();
            $table->string("nik")->index()->unique();
            $table->string("gelar_depan");
            $table->string("nama_lengkap");
            $table->string("gelar_belakang");
            $table->string("jenis_kelamin");
            $table->string("tempat_lahir");
            $table->string("tanggal_lahir");
            $table->string("golongan_darah");
            $table->string("agama");
            $table->string("status_perkawinan");
            $table->string("hub_keluarga");
            $table->string("pendidikan");
            $table->string("pekerjaan");
            $table->timestamps();
            $table->primary('id');
            $table->softDeletes();

            $table->engine = 'InnoDB';
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('data_pribadi');
    }

}
