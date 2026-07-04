<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void

    {

        Schema::create('profil_desa', function (Blueprint $table) {

         $table->id();

         $table->string('nama_desa');

         $table->string('kecamatan');

         $table->string('kabupaten');

         $table->string('provinsi');

         $table->string('kode_pos')->nullable();

         $table->text('sejarah')->nullable();

         $table->text('visi')->nullable();

         $table->text('misi')->nullable();

         $table->text('sambutan_kades')->nullable();

         $table->string('foto_kades')->nullable();

         $table->string('nama_kades')->nullable();

         $table->string('logo')->nullable();

         $table->string('telepon')->nullable();

         $table->string('email')->nullable();

         $table->text('alamat')->nullable();

         $table->timestamps();

        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_desa');
    }
};
