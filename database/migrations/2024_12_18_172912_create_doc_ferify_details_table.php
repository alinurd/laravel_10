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
        Schema::create('doc_ferify_details', function (Blueprint $table) {
            $table->id();
            $table->integer('id_doc_ferify');
            $table->string('pid');
            $table->string('uraian');
            $table->time('dos');
            $table->text('ket');
            $table->time('dov');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_ferify_details');
    }
};
