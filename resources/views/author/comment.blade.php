@extends('layouts.backend.master')

@section('title','Comment')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
          rel="stylesheet">
@endpush

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>All Comments</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable"
                                   id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                                <thead>
                                <tr role="row">
                                    <th class="text-center">Sl. No</th>
                                    <th class="text-center">Comment Info</th>
                                    <th class="text-center">Post Info</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th class="text-center">Sl. No</th>
                                    <th class="text-center">Comment Info</th>
                                    <th class="text-center">Post Info</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($posts as $key=>$post)
                                @foreach($post->comments as $key=>$comment)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="{{ Storage::disk('public')->url('user/'.$comment->user->image) }}" width="64" height="64">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at->diffForHumans() }}</small>
                                                    </h4>
                                                    <p>{{ $comment->comment }}</p>
                                                    <a target="_blank" href="{{ route('post.details',$comment->post->slug.'#comments') }}">Reply</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-right">
                                                    <a target="_blank" href="{{ route('post.details',$comment->post->slug) }}">
                                                        <img class="media-object" src="{{ Storage::disk('public')->url('post/'.$comment->post->image) }}" width="64" height="64">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <a target="_blank" href="{{ route('post.details',$comment->post->slug) }}">
                                                        <h4 class="media-heading">{{ str_limit($comment->post->title,'40') }}</h4>
                                                    </a>
                                                    <p>by <strong>{{ $comment->post->user->name }}</strong></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger waves-effect" onclick="deleteComment({{ $comment->id }})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-form-{{ $comment->id }}" method="POST" action="{{ route('author.comment.destroy',$comment->id) }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @endforeach
                                </tbody>
                            </table>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>

    <script type="text/javascript">
        function deleteComment(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure to delete this item',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your Data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
