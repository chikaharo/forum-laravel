<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Forum;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str; 

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Forum $forum)
    {
        //
        return Inertia::render('Topic/CreateTopic', [
            'forum' => $forum->with('category')->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TopicRequest $request)
    {
        //
        $data = $request->validated();

        if(isset($data['image']) && preg_match('/^data:image\/(\w+);base64,/', $data['image'])) {
            $relativePath = $this->saveImage($data['image']);
            $data['image'] = $relativePath;
        }
        Topic::create($data);
        $forum = Forum::query()->where('id', $data['forum_id'])->first();

        return redirect('/forum/'. $forum->slug)->with('success', 'Topic was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        //
        if(isset($topic)) {
            $topic->increment('views', 1);
        }
        $posts = Post::query()->where('topic_id', $topic->id)->oldest('created_at')->with(['user', 'topic'])->paginate(10);

        // return Inertia::render('Topic/ViewTopic', ['topic' => $topic->with(['user', 'forum', 'forum.category'])->first(), 'posts' => $posts]);
        return Inertia::render('Topic/ViewTopic', ['topic' => new TopicResource($topic), 'posts' => $posts]);

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

    private function saveImage($image) {
        if(preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $image = substr($image, strpos($image, ',') + 1);
            $type = strtolower($type[1]);

            if(!in_array($type, ['jpg', 'png', 'jpeg', 'gif'])) {
                throw new \Exception('invalid image type');
            }

            // $image = str_replace($image, ' ', '+');
            $image = base64_decode($image);
            if(!$image) {
                throw new \Exception('base64 decode failed');
            }

            
        } else {
            throw new \Exception('did not match data URI with image data');
        }
        $dir = 'images/';
            $file = Str::random(12) . "." . $type;
            $absolutePath = public_path($dir);
            $relativePath = $dir . $file;
            if(!File::exists($absolutePath)) {
                File::makeDirectory($absolutePath, 0755, true);
            }
            file_put_contents($relativePath, $image);
            return $relativePath; 
    }
}
