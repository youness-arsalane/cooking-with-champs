<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table
                ->string('spoonacular_id')
                ->nullable()
                ->default(null)
                ->unique()
                ->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('spoonacular_id');
        });
    }
}
