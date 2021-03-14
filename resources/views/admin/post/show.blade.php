@extends('layouts.backend.master')

@section('title','Create Post')

@push('css')

@endpush

@section('content')
    <div class="row clearfix">
        <div class="cta-aria">
            <a href="{{ route('admin.post.index') }}" class="btn btn-danger waves-effect"><i class="material-icons">arrow_back</i>
                Back</a>
            @if( $post->is_approved == true )
                <button type="button" class="btn btn-success waves-effect float-right" disabled>Approved</button>
            @else
                <button type="submit" name="is_approve" class="btn btn-success waves-effect float-right"
                        onclick="approvePost({{ $post->id }})"><i class="material-icons">done</i> Approve
                </button>

                <form action="{{ route('admin.post.approve',$post->id) }}" id="approval-form" method="POST" style="display: none;">
                    @csrf
                    @method('PUT')
                </form>
            @endif
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
    <script type="text/javascript">
        function approvePost(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure you want to approve this post!',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approval-form').submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'This post still pending :)',
                        'info'
                    )
                }
            })
        }
    </script>
@endpush
