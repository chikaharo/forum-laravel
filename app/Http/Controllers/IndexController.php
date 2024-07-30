<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    //
    public function show()
    {
        $categories = Category::latest()->get();
        dd($categories);
        return Inertia::render('Home', [
            'categories' => $categories
        ]);
    }
}
