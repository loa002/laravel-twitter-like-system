@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-haeder d-flex">
                    <img src="{{ asset('storage/image_picture/' . $laraat->user->image_picture) }}" class="rounded-circle" width="30" height="30">
                    <div class="ml-2 d-flex flex-column">
                        <p class="mb-0">{{ $laraat->user->name }}</p>
                        <a href="{{ url('user/' .$laraat->user->id) }}">{{ $laraat->user->handle_name }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <p>{{ $laraat->txt_content }}</p>
                </div>
                @if ($laraat->user->id == Auth::id())
                    <a href="{{ url('laraat/' . $laraat->id . '/edit') }}" class="btn btn-md btn-primary">このツイートを編集する</a>
                @endif
            </div>
            <div class="comment mt-5">
                <p>コメント一覧</p>
                @if ($comments->count())
                    @foreach ($comments as $comment)
                        <div class="card">
                            <div class="card-haeder d-flex">
                                <img src="{{ asset('storage/image_picture/' . $comment->user->image_picture) }}" class="rounded-circle" width="30" height="30">
                                <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">{{ $comment->user->name }}</p>
                                    <a href="{{ url('user/' .$comment->user->id) }}">{{ $comment->user->handle_name }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>{{ $comment->txt_content }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card">
                        <p>コメントなし</p>
                    </div>
                @endif
                <form method="POST" action="{{ route('comments.store') }}">
                    @csrf
                    
                    <input type="hidden" name="laraat_id" value="{{ $laraat->id }}">
                    <textarea class="form-control @error('txt_content') is-invalid @enderror" name="txt_content" id="" cols="30" rows="5" required autocomplete="txt_content" autofocus>{{ old('txt_content') }}</textarea>  
                    
                    @error('txt_content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection