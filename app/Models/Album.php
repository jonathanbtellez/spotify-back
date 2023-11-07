<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['name','release_date','artist_id'];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class, 'artist_id', 'id');
    }

    public function tracks(): HasMany
    {
        return $this->hasMany(Track::class, 'album_id', 'id');
    }

    public function image():MorphOne
	{
		return $this->morphOne(Image::class, 'imageable');
	}
}
