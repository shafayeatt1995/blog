@extends('layouts.frontend.master')

@section('title','Author Post')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/author/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/author/responsive.css') }}">
@endpush

@section('content')
    <div class="slider display-table center-text"
         style="background-image: url('{{asset('frontend/images/slider-1.jpg')}}')">
        <h1 class="title display-table-cell"><b>{{ $author->name }} All Posts</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        @if($posts->count() < 0)
                            <div class="card">
                                <h2 class="center-text">No Post Found</h2>
                            </div>
                        @else
                        @foreach($posts as $post)
                            <div class="col-md-6 col-sm-12">
                                <div class="card h-100">
                                    <div class="single-post post-style-1">

                                        <div class="blog-image"><img
                                                src="{{ Storage::disk('public')->url('post/'.$post->image) }}"
                                                alt="{{ $post->title }}"></div>

                                        <a class="avatar"
                                           href="{{ route('author.profile',$post->user->username) }}"><img
                                                src="{{ Storage::disk('public')->url('user/'.$post->user->image) }}"
                                                alt="Profile Image"></a>

                                        <div class="blog-info">

                                            <h4 class="title"><a
                                                    href="{{ route('post.details',$post->slug) }}"><b>{{ $post->title }}</b></a>
                                            </h4>

                                            <ul class="post-footer">
                                                <li>
                                                    @guest
                                                        <a href="javascript:void(0);" onclick="toastr.info('To add favorite list you need to login first','Info',{
                                                    closeButton : true,
                                                })"><i class="ion-heart"></i>{{ $post->favorit_to_users->count() }}</a>
                                                    @else
                                                        <a class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count() == 0 ? 'favorite-post':'' }}"
                                                           href="javascript:void(0);"
                                                           onclick="document.getElementById('favorit-form-{{ $post->id }}').submit()"><i
                                                                class="ion-heart"></i>{{ $post->favorit_to_users->count() }}
                                                        </a>
                                                        <form id="favorit-form-{{ $post->id }}"
                                                              action="{{ route('post.favorite',$post->id) }}"
                                                              style="display: none;" method="POST">@csrf</form>
                                                    @endguest
                                                </li>
                                                <li><a href="#"><i
                                                            class="ion-chatbubble"></i>{{ $post->comments->count() }}
                                                    </a></li>
                                                <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>

                                            </ul>

                                        </div><!-- blog-info -->
                                    </div><!-- single-post -->
                                </div><!-- card -->
                            </div><!-- col-md-6 col-sm-12 -->
                        @endforeach
                        @endif

                    </div><!-- row -->

                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 ">

                    <div class="single-post info-area ">

                        <div class="about-area">
                            <h4 class="title"><b>ABOUT  {{ $author->name }}</b></h4>
                            <p>{{ $author->about }}</p>
                            <br>
                            <br>
                            <p><strong>Author Since: {{ $author->created_at->diffForHumans() }}</strong></p>
                            <p><strong>Total Post: {{ $author->posts->count() }}</strong></p>
                        </div>

                        <div class="subscribe-area">

                            <h4 class="title"><b>SUBSCRIBE</b></h4>
                            <div class="input-area">
                                <form action="{{ route('subscriber.store') }}" method="POST">
                                    @csrf
                                    <input class="email-input" type="email" name="email" placeholder="Enter your email">
                                    <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline envelope-icon"></i>
                                    </button>
                                </form>
                            </div>

                        </div><!-- subscribe-area -->

                        <div class="tag-area">

                            <h4 class="title"><b>TAG CLOUD</b></h4>
                            <ul>
                                @foreach($posts as $post)
                                    @foreach($post->tags as $tag)
                                    <li><a href="{{ route('post.tag',$tag->slug) }}">{{ $tag->name }}</a></li>
                                    @endforeach
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- section -->

@endsection

@push('js')

@endpush
