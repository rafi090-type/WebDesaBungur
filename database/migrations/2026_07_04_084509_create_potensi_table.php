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

        Schema::create('potensi', function (Blueprint $table) {

            $table->id();

            $table->string('judul');

            $table->string('slug')->unique();

            $table->enum('kategori', ['pertanian', 'perikanan', 'umkm', 'wisata', 'lainnya']);

            $table->text('deskripsi');

            $table->string('foto')->nullable();

            $table->integer('urutan')->default(0);

            $table->boolean('tampil_home')->default(false);

            $table->timestamps();

        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potensi');
    }
};
