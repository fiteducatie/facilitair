<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Board extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function booted(): void
    {
        static::addGlobalScope('ownboards', function (Builder $builder) {
            if (!auth()->user()->hasRole('Admin')) {
                $builder->where('user_id', auth()->id());
            }
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pins() {
        return $this->belongsToMany(Pin::class, 'board_pin');
    }
}
