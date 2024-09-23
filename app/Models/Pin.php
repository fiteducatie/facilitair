<?php

namespace App\Models;




use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Pin extends Model implements HasMedia
{
    protected $guarded = [];
    use HasFactory, InteractsWithMedia, HasTags;

    protected static function booted(): void
    {
        // static::addGlobalScope('ownpins', function (Builder $builder) {
        //     if (!auth()->user()->hasRole('Admin')) {
        //         $builder->where('pins.user_id', auth()->id());
        //     }
        // });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pinMeta() {
        return $this->hasOne(PinMeta::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'category_pin');
    }

    public function likes() {
        return $this->belongsToMany(User::class, 'like_pin');
    }

    public function saves() {
        return $this->belongsToMany(User::class, 'save_pin', 'pin_id', 'user_id');
    }

    public function likedByUser(){
        if(!auth()->check()) {
            return false;
        }
        return $this->likes->where('id', auth()->user()->id)->count() > 0;
    }


    public function savedByUser() {
        if (!auth()->check()) {
            return false;
        }
        return $this->saves->where('id', auth()->user()->id)->count() > 0;
    }
}
