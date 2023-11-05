<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class System extends Model
{
    use HasFactory;

    public function tabletops() : HasMany
    {
        return $this->hasMany(Tabletop::class);
    }

    public function scenarios() : HasMany
    {
        return $this->hasMany(Scenario::class);
    }
}
