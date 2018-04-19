<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoalEntry extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'goal_id',
        'amount',
        'recorded_at'
    ];

    /**
     * Get the goal the entry applies to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goal()
    {
        return $this->belongsTo('App\Models\Goal');
    }
}
