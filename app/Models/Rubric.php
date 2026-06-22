<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rubric extends Model
{
    protected $fillable = [
        'criteria_name',
        'weight',
        'max_score',
    ];

    public function scores(): HasMany
    {
        return $this->hasMany(RubricScore::class);
    }
}
