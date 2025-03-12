<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'date_event', 'deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('isOrganizer')->withTimestamps();
    }

    public function isUserOrganizer(User $user)
    {
        return $this->users()->wherePivot('user_id', $user->id)->wherePivot('isOrganizer', true)->exists();
    }
}
