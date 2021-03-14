@extends('layouts.backend.master')

@section('title','Create Category')

@push('css')
@endpush

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Create Category</h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" class="form-control" name="name">
                                <label class="form-label">Category Name</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="file" accept="image/*" name="image">
                        </div>
                        <a href="{{ route('admin.category.index') }}" type="button" class="btn btn-danger m-l-5 m-t-15 waves-effect"><i class="material-icons">arrow_back</i> Back</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit <i class="material-icons">check</i></button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
