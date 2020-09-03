@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-haeder">ツイート投稿</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('laraat.store') }}">
                        @csrf

                        <div class="profile-info">
                            <img src="{{ asset('storage/image_picture/' . $user->image_picture) }}" class="rounded-circle" width="30" height="30">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $user->name }}</p>
                                <a href="{{ url('user/' .$user->id) }}">{{ $user->handle_name }}</a>
                            </div>
                        </div>
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
</div>
@endsection