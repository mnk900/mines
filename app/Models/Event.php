<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Event extends Model
{
    use HasFactory;
    use PresentableTrait;
    protected $presenter='App\Presenters\EventPresenter';

     // Specify the attributes that are mass assignable
     protected $fillable = [
         'eventName',
         'eventDescription',
         'eventDate',
         'eventTime',
         'eventLocation',
         'eventOrganizer',
         'eventImage',
         'eventURL',
         'ticketPrice',
         'availableSeats',
         'eventCategory',
         'eventTags',
     ];

     public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
