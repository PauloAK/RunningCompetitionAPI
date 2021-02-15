<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Competition extends Model
{
    /**
     * Model fillables
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'date'
    ];

    /**
     * The competitors that belong to the Competition
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function competitors(): BelongsToMany
    {
        return $this->belongsToMany(Competitor::class, Entry::class)->withPivot('start', 'finish');
    }
}
