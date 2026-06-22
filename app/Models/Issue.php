<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Issue extends Model
{
    protected $fillable = [
        'volume',
        'issue_number',
        'year',
        'title',
        'status',
    ];

    public function manuscripts(): HasMany
    {
        return $this->hasMany(Manuscript::class);
    }
}
