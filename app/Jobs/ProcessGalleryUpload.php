<?php

namespace App\Jobs;

use App\Models\Gallery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessGalleryUpload implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $imagePath
    ) {}

    public function handle(): void
    {
        Gallery::create(['image_path' => $this->imagePath]);
    }
}
