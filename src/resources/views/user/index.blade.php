@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($all_user as $user)
                <div class="card">
                    <div class="card-haeder p-3 w-100 d-flex">
                        <img src="{{ $user->image_picture }}" class="rounded-circle" width="50" height="50">
                        <div class="ml-2 d-flex flex-column">
                            <p class="mb-0">{{ $user->name }}</p>
                            <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->handle_name }}</a>
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