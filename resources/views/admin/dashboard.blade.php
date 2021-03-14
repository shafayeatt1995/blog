@extends('layouts.backend.master')

@section('title','Dashboard')

@push('css')
@endpush

@section('content')
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text text-uppercase">Total posts</div>
                    <div class="number count-to" data-from="0" data-to="{{ $posts->count() }}" data-speed="15"
                         data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">favorite</i>
                </div>
                <div class="content">
                    <div class="text text-uppercase">Total Favorite Post</div>
                    <div class="number count-to" data-from="0" data-to="{{ Auth::user()->favorite_posts() ->count()}}"
                         data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">library_books</i>
                </div>
                <div class="content">
                    <div class="text text-uppercase">Pending post</div>
                    <div class="number count-to" data-from="0" data-to="{{ $total_pending_posts }}" data-speed="1000"
                         data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text text-uppercase">Total Views</div>
                    <div class="number count-to" data-from="0" data-to="{{ $all_views }}" data-speed="1000"
                         data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-3">

            <div class="row">
                <div class="info-box bg-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">apps</i>
                    </div>
                    <div class="content">
                        <div class="text text-uppercase">Categories</div>
                        <div class="number count-to" data-from="0" data-to="{{ $category_count }}" data-speed="15"
                             data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="info-box bg-yellow hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">label</i>
                    </div>
                    <div class="content">
                        <div class="text text-uppercase">Tags</div>
                        <div class="number count-to" data-from="0" data-to="{{ $tag_count }}" data-speed="15"
                             data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">account_circle</i>
                    </div>
                    <div class="content">
                        <div class="text text-uppercase">Total Author</div>
                        <div class="number count-to" data-from="0" data-to="{{ $author_count }}" data-speed="15"
                             data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="info-box bg-purple hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">fiber_new</i>
                    </div>
                    <div class="content">
                        <div class="text text-uppercase">Today Author</div>
                        <div class="number count-to" data-from="0" data-to="{{ $new_authors_today }}" data-speed="15"
                             data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Most popular Post</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>View</th>
                                        <th>Favorite</th>
                                        <th>Comment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($popular_posts as $key=>$post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($post->title,'25') }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>{{ $post->view_count }}</td>
                                            <td>{{ $post->favorit_to_users->count() }}</td>
                                            <td>{{ $post->comments->count() }}</td>
                                            <td>
                                                @if($post->status == true)
                                                    <span class="label bg-green">Published</span>
                                                @else
                                                    <span class="label bg-pink">Pending</span>
                                                @endif
                                            </td>
                                            <td><a href="{{ route('post.details',$post->slug) }}" class="btn btn-info waves-effect" target="_blank"><i class="material-icons">visibility</i></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->

@endsection

@push('js')
    <script src="{{ asset('backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>
    <script src="{{ asset('backend/js/pages/index.js') }}"></script>

@endpush
