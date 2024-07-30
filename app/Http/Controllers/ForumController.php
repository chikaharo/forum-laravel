<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForumRequest;
use App\Http\Resources\TopicResource;
use App\Models\Category;
use App\Models\Forum;
use App\Models\Topic;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //  public function __construct()
    // {

    //     $this->middleware('auth')->only(['store','update','edit','create', 'destroy']);
    // }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::latest()->get();
        return Inertia::render('Forum/CreateForum', [
            'categories' => $categories
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ForumRequest $request)
    {
        //
        Forum::create($request->validated());

        return response('Forum was created', 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Forum $forum)
    {
        //
        $filters = $request->only(['title', 'filterBy', 'filterType']);
        // $topics = Topic::query()->where('forum_id', $forum->id)->with(['user', 'forum'])->paginate(10);
        $query = Topic::query()->where('forum_id', $forum->id)->filter($filters);
        return Inertia::render('Forum/ViewForum', [
            'forum' => Forum::query()->where('id', $forum->id)->with([ 'category'])->first(),
            'topics' => TopicResource::collection($query->paginate(10)->withQueryString()),
            'filters' => $filters
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
