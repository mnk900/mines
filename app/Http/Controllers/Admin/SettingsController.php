<?php

namespace App\Http\Controllers\Admin;
use App\Models\Setting;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\SettingUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
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
            $setting=Setting::where('key', 'LIKE', "%{$request->search}%")->paginate();
            }
            else{
                return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
            }
            return view('admin.settings.index',['model'=>$setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->isAdminOrEditor()){
        return view('admin.settings.create')->with(['model'=>new Setting()]);
        }
            return redirect()->route('admin.index',)->with('status',"You are not authorized to access this page");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        $imageorg=null;
        $thumbnailPath=null;
        if ($request->hasFile('image')) {
        $imageorg = $request->file('image')->store('uploads/images/setting', 'public');
        $thumbnailImage = Image::make($request->file('image'))->resize(50, 50);
        $thumbnailPath = 'uploads/images/setting/thumbnails/' . basename($imageorg);
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
        }
        $user_id=Auth::user()->id;
        $setting = new Setting();
        $setting->key = $request->input('key');
        $setting->value = $request->input('value');
        $setting->image = $imageorg;
        $setting->image_thumbnail = $thumbnailPath;
        $setting->user_id = $user_id;
        $setting->save();
        return redirect()->route('settings.index')->with('status',"Setting $request->key was successfully created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        if(Auth::user()->isAdminOrEditor()){
            $setting=Setting::findOrFail($setting->id);
            return view('admin.settings.edit',['model'=>$setting]);
            }
        return redirect()->route('admin.index',)->with('status',"You are not authorized to access this page");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingUpdateRequest $request, Setting $setting)
    {
        // Update the post data
        $previousImagePath = $setting->image_path;
        $setting->key = $request->input('key');
        $setting->value = $request->input('value');

        // Handle the uploaded image file if provided
        if ($request->hasFile('image')) {
            // Delete the old image
            Storage::disk('public')->delete('uploads/images/setting/'.$setting->image);
            Storage::disk('public')->delete('uploads/images/setting/thumbnails/'.$setting->image);

            // Store the new image
        $imageorg = $request->file('image')->store('uploads/images/setting', 'public');
        $thumbnailImage = Image::make($request->file('image'))->resize(230, 180);
        $thumbnailPath = 'uploads/images/setting/thumbnails/' . basename($imageorg);
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
        $setting->image = $imageorg;
        $setting->image_thumbnail = $thumbnailPath;
        }
        $setting->save();
        return redirect()->route('settings.index')->with('status',"Setting $request->key was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        if(Auth::user()->isAdminOrEditor()){
            $previousImagePath = $setting->image;
            if ($previousImagePath) {
                Storage::disk('public')->delete($previousImagePath);
                Storage::disk('public')->delete($setting->image_thumbnail);
            }
            $setting->delete();
            return redirect()->route('settings.index')->with('status',"The Setting is successfully deleted");
        }
        return redirect()->route('admin.index')->with('status',"You are not authorized to perform this action");
    }
}
