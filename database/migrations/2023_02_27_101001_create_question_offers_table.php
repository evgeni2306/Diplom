<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    const TABLE_NAME = 'question_offers';

    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_id')->constrained('users');
            $table->foreignId('category_id')->constrained('categories');
            $table->mediumText('question')->nullable(false);;
            $table->mediumText('answer')->nullable(false);;
            $table->tinyText('status')->nullable(false);
            $table->mediumText('comment')->nullable(true);
            $table->boolean('visible')->nullable(false);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
