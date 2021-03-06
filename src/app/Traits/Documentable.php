<?php

namespace LaravelEnso\Documents\app\Traits;

use LaravelEnso\Documents\app\Models\Document;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

trait Documentable
{
    public static function bootDocumentable()
    {
        self::deleting(function ($model) {
            if (config('enso.documents.onDelete') === 'restrict'
                && $model->documents()->first() !== null) {
                throw new ConflictHttpException(
                    __('The entity has attached documents and cannot be deleted')
                );
            }
        });

        self::deleted(function ($model) {
            if (config('enso.documents.onDelete') === 'cascade') {
                $model->documents()->delete();
            }
        });
    }

    public function document()
    {
        return $this->morphOne(Document::class, 'documentable');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
