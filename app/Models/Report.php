<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'anonymous', 'public', 'tag', 'description', 'author', 'report_date', 'votes', 'photo', 'status', 'status_desc', 'user_id', 
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
