<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $posts_amount = Cache::remember(
            'amount.posts.' . $user->id, 
            now()->addSeconds(30), 
            function() use ($user) {
                return $user->posts->count();
            }
        );

        $followers_amount = Cache::remember(
            'amount.followers.' . $user->id, 
            now()->addSeconds(30), 
            function() use ($user) {
                return $user->profile->followers->count();
            }
        );

        $following_amount = Cache::remember(
            'amount.following.' . $user->id, 
            now()->addSeconds(30), 
            function() use ($user) {
                return $user->following->count();
            }
        );

        return view('profiles.index', compact('user', 'follows', 'posts_amount', 'followers_amount', 'following_amount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => '',
            'description' => '',
            'url' => '',
            'image' => 'image'
        ]);

        if(request('image')) {
            $image_path = request('image')->store('uploads', 'public');
            
            $image = Image::make(public_path("storage/{$image_path}"))->fit(1000, 1000);
            $image->save();

            $image_array = ['image' => $image_path];
        } else {
            $image_array = [];
        }
        auth()->user()->profile->update(array_merge($data, $image_array));
        
        return redirect("/profile/{$user->id}");
    }
}
