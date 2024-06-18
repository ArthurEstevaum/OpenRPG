<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class System extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name', 'genre'];

    public function tabletops(): HasMany
    {
        return $this->hasMany(Tabletop::class);
    }

    public function scenarios(): HasMany
    {
        return $this->hasMany(Scenario::class);
    }
}
