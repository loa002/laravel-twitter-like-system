@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ url('user/' .$user->id) }}" enctype='multipart/form-data'>
                {{ csrf_field() }}
                @method('PATCH')

                <div class="mb-2">
                    <p class="mb-0">名前</p>
                    <input type="text" name="name" value="{{ $user->name }}" class="@error('name') is-invalid @enderror">
                    @error('name')
                    <span class="invalid-feedback alert alert-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <p class="mb-0">ニックネーム</p>
                    <input type="text" name="handle_name" value="{{ $user->handle_name }}">
                </div>
                <div class="mb-2">
                    <p class="mb-0">メールアドレス</p>
                    <input type="text" name="email" value="{{ $user->email }}">
                </div>
                <div class="mb-2">
                    <p class="mb-0">画像</p>
                    <img src="{{ asset('storage/image_picture/' . $user->image_picture) }}" class="rounded-circle" width="100" height="100">
                    <input type="file" name="image_picture" class="@error('image_picture') is-invalid @enderror">
                    @error('image_picture')
                        <span class="alert alert-danger"></span>
                    @enderror
                </div>
                <button type="submit">更新する</button>
            </form>
        </div>
    </div>
</div>
@endsection