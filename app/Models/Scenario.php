<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Scenario extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name'];

    public function system(): BelongsTo
    {
        return $this->belongsTo(System::class);
    }

    public function tabletops(): HasMany
    {
        return $this->hasMany(Tabletop::class);
    }
}
