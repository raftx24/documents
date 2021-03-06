<?php

namespace LaravelEnso\Documents;

use LaravelEnso\Documents\app\Models\Document;
use LaravelEnso\Files\FileServiceProvider as ServiceProvider;

class FileServiceProvider extends ServiceProvider
{
    public $register = [
        'documents' => [
            'model' => Document::class,
            'order' => 60,
        ],
    ];
}
