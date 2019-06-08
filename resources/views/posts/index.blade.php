@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
    <div class="row">
        <div class="col-6 offset-3">
            <div class="d-flex align-items-center pb-2">
                <div class="pr-3">
                    <a href="/profile/{{ $post->user->id }}">
                        <img class="rounded-circle w-100" src="{{ $post->user->profile->profileImage() }}" alt="" style="max-width: 40px;">
                    </a>
                </div>
                <div class="font-weight-bold">
                    <a href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">{{ $post->user->username }}</span>
                    </a>
                    <a class="pl-3" href="#">Follow</a>
                </div>
            </div>
            <a href="/p/{{ $post->id }}">
                <img class="w-100" src="/storage/{{ $post->image }}" alt="">
            </a>
        </div>
    </div>
    <div class="row pt-2 pb-4">
        <div class="col-6 offset-3">
            <p>
                <span class="font-weight-bold">
                    <a href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">{{ $post->user->username }}</span>
                    </a>
                </span>
                <span>{{ $post->caption }}</span>
            </p>
        </div>
    </div>
    @endforeach

    <div class="row">
        <div class="col-12 d-flex justify-content-center">{{ $posts->links() }}</div>
    </div>
</div>
@endsection
