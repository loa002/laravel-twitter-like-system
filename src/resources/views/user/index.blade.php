@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($all_user as $user)
                <div class="card">
                    <div class="card-haeder d-flex flex-row justify-content-between">
                        <div class="profile_info">
                            <img src="{{ asset('storage/image_picture/' . $user->image_picture) }}" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $user->name }}</p>
                                <a href="{{ url('user/' .$user->id) }}">{{ $user->handle_name }}</a>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            @if (Auth::user()->followed_judge($user->id))
                                <p>フォローされています</p>
                            @else
                                <p>フォローされていません</p>
                            @endif
                            @unless (Auth::user()->following_judge($user->id))
                                <form method="POST" action="{{ route('user.follow', ['user' => $user]) }}">
                                    {{ csrf_field() }}
                                    <button type="submit">フォローする</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('user.unfollow', ['user' => $user]) }}">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button type="submit">フォロー解除</button>
                                </form>
                            @endunless
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $all_user->links() }}
    </div>
</div>
@endsection