<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinMeta extends Model
{
    use HasFactory;
    protected $table = 'pin_meta';
    protected $guarded = [];

    public function pin()
    {
        return $this->belongsTo(Pin::class);
    }
}
