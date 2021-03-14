@extends('layouts.backend.master')

@section('title','Subscriber')

@push('css')
    <!-- Multi Select Css -->
    <link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="row clearfix">
        <!-- Tabs With Icon Title -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Setting</h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#profile" data-toggle="tab">
                                    <i class="material-icons">face</i> PROFILE
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#password" data-toggle="tab">
                                    <i class="material-icons">vpn_key</i> PASSWORD
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#theme" data-toggle="tab">
                                    <i class="material-icons">color_lens</i> THEME
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="profile">
                                <!-- Horizontal Layout -->
                                <div class="card">
                                    <div class="body">
                                        <form class="form-horizontal" method="post"
                                              action="{{ route('admin.profile.update') }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="name">Name</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="Enter your Name"
                                                                   value="{{ Auth::user()->name }}" name="name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="email_address">Email Address</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="email_address"
                                                                   class="form-control"
                                                                   placeholder="Enter your email address"
                                                                   value="{{ Auth::user()->email }}" name="email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="image">Image</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <input type="file" accept="image/*" id="image"
                                                               class="form-control" name="image">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="about">About</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <textarea name="about" id="about" cols="30" rows="5"
                                                                      class="form-control no-resize"
                                                                      aria-required="true">{{ Auth::user()->about }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div
                                                    class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                    <button type="submit"
                                                            class="btn btn-primary m-t-15 waves-effect">Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- #END# Horizontal Layout -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="password">

                                <form class="form-horizontal" method="post"
                                      action="{{ route('admin.password.update') }}">
                                    @csrf
                                    @method('put')
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="old_password">Old Password : </label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="old_password" class="form-control"
                                                           placeholder="Old Password" name="old_password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="password">New Password : </label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="password" class="form-control"
                                                           placeholder="New Password" name="password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="password_confirmation">Confirm Password : </label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="password_confirmation"
                                                           class="form-control"
                                                           placeholder="Confirm Password" name="password_confirmation">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div
                                            class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                            <button type="submit"
                                                    class="btn btn-primary m-t-15 waves-effect">Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="theme">
                                <div class="card">
                                    <div class="body">
                                        <form class="form-horizontal" method="post"
                                              action="{{ route('admin.update.theme') }}">
                                            @csrf
                                            @method('put')
                                            <div class="row clearfix">
                                                <p>
                                                    <b>Theme</b>
                                                </p>
                                                <select class="form-control show-tick" name="class">
                                                    @foreach($themes as $theme)
                                                        <option
                                                            value="{{ $theme->class }}">{{ $theme->name }}</option>
                                                    @endforeach
                                                </select>
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-info">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Tabs With Icon Title -->
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
@endpush
