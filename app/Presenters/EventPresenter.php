<?php

namespace App\Presenters;
use Laracasts\Presenter\Presenter;
use Carbon\Carbon;
class EventPresenter extends Presenter{protected $event;

    public function __construct($event)
    {
        $this->event = $event;
    }
    public function eventDate(){
        return Carbon::parse($this->event->eventDate)->toFormattedDateString();
    }
}
