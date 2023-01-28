<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Models\Tag;
use Illuminate\Http\Request;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->get('c')) {
            $category = \App\Models\Category::where('id', request()->get('c'))->first();
            // dd($category);
            $pins = $category->pins;

        } else if(request()->get('t')) {
            $pins = \App\Models\Pin::withAnyTags(request()->get('t'))->get();

        } else if(request()->get('s')) {
            $pins = \App\Models\Pin::where('title', 'like', '%'.request()->get('s').'%')->get();
            $pinsFromTag = \App\Models\Pin::withAnyTags(request()->get('s'))->get();
            if ($pinsFromTag) {
                $pins[] = $pinsFromTag;
            }

            $pins = collect($pins)->flatten()->unique('id');

        } else {
            $pins = \App\Models\Pin::all();
        }

        return view('welcome', [
            'pins' => $pins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pins.create',[
            'tags' => \Spatie\Tags\Tag::all(),
            'categories' => \App\Models\Category::where('parent_category_id', null)->with('subcategories')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'file.*' => 'required|image',
            'description' => 'required',
            'category' => 'required',
        ]);

        $pin = Pin::create([
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->description,
            'user_id' => auth()->user()->id,
            'slug' => \Str::slug($request->title),
        ]);
        $pin->categories()->attach($request->category);
        $pin->attachTags($this->stripTags($request->tags));

        foreach($request->file as $file) {
            $pin->addMedia($file)->toMediaCollection('images');
        }
    }

    public function stripTags(string $tags) {
        $tags = explode(',', $tags);
        $tags = array_map('trim', $tags);
        $tags = array_map(function($val){
            return ltrim($val, '#');
        }, $tags);
        $tags = array_map('strtolower', $tags);
        $tags = array_unique($tags);
        return $tags;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function show(Pin $pin)
    {
        return view('pins.show', [
            'pin' => $pin
        ]);
    }

    public function favorites() {
        return view('favorites', [
            'pins' => auth()->user()->favorites
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function edit(Pin $pin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pin $pin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pin $pin)
    {
        $pin->delete();
        return redirect()->route('welcome');
    }
}
