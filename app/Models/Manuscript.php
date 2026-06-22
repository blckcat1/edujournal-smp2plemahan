<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Manuscript extends Model
{
    protected $fillable = [
        'author_id',
        'issue_id',
        'title',
        'subtitle',
        'abstract',
        'keywords',
        'subject',
        'pdf_path',
        'supporting_files',
        'comments_to_editor',
        'contributors',
        'references',
        'status',
        'doi',
        'likes',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'contributors' => 'array',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function issue(): BelongsTo
    {
        return $this->belongsTo(Issue::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likesRelation(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function certificate(): HasOne
    {
        return $this->hasOne(Certificate::class);
    }
}
