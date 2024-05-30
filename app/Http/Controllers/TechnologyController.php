<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $techList=Technology::all();
        return view('admin.technologies.index',compact('techList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        //dd($request->all());
        //validare
        $validate = $request->validated();
        //dd($validate);

        //creare-salvare
        $validate['slug'] = Str::slug($request->name, '-');
        Technology::create($validate);
        //indirizzare
        return to_route('admin.technologies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show',compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        //dd($request->all());
        $validate = $request->validated();

        $validate['slug'] = Str::slug($request->name, '-');
        $technology->update($validate);

        return to_route('admin.technologies.index')->with('message', 'Post created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return to_route('admin.technologies.index');
    }
}
