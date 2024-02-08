<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
      
            $table->string('created_by_email')->nullable();
            $table->string('updated_by_email')->nullable();
            $table->string('deleted_by_email')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('permission_profile', function (Blueprint $table) {
            $table->uuid('profile_id');
            $table->uuid('permission_id');
            $table->primary(['profile_id', 'permission_id']);
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('profile_user', function (Blueprint $table) {
            $table->uuid('profile_id');
            $table->uuid('user_id');
            $table->primary(['profile_id', 'user_id']);
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('profile_user');
        Schema::dropIfExists('permission_profile');
        Schema::dropIfExists('profiles');
    }
};
