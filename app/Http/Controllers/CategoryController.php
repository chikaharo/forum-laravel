<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('Category/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //
        // dd($request);
        $data = $request->validated();
        if(!isset($data['image'])) {
            $data['image'] = 'https://icons.veryicon.com/png/o/miscellaneous/fu-jia-intranet/forum-15.png';
        }
        Category::create($data);
        // ->created_by()->associate($request->user());
        return redirect('/')->with('success', 'Category was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        return Inertia::render('Category/ViewCategory', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return Inertia::render('Category/EditCategory', ['category' => $category]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        return redirect()->back()->with('message', 'Delete category successfully');
    }
}
