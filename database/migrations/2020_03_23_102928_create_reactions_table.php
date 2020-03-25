<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reactions', function (Blueprint $table) {
             $table->increments('id');
             $table->string('name');
             $table->timestamps();
        });

        Schema::create('episode_reactions', function (Blueprint $table) {
            $table->primary(['user_id', 'episode_id']);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('episode_id')->unsigned();
            $table->integer('reaction_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('episode_id')
                ->references('id')
                ->on('episodes')
                ->cascadeOnDelete();

            $table->foreign('reaction_id')
                ->references('id')
                ->on('reactions')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reactions');
        Schema::dropIfExists('episode_reactions');
    }
}
