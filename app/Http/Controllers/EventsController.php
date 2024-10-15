<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $event=Event::findOrFail($id);
        return view('events.view',['event'=>$event]);
    }


}
