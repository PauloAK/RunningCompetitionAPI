<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Competitor extends Model
{
    /**
     * Model fillables
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cpf',
        'birthdate'
    ];

    /**
     * Custom attributes to append
     *
     * @var array
     */
    protected $appends = [
        'age'
    ];

    /**
     * Competitor age
     *
     * @return integer
     */
    public function getAgeAttribute(): int
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    /**
     * The competitions that belong to the Competitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function competitions(): BelongsToMany
    {
        return $this->belongsToMany(Competition::class, Entry::class)->withPivot('id', 'start', 'finish')->as('entry');
    }

    /**
     * Overrides the delete method, to detach competitions first
     *
     * @return void
     */
    public function delete()
    {
        $this->competitions()->detach();
        parent::delete();
    }
}
