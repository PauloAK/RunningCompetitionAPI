<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Entry;
use App\Models\Competitor;
use App\Models\Competition;

class UniqueEntryOnDay implements Rule
{
    /**
     * @var Competitor
     */
    private $competitor;

    /**
     * @var Entry
     */
    private $entry;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($competitor_id, $entry_id = null)
    {
        $this->competitor = Competitor::find($competitor_id);
        if ($entry_id)
            $this->entry = Entry::find($entry_id);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$this->competitor)
            return true;

        $competition = Competition::find($value);
        $query = $this->competitor->competitions()->where('date', $competition->date);
        if ($this->entry)
            $query->where('entries.id', '!=', $this->entry->id);

        return !$query->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Competitor altready has a entry for an competition at this date.';
    }
}
