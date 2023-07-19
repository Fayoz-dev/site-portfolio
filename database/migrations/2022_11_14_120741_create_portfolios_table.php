<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('category_id');
            $table->foreign("category_id")->references("id")->on("portfolio_categories")
            ->onUpdate("restrict")
            ->onDelete("restrict");
            $table->unsignedBigInteger('client_id');
            $table->foreign("client_id")->references("id")->on("clients")
            ->onUpdate("restrict")
            ->onDelete("restrict");
            $table->string('image');
            $table->string('video');
            $table->date('published_date');
            $table->longText('description');
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
        Schema::dropIfExists('portfolios');
    }
}
