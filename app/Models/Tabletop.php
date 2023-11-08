<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tabletop extends Model
{
    use HasFactory;

    public function system() : BelongsTo
    {
        return $this->belongsTo(System::class);
    }

    public function scenario() : BelongsTo
    {
        return $this->belongsTo(Scenario::class);
    }
    
    /**
     * Returns the user that owns the tabletop
     * @return BelongsTo
     */
    public function owner_user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The relation that returns all the users which belongs to the tabletop
     * @return BelongsToMany
     */
    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Returns all the subgenres which belongs to the tabletop
     * @return BelongsToMany
     */
    public function subgenres() : BelongsToMany
    {
        return $this->belongsToMany(Subgenre::class)->withTimestamps();
    }
}
