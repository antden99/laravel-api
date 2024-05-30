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
        Schema::create('project_technology', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->cascadeOnDelete(); //questo evita che nelle tabelle pivot ci siano relazioni orfane, perchè se viene eliminato un istanza contenuta tra project e technology, vengono automaticamente cancellate a cascata anche le relazioni nella pivot

            $table->unsignedBigInteger('technology_id');
            $table->foreign('technology_id')
                ->references('id')
                ->on('technologies')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
