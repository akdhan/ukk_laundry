<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi');
            $table->unsignedBigInteger('id_member');
            $table->unsignedBigInteger('id_paket');
            $table->date('tgl')->nullable();
            $table->date('batas_waktu')->nullable();
            $table->enum('status', ['baru','proses','selesai','diambil']);
            $table->enum('dibayar', ['dibayar','belum_bayar']);
            $table->unsignedBigInteger('id_user');

            $table->foreign('id_member')->references('id_member')->on('members');
            $table->foreign('id_paket')->references('id_paket')->on('pakets');
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
