<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\ClassModel;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $classes = ClassModel::all();
        return view('admin.class.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);
        $class = ClassModel::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.classes.index')->with('success', 'Class created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $class = ClassModel::find($id);
        return view('admin.class.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $class = ClassModel::find($id);
        
        $class->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.classes.index')->with('success', 'Class created successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $class = ClassModel::find($id);
        $class->delete();
        return redirect()->route('admin.classes.index')->with('success', 'Class deleted successfully');
    }
}
