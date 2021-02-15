<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use Carbon\CarbonInterface;

class Entry extends Pivot
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'entries';

    /**
     * Model fillables
     *
     * @var array
     */
    protected $fillable = [
        'competition_id',
        'competitor_id',
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
     * @return string|null
     */
    public function getTimeAttribute(): ?string
    {
        if ( !$this->attributes['start'] || ! $this->attributes['finish'])
            return null;
        else
            return Carbon::parse($this->attributes['start'])
                        ->diffForHumans(Carbon::parse($this->attributes['finish']), ['syntax' => CarbonInterface::DIFF_ABSOLUTE]);
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
