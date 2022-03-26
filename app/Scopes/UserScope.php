<?php

namespace App\Scopes;

use App\Exceptions\SecurityException;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UserScope implements Scope{

    /**
     * @MiaShare HR
     *
     * I gotta admit, I really don't find the new php8 constructor syntax helpful.
     * I still like having my object properties bellow the class declaration.
     *
     * @param User $user
     */
    public function __construct(private User $user) {}

    /**
     * @param Builder $builder
     * @param Model   $model
     *
     * @return void
     * @throws SecurityException
     */
    public function apply(Builder $builder, Model $model) : void{

        $builder->whereUserId($this->user->getKey());
    }
}
