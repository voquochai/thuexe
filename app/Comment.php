<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = [];

    public function parent() {
        return $this->belongsTo(static::class, 'parent');
    }

    public function children() {
        return $this->hasMany(static::class, 'parent');
    }
}
