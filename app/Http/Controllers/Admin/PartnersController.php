<?php

namespace App\Http\Controllers\Admin;
use App\Models\Partner;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Http\Requests\PartnerUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PartnersController extends Controller
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
            $partner=Partner::where('name', 'LIKE', "%{$request->search}%")->paginate();
            }
            else{
                return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
            }
            return view('admin.partners.index',['model'=>$partner]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->isAdminOrEditor()){
        return view('admin.partners.create')->with(['model'=>new Partner()]);
        }
            return redirect()->route('admin.index',)->with('status',"You are not authorized to access this page");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {
        $imageorg = $request->file('logo')->store('uploads/images/Partner', 'public');
        $thumbnailImage = Image::make($request->file('logo'))->resize(50, 50);
        $thumbnailPath = 'uploads/images/Partner/thumbnails/' . basename($imageorg);
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
        $user_id=Auth::user()->id;
        $partner = new Partner();
        $partner->name = $request->input('name');
        $partner->description = $request->input('description');
        $partner->website = $request->input('website');
        $partner->logo = $imageorg;
        $partner->logo_thumbnail = $thumbnailPath;
        $partner->user_id = $user_id;
        $partner->save();
        return redirect()->route('partners.index')->with('status',"Partner $request->name was successfully created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        if(Auth::user()->isAdminOrEditor()){
            $partner=Partner::findOrFail($partner->id);
            return view('admin.partners.edit',['model'=>$partner]);
            }
        return redirect()->route('admin.index',)->with('status',"You are not authorized to access this page");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerUpdateRequest $request, Partner $partner)
    {
        // Update the post data
        $previousImagePath = $partner->image_path;
        $partner->name = $request->input('name');
        $partner->description = $request->input('description');
        $partner->website = $request->input('website');

        // Handle the uploaded image file if provided
        if ($request->hasFile('logo')) {
            // Delete the old image
            Storage::disk('public')->delete('uploads/images/Partner/'.$partner->logo);
            Storage::disk('public')->delete('uploads/images/Partner/thumbnails/'.$partner->logo);

            // Store the new image
        $imageorg = $request->file('logo')->store('uploads/images/Partner', 'public');
        $thumbnailImage = Image::make($request->file('logo'))->resize(230, 180);
        $thumbnailPath = 'uploads/images/Partner/thumbnails/' . basename($imageorg);
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
        $partner->logo = $imageorg;
        $partner->logo_thumbnail = $thumbnailPath;
        }


        $partner->save();
        return redirect()->route('partners.index')->with('status',"Partner $request->name was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        if(Auth::user()->isAdminOrEditor()){
            $previousImagePath = $partner->logo;
            if ($previousImagePath) {
                Storage::disk('public')->delete($previousImagePath);
                Storage::disk('public')->delete($partner->logo_thumbnail);
            }
            $partner->delete();
            return redirect()->route('partners.index')->with('status',"The Partner is successfully deleted");
        }
        return redirect()->route('admin.index')->with('status',"You are not authorized to perform this action");
    }
}
