<?php

namespace App\Models;

use App\Helpers\HashHelper;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'type',
        'target',
        'operator'
    ];

    /**
     * The accessors to append to the model.
     *
     * @var array
     */
    protected $appends = ['hash_id', 'history'];

    /**
     * Attributes to hide when serializing data.
     *
     * @var array
     */
    protected $hidden = ['hash_id', 'user_id'];

    /**
     * Get the hashed id value.
     *
     * @param int   $id     the primary key value
     * @return string
     */
    public function getHashIdAttribute( $id )
    {
        return HashHelper::encodeKey((int)$this->id);
    }

    /**
     * Get the entry history for the goal.
     *
     * @return array
     */
    public function getHistoryAttribute()
    {
        $amounts = [];
        $startDate = date('Y-m-d', time() - (365 * 24 * 60 * 60));

        // Initialize the array of amounts
        for ($i = 0; $i < 365; $i++) {
            $amounts[date('Y-m-d', strtotime($startDate . '+' . $i . ' days'))] = 0;
        }

        // Get the entries for the appropriate timeframe
        $entries = $this->entries()->limit(365)->get();

        // Update the amounts with the available entries
        foreach ($entries as $entry) {
            $amounts[date('Y-m-d', strtotime($entry->recorded_at))] = $entry->amount;
        }

        return $amounts;
    }

    /**
     * Get the entries for the goal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entries()
    {
        return $this->hasMany('App\Models\GoalEntry');
    }

    /**
     * Customize data serialization.
     *
     * @return array
     */
    public function toArray()
    {
        $attributes = parent::toArray();
        
        // Make sure the id attribute is always the first attribute
        return ['id' => $this->hash_id] + $attributes;
    }
}
