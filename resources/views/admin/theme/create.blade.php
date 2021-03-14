@extends('layouts.backend.master')

@section('title','Create Theme')

@push('css')
@endpush

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Create Theme</h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.theme.store') }}" method="POST">
                        @csrf
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" class="form-control" name="name">
                                <label class="form-label">Theme Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="class" class="form-control" name="class">
                                <label class="form-label">Theme Class</label>
                            </div>
                        </div>
                        <a href="{{ route('admin.theme.index') }}" type="button" class="btn btn-danger m-l-5 m-t-15 waves-effect"><i class="material-icons">arrow_back</i> Back</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit <i class="material-icons">check</i></button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
