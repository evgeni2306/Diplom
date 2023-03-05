<?php
declare(strict_types=1);
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    const TABLE_NAME = "cat_quest_counts";

    public function up():void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->integer('count')->nullable(false)->unsigned();
            $table->foreignId('profession_id')->constrained('professions');
            $table->foreignId('category_id')->constrained('categories');
            $table->unique(['profession_id', 'category_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down():void
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
