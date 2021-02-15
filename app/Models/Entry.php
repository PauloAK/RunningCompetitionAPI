<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Entry extends Pivot
{
    /**
     * Model fillables
     *
     * @var array
     */
    protected $fillable = [
        'start',
        'finish'
    ];

    /**
     * Custom attributes to append
     *
     * @var array
     */
    protected $appends = [
        'time'
    ];

    /**
     * Get the entry time
     *
     * @return integer|null
     */
    public function getTimeAttribute()
    {
        if ( !$this->attributes['start'] || ! $this->attributes['finish'])
            return null;
        else
            return Carbon::parse($this->attributes['start'])->diffInSeconds(Carbon::parse($this->attributes['finish']));
    }

    /**
     * Get the competitor that owns the Entry
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competitor(): BelongsTo
    {
        return $this->belongsTo(Competitor::class, 'competitor_id');
    }

    /**
     * Get the competition that owns the Entry
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }
}
