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
            </div>
        </div>
    </div>
</div>
@endsection