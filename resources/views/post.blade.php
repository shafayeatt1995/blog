@extends('layouts.frontend.master')

@section('title')
    {{ $post->title }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/single-post/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/single-post/responsive.css') }}">
    <style>
        .slider {
            background-image: url("{{ Storage::disk('public')->url('post/'.$post->image) }}")
        }
    </style>
@endpush

@section('content')
    <div class="slider">
        <div class="display-table  center-text">
            <h1 class="title display-table-cell"><b></b></h1>
        </div>
    </div><!-- slider -->

    <section class="post-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="{{ route('author.profile',$post->user->username) }}"><img
                                            src="{{ Storage::disk('public')->url('user/'.$post->user->image) }}"
                                            alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{ $post->user->name }}</b></a>
                                    <h6 class="date"> on {{ $post->created_at->diffForHumans() }}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><a href="#"><b>{{ $post->title }}</b></a></h3>

                            <p class="para">{!! $post->body !!}</p>

                            <ul class="tags">
                                @foreach($post->tags as $tag)
                                    <li><a href="{{ route('post.tag',$tag->slug) }}">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">
                                <li>
                                    @guest
                                        <a href="javascript:void(0);"
                                           onclick="toastr.info('To add favorite list you need to login first','Info',{closeButton : true,})">
                                            <i class="ion-heart"></i>
                                            {{ $post->favorit_to_users->count() }}</a>
                                    @else
                                        <a class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count() == 0 ? 'favorite-post':'' }}"
                                           href="javascript:void(0);"
                                           onclick="document.getElementById('favorit-form-{{ $post->id }}').submit()"><i
                                                class="ion-heart"></i>{{ $post->favorit_to_users->count() }}</a>
                                        <form id="favorit-form-{{ $post->id }}"
                                              action="{{ route('post.favorite',$post->id) }}" style="display: none;"
                                              method="POST">@csrf</form>
                                    @endguest
                                </li>
                                <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE :</li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                            </ul>
                        </div>

                        <div class="post-footer post-info">

                            <div class="left-area">
                                <a class="avatar" href="#"><img
                                        src="{{ Storage::disk('public')->url('user/'.$post->user->image) }}"
                                        alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>{{ $post->user->name }}</b></a>
                                <h6 class="date"> on {{ $post->created_at->diffForHumans() }}</h6>
                            </div>

                        </div><!-- post-info -->


                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>About Author</b></h4>
                            <p>{{ $post->user->about }}</p>
                        </div>

                        <div class="sidebar-area subscribe-area">

                            <h4 class="title"><b>SUBSCRIBE</b></h4>
                            <div class="input-area">
                                <form action="{{ route('subscriber.store') }}" method="POST">
                                    @csrf
                                    <input class="email-input" type="email" name="email" placeholder="Enter your email">
                                    <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i>
                                    </button>
                                </form>
                            </div>

                        </div><!-- subscribe-area -->

                        <div class="tag-area">

                            <h4 class="title"><b>Category</b></h4>
                            <ul>
                                @foreach($post->categories as $category )
                                    <li><a href="{{ route('post.category',$category->slug) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">
                @foreach($randomPosts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img
                                        src="{{ Storage::disk('public')->url('post/'.$post->image) }}"
                                        alt="{{ $post->title }}"></div>

                                <a class="avatar" href="#"><img
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
                                                        class="ion-heart"></i>{{ $post->favorit_to_users->count() }}</a>
                                                <form id="favorit-form-{{ $post->id }}"
                                                      action="{{ route('post.favorite',$post->id) }}"
                                                      style="display: none;" method="POST">@csrf</form>
                                            @endguest
                                        </li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>

                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div>
                @endforeach
            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section">
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    @guest()
                        <div class="comment-form">
                            <p>You Need To <a class="bold" href="{{ route('login') }}">Login</a> First For Post A New Comment</p>
                        </div>
                    @else
                        <div class="comment-form">
                            <form method="post" action="{{ route('comment.store',$post->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment" aria-required="true"
                                              aria-invalid="false"></textarea>
                                    </div><!-- col-sm-12 -->
                                    <div class="col-sm-12">
                                        <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b>
                                        </button>
                                    </div><!-- col-sm-12 -->

                                </div><!-- row -->
                            </form>
                        </div><!-- comment-form -->
                    @endguest

                        <h4><b>COMMENTS({{ $post->comments->count() }})</b></h4>
                        @if($post->comments->count() > 0)
                            @foreach($post->comments as $comment)
                                <div class="commnets-area ">

                                    <div class="comment">

                                        <div class="post-info">

                                            <div class="left-area">
                                                <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('user/'.$comment->user->image) }}" alt="Profile Image"></a>
                                            </div>

                                            <div class="middle-area">
                                                <a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
                                                <h6 class="date">on {{ $comment->created_at->diffForHumans() }}</h6>
                                            </div>

                                        </div><!-- post-info -->

                                        <p>{{ $comment->comment }}</p>

                                    </div>

                                </div><!-- commnets-area -->
                            @endforeach
                        @else
                            <div class="commnets-area ">
                                <div class="comment">
                                    <p>No Comment Found For This Post :(</p>
                                </div>
                            </div>
                        @endif

                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>
@endsection

@push('js')

@endpush
