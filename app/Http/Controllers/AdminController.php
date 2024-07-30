<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUsersRequest;
use App\Http\Requests\ForumRequest;
use App\Http\Resources\ForumResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Forum;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AdminController extends Controller
{
    //
    public function index() {
        $usersCount = User::count();
        $categoriesCount = Category::count();
        $forumsCount = Forum::count();
        $topicCount = Topic::count();

        return Inertia::render('Admin/Index', [
            'usersCount' => $usersCount,
            'categoriesCount' => $categoriesCount,
            'forumsCount' => $forumsCount,
            'topicsCount' => $topicCount
        ]);
    }

    public function categoriesIndex() {
        $categories = Category::query()->latest()->paginate(10);

        return Inertia::render('Admin/Categories', [
            'categories' => $categories
        ]);
    }

    public function usersIndex() {
        $users = User::query()->latest()->paginate(10);
        
        return Inertia::render('Admin/Users', [
            'users' => $users
        ]);
    }

    public function usersEdit( User $user) {
        return Inertia::render('Admin/EditUser', [
            'user' => new UserResource($user) 
        ]);

    }

    public function usersUpdate(AdminUsersRequest $request, User $user) {
        if(!$user) {
            return abort(404, 'User not found');
        }
        $data = $request->validated();
        if(isset($data['image']) && preg_match('/^data:image\/(\w+);base64,/', $data['image'])) {
            $relativePath = $this->saveImage($data['image']);
            $data['image'] = $relativePath;

            if($user->image) {
                $absolutePath = public_path($user->image);
                File::delete($absolutePath);
            }
        }
        $user->update($data);
        return redirect()->back()->with('message', 'Updated user successfully');
    }

    public function forumsIndex() {
        $forums = Forum::query()->latest()->paginate(10);

        return Inertia::render('Admin/Forums', [
            'forums' => ForumResource::collection($forums)
        ]);
    }

    public function forumsEdit(Forum $forum) {
        return Inertia::render('Admin/ForumsEdit', [
            'forum' => new ForumResource($forum),
            'categories' => Category::all()
        ]);
    }

    public function forumsUpdate(ForumRequest $request, Forum $forum) {
        if(!$forum) {
            return abort(404, 'Forum is not found');
        }

        $data = $request->validated();
        // dd($data);
        $forum->update($data);

        return redirect(route('admin.forums'))->with('message', 'Update Forum Successfully');
        
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
