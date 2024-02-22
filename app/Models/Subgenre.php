<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Subgenre extends Model
{
    use HasFactory, Searchable;

    /**
     * Returns the tabletops which belongs to the subgenre
     * @return BelongsToMany
     */
    public function tabletops() : BelongsToMany
    {
        return $this->belongsToMany(Tabletop::class)->withTimestamps();
    }
}
