@extends('layouts.backend.master')

@section('title','Create Post')

@push('css')

@endpush

@section('content')
    <div class="row clearfix">
        <div class="cta-aria">
                <a href="{{ route('author.post.index') }}" class="btn btn-danger waves-effect">Back</a>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h2>{{ $post->title }}</h2>
                    <small>Posted By <strong><a href="">{{ $post->user->name }}</a></strong>
                        on {{ $post->created_at->toFormattedDateString() }} </small>
                </div>
                <div class="body">
                    <p>{!! $post->body !!}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>Category</h2>
                </div>
                <div class="body">
                    @foreach($post->categories as $category)
                        <span class="label bg-cyan">{{ $category->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-deep-orange">
                    <h2>Tag</h2>
                </div>
                <div class="body">
                    @foreach($post->tags as $tag)
                        <span class="label bg-cyan">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-yellow">
                    <h2>Feature Image</h2>
                </div>
                <div class="body">
                    <img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" class="img-responsive thumbnail"
                         alt="">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
