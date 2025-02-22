<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'anonymous', 'public', 'tag', 'description', 'author', 'report_date','votes', 'photo', 'status', 'status_desc', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function updateVoteCount()
    {
        $this->votes = $this->votes()->count();
        $this->save();
    }
}
