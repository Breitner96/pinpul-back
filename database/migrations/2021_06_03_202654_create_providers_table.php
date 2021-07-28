<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans');

            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('type_document_id');
            $table->foreign('type_document_id')->references('id')->on('type_documents');

            $table->string('logo')->nullable()->default('default.jpg');
            $table->string('provider');
            $table->string('slug');
            $table->LONGTEXT('description')->nullable();
            $table->LONGTEXT('products')->nullable();
            $table->LONGTEXT('services')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('num_document');
            $table->string('phone')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->unsignedBigInteger('nempleados')->nullable();
            $table->LONGTEXT('details')->nullable();
            $table->LONGTEXT('garantia')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('web_site')->nullable();
            $table->string('url_video')->nullable()->default('not-video');
            $table->string('views')->nullable();
            $table->string('views_tel')->nullable();
            $table->string('state')->default('en revisión');

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
        Schema::dropIfExists('providers');
    }
}
