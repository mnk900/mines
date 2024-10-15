<?php

namespace App\Http\Controllers\Admin;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Requests\EventUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class EventsController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->isAdminOrEditor()){
            $slides=Event::where('eventName', 'LIKE', "%{$request->search}%")->paginate();
            }
            else{
                return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
            }
            return view('admin.events.index',['model'=>$slides]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user_id=Auth::user()->user_id;
        // dd($user_id);
        if(Auth::user()->isAdminOrEditor()){
        return view('admin.events.create')->with(['model'=>new Event()]);
        }
            return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        //dd($request);
        //$imagePath = $request->file('eventImage')->store('uploads/images/Events', 'public');
        $imageorg = $request->file('eventImage')->store('uploads/images/Events', 'public');
        $thumbnailImage = Image::make($request->file('eventImage'))->resize(50, 50);
        $thumbnailPath = 'uploads/images/Events/thumbnails/' . basename($imageorg);
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
        $user_id=Auth::user()->id;
        $event = new Event();
        $event->eventName = $request->input('eventName');
        $event->eventDescription = $request->input('eventDescription');
        $event->eventDate = $request->input('eventDate');
        $event->eventTime = $request->input('eventTime');
        $event->eventLocation = $request->input('eventLocation');
        $event->eventOrganizer = $request->input('eventOrganizer');
        $event->availableSeats = $request->input('availableSeats');
        $event->eventCategory = $request->input('eventCategory');
        $event->eventTags = $request->input('eventTags');
        $event->eventImage = $imageorg;
        $event->eventImageThumbnail = $thumbnailPath;
        $event->user_id = $user_id;
        $event->save();
        return redirect()->route('events.index')->with('status',"Event $request->eventName was successfully created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        if(Auth::user()->isAdminOrEditor()){
            $event=Event::findOrFail($event->id);
            return view('admin.events.edit',['model'=>$event]);
            }
        return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventUpdateRequest $request, Event $event)
    {
        // Update the post data
        $previousImagePath = $event->image_path;
        $event->eventName = $request->input('eventName');
        $event->eventDescription = $request->input('eventDescription');
        $event->eventDate = $request->input('eventDate');
        $event->eventTime = $request->input('eventTime');
        $event->eventLocation = $request->input('eventLocation');
        $event->eventOrganizer = $request->input('eventOrganizer');
        $event->availableSeats = $request->input('availableSeats');
        $event->eventCategory = $request->input('eventCategory');
        $event->eventTags = $request->input('eventTags');

        // Handle the uploaded image file if provided
        // Handle the uploaded image file if provided
        if ($request->hasFile('eventImage')) {
            // Delete the old image
            Storage::disk('public')->delete('uploads/images/Events/'.$event->eventImage);
            Storage::disk('public')->delete('uploads/images/Events/thumbnails/'.$event->eventImage);

            // Store the new image
        $imageorg = $request->file('eventImage')->store('uploads/images/Events', 'public');
        $thumbnailImage = Image::make($request->file('eventImage'))->resize(230, 180);
        $thumbnailPath = 'uploads/images/Events/thumbnails/' . basename($imageorg);
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
        $event->eventImage = $imageorg;
        $event->eventImageThumbnail = $thumbnailPath;
        }
        $event->save();
        return redirect()->route('events.index')->with('status',"Event $request->eventName was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if(Auth::user()->isAdminOrEditor()){
            $previousImagePath = $event->eventImage;
            if ($previousImagePath) {
                Storage::disk('public')->delete($previousImagePath);
                Storage::disk('public')->delete($event->eventImageThumbnail);
            }
            $event->delete();
            return redirect()->route('Events.index')->with('status',"The Event is successfully deleted");
        }
        return redirect()->route('admin.index')->with('status',"You are not authorized to perform this action");
    }
}
