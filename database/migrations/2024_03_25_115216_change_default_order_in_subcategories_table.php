<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('subcategories', function (Blueprint $table) {
            // Verifica se a coluna 'order' existe antes de alterar/criar
            if (!Schema::hasColumn('subcategories', 'order')) {
                // Cria a coluna se ela não existir
                $table->integer('order')->default(999);
            } else {
                // Altera o valor padrão se a coluna já existir
                $table->integer('order')->default(999)->change();
            }
        });
    }

    public function down()
    {
        Schema::table('subcategories', function (Blueprint $table) {
            if (Schema::hasColumn('subcategories', 'order')) {
                // Muda de volta ao valor padrão original se a coluna existir
                $table->integer('order')->default(0)->change();
            }
        });
    }
};
