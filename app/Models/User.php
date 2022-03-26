<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany ;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable{
    use HasApiTokens, HasFactory, Notifiable;

    protected $with = ['Roles'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
     *--------------------------------------------------------------------------
     * Job Application Memo
     * 2022-03-25
     *--------------------------------------------------------------------------
     *
     * Hi MiaShare HR!
     * To maximize speed of the user/roles relationships
     * user/roles is eager loaded and never re-queried.
     *
     * Also, I like to capitalize my Model relationships
     * but I can always do things differently for you.
     */
    public function Roles(): BelongsToMany {
        return $this->belongsToMany(Role::class);
    }

    public function getIsAdministratorAttribute(): bool{
        return $this->Roles
                    ->where('name', 'administrator') // @MiaShare: this is not a re-query, it is a collection->where.
                    ->count();
    }

    //----------------------------------------------------------------------

    public function Tasks() : HasMany{
        return $this->hasMany(Task::class);
    }
}
