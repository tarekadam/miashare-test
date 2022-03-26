<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model{
    use SoftDeletes;

    protected $fillable = ['memo'];

    public function User(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function getNiceDateAttribute(): string{
        return $this->created_at->diffForHumans();
    }
}
