<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email');
            $table->string('token')->unique();
            $table->uuid('user_id')->nullable();
            $table->timestamps();
    
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

                $table->uuid('created_by')->nullable();
                $table->uuid('updated_by')->nullable();
                $table->uuid('deleted_by')->nullable();
          
                $table->string('created_by_email')->nullable();
                $table->string('updated_by_email')->nullable();
                $table->string('deleted_by_email')->nullable();
            $table->softDeletes();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('invites');
    }
}
