<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subgenre extends Model
{
    use HasFactory;

    /**
     * Returns the tabletops which belongs to the subgenre
     * @return BelongsToMany
     */
    public function tabletops() : BelongsToMany
    {
        return $this->belongsToMany(Tabletop::class)->withTimestamps();
    }
}
