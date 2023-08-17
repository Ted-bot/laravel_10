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
            $observer = '\\App\\Observers\\' . class_basename(static::class) . 'Observer';

            if(!class_exists($observer)){
                $messageError = 'Class not found: ' . $observer;
                throw new ClassNotFoundByObserverTraitException($messageError, 404);
            } else {
                (new static)->registerObserver($observer);
            }
    }
}
