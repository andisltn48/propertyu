<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_images', function (Blueprint $迫) {
            $迫->id();
            $迫->string('image_path');
            $迫->boolean('status')->default(true);
            $迫->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_images');
    }
};
