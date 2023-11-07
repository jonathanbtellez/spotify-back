<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = ['name','genre'];


    public function albums(): HasMany
    {
        return $this->hasMany(Album::class, 'artist_id', 'id');
    }

    public function image():MorphOne
	{
		return $this->morphOne(Image::class, 'imageable');
	}
}
