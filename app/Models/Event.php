<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'date_event', 'deleted_at', 'total_places'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_user')->withPivot('isOrganizer', 'isSpeaker');
    }

    public function participants()
    {
        return $this->users()->wherePivot('isOrganizer', false)->wherePivot('isSpeaker', false);
    }

    public function speakers()
    {
        return $this->users()->wherePivot('isSpeaker', true);
    }

    public function remainingPlaces()
    {
        return $this->total_places - $this->participants()->count();
    }

    public function addParticipant($userId)
    {
        if ($this->remainingPlaces() > 0) {
            $this->users()->attach($userId, ['isOrganizer' => false, 'isSpeaker' => false]);
            return true;
        }
        return false;
    }

    public function addSpeaker($userId)
    {
        $this->users()->attach($userId, ['isSpeaker' => true]);
    }
}
