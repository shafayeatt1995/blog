@extends('layouts.backend.master')

@section('title','Edit Tag')

@push('css')
@endpush

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Edit Tag</h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.tag.update',$tag->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    <label for="email_address">Edit Tag</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" value="{{ $tag->name }}">
                        </div>
                    </div>
                    <a href="{{ route('admin.tag.index') }}" class="btn btn-danger waves-effect m-r-10"><i class="material-icons">arrow_back</i> Back</a>
                    <button type="submit" class="btn btn-primary waves-effect">Submit <i class="material-icons">check</i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
