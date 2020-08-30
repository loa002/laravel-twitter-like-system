@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-haeder d-flex flex-row justify-content-between">
                    <div class="profile_info">
                        <img src="{{ asset('storage/image_picture/' . $user->image_picture) }}" class="rounded-circle" width="100" height="100">
                        <div class="ml-2 d-flex flex-column">
                            <p class="mb-0">{{ $user->name }}</p>
                            <p>{{ $user->handle_name }}</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        @if (Auth::id() != $user->id)
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
                        @else
                            <a href="{{ url('user/' . Auth::id() . '/edit') }}">プロフィール編集</a>
                        @endif
                        <p>ララート数：{{ $laraat_count }}</p>
                        <p>フォロー数：{{ $following_count }}</p>
                        <p>フォロワー数：{{ $followed_count }}</p>
                    </div>
                </div>
            </div>
            @foreach ($all_laraat_of_user as $laraat)
                <div class="card">
                    <div class="card-header">
                        {{ $laraat->txt_content }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $all_laraat_of_user->links() }}
    </div>
</div>
@endsection