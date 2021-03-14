@extends('layouts.backend.master')

@section('title','Create Post')

@push('css')
    <!-- Multi Select Css -->
    <link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="row clearfix">
        <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h2>Add New Post</h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="title">
                                <label class="form-label">Post Title</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Feature Image</label>
                            <input type="file" accept="image/*" name="image">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="published" class="filled-in" name="status" value="1">
                            <label for="published">Published</label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="header">
                        <h2>Category & Tag</h2>
                    </div>
                    <div class="body">
                        <div class="form-group">
                            <div class="form-line {{ $errors->has('categories')?'focused error':'' }}">
                                <label for="category">Select Category</label>
                                <select name="categories[]" id="category" class="form-control show-tick"
                                        multiple>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line {{ $errors->has('tags')?'focused error':'' }}">
                                <label for="tag">Select Tag</label>
                                <select name="tags[]" id="tag" class="form-control show-tick"
                                        multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-line">
                            <a href="{{ route('admin.post.index') }}" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i> Back</a>
                            <button type="submit" class="btn btn-primary waves-effect pull-right">Submit  <i class="material-icons">check</i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="body">
                            <textarea id="tinymce" name="body"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('backend/plugins/tinymce/tinymce.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('backend/plugins/tinymce') }}';
        });
    </script>

@endpush
