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
        Schema::create('invite_profile', function (Blueprint $table) {
            $table->uuid('invite_id');
            $table->uuid('profile_id');
            $table->primary(['invite_id', 'profile_id']);
    
            $table->foreign('invite_id')
                ->references('id')
                ->on('invites')
                ->onDelete('cascade');
    
            $table->foreign('profile_id')
                ->references('id')
                ->on('profiles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invite_profile');
    }
};
