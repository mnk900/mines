<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PageRequest;

class PagesController extends Controller
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
        $pages=Page::defaultOrder()->withDepth()->where('title', 'LIKE', "%{$request->search}%")->paginate();
        }
        else{
            $pages=Auth::user()->pages()->defaultOrder()->withDepth()->where('title', 'LIKE', "%{$request->search}%")->paginate();
        }
        return view('admin.pages.index',['pages'=>$pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.pages.create')->with(['model'=>new Page(),'orderPages'=>Page::defaultOrder()->withDepth()->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $page=Auth::user()->pages()->save(new Page($request->only(['title','url','content'])));
        $this->updatePageOrder($page,$request);
        return redirect()->route('pages.index')->with('status',"Page $request->title was successfully created");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $page=Page::findOrFail($page->id);
        if(Auth::user()->cant('update',$page)){
            return redirect()->route('pages.index')->with('status',"You are not authorized to update this page");
        }
        return view('admin.pages.edit',['model'=>$page,'orderPages'=>Page::defaultOrder()->withDepth()->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
       // dd($page);
        if(Auth::user()->cant('update',$page)){
            return redirect()->route('pages.index')->with('status',"You are not authorized to update this page");
        }
        if($response=$this->updatePageOrder($page,$request)){
            return $response;
        }
        $page->fill($request->only(['title','url','content']));
        $page->save();
        return redirect()->route('pages.index')->with('status',"Page $page->title was successfully updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        if(Auth::user()->cant('delete',$page)){
            return redirect()->route('pages.index');
        }
        $page->delete();
        return redirect()->route('pages.index')->with('status',"Page $page->title is successfully delete");
    }

    protected function updatePageOrder(Page $page, Request $request){
        if($request->has('order','orderPage')){
            if($page->id==$request->orderPage){
                return redirect()->route('pages.edit',['page'=>$page->id])->withInput()
                ->withErrors(['error'=>'Cannot update a page against itself']);
            }
            $page->updateOrder($request->order, $request->orderPage);
        }
    }
}
