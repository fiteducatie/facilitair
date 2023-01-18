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
        //
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
            'categories' => \App\Models\Category::all()
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
        foreach($request->file as $file) {
            $pin->addMedia($file)->toMediaCollection('images');
        }
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
