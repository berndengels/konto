<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konto', function (Blueprint $table) {
            $table->id();
            $table->date('buchungstag');
            $table->date('valutadatum');
            $table->string('buchungstext', 200)->nullable()->index();
            $table->text('verwendungszweck')->nullable()->index();
            $table->string('wer', 200)->nullable();
            $table->string('kontonummer', 50)->nullable();
            $table->string('blz', 50)->nullable();
            $table->decimal('betrag', 10,2)->nullable()->index();
            $table->string('waehrung', 10)->nullable();
            $table->string('info', 100)->nullable();
            $table->index(['buchungstag']);
            $table->unique(['buchungstag','kontonummer','betrag']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konto');
    }
}
