@extends('layouts.backend.master')

@section('title','Favorite')

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
                    <h2>All Favorite Post <span class="badge bg-blue">{{ $posts->count() }}</span></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable"
                                   id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                                <thead>
                                <tr role="row">
                                    <th>Sl. No</th>
                                    <th>Title</th>
                                    <th>Post Creator</th>
                                    <th><i class="material-icons">favorite</i></th>
{{--                                    <th><i class="material-icons">comment</i></th>--}}
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Title</th>
                                    <th>Post Creator</th>
                                    <th><i class="material-icons">favorite</i></th>
                                    {{--                                    <th><i class="material-icons">comment</i></th>--}}
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($posts as $key=>$post)
                                    <tr role="row" class="">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ str_limit($post->title,'25') }}</td>
                                        <th>{{ $post->user->name }}</th>
                                        <th>{{ $post->favorit_to_users->count() }}</th>
                                        <th>{{ $post->view_count }}</th>
                                        <td class="text-center">
                                            <button class="btn btn-danger waves-effect" type="button"
                                                    onclick="removePost({{ $post->id }})">
                                                <i class="material-icons">delete_forever</i>
                                            </button>
                                            <form id="remove-form-{{ $post->id }}"
                                                  action="{{ route('post.favorite',$post->id) }}"
                                                  method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
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
        function removePost(id) {
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
                    document.getElementById('remove-form-' + id).submit();
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
