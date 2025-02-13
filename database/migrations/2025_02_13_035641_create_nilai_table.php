<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_status');
            $table->bigInteger('profil_tes_id');
            $table->bigInteger('id_siswa');
            $table->bigInteger('soal_bank_paket_id');
            $table->string('nama');
            $table->string('nisn');
            $table->enum('jk', ['L', 'P']);
            $table->decimal('skor', 5, 2);
            $table->integer('soal_benar')->nullable();
            $table->string('nama_pelajaran');
            $table->bigInteger('pelajaran_id');
            $table->bigInteger('materi_uji_id');
            $table->string('sesi');
            $table->bigInteger('id_pelaksanaan');
            $table->string('nama_sekolah');
            $table->integer('total_soal') ->nullable();
            $table->integer('urutan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
