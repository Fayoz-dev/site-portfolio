<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioJoinImageFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_join_image_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('image_file_id');
            $table->foreign("image_file_id")->references("id")->on("image_files")
            ->onUpdate("restrict")
            ->onDelete("restrict");
            $table->unsignedBigInteger('portfolio_id');
            $table->foreign("portfolio_id")->references("id")->on("portfolios")
            ->onUpdate("restrict")
            ->onDelete("restrict");
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
        Schema::dropIfExists('portfolio_join_image_files');
    }
}
