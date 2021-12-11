<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Person extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait;

    protected $fillable = ['name', 'email', 'phone', 'organization_id'];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
