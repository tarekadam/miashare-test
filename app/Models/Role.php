<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model{

    /*--------------------------------------------------------------------------
     * @MiaShare:   I tend to implement all relationships bi-directionally even
     *              if that relationship isn't being used yet.  Just a habit.
     * 2022-03-25
     *///-----------------------------------------------------------------------
    public function Users(): BelongsToMany{
        return $this->belongsToMany(Role::class);
    }
}
