<?php

namespace App\Scopes;

use App\Exceptions\SecurityException;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class WithTrashScope implements Scope{


    /**
     * @param Builder $builder
     * @param Model   $model
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model) : void{
        $builder->orWhereNotNull('deleted_at');
    }
}
