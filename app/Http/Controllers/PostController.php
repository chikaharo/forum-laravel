<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Topic;
use App\Notifications\TopicReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;
use Inertia\Inertia;

class PostController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        //
        // $data = $request->validated();
        $data = $request->validated();

        if(isset($data['image']) && preg_match('/^data:image\/(\w+);base64,/', $data['image'])) {
            $relativePath = $this->saveImage($data['image']);
            $data['image'] = $relativePath;
        }
        $post = Post::create($data);
        $topic = Topic::query()->where('id', $data['topic_id'])->first();

        if($topic->notify) {
            $topic->user->notify(
                new TopicReminder($post)
            );
        }

        return back()->with('success', 'Topic was created');
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
    public function edit(Post $post)
    {
        //
        return Inertia::render('Post/EditPost', [
            'post' => new PostResource($post),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        //
        $user = $request->user();
        if($user->id !== $post->user_id) {
            return abort(403, 'Unauthorized');
        }
        $data = $request->validated();
        if(isset($data['image']) && preg_match('/^data:image\/(\w+);base64,/', $data['image'])) {
            $relativePath = $this->saveImage($data['image']);
            $data['image'] = $relativePath;

            if($post->image) {
                $absolutePath = public_path($post->image);
                File::delete($absolutePath);
            }
        }
        $post->update($data);
        $redirectTopic = Topic::query()->where('id', $data['topic_id'])->first();
        return redirect()->route('topic.show', $redirectTopic->slug)->with('message', 'Post was updated');
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
