<?php

namespace App\Models\Traits;

use ClassNot;
use App\Exceptions\ClassNotFoundByObserverTraitException;
use App\Models\User;
use Throwable;

trait Observable
{
    public static function bootObservable()
    {
            // $observer = '\\App\\Observers\\' . class_basename(static::class) . 'Observer';
            $observer = '\\App\\' . class_basename(static::class) . 'Observer';
            $currentFileName = __FILE__;

            if(!class_exists($observer)){
                throw new ClassNotFoundByObserverTraitException($observer, $currentFileName);
            }

            (new static)->registerObserver($observer);
    }
}
