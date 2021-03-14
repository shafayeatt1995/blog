@extends('layouts.backend.master')

@section('title','Themes')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
          rel="stylesheet">
@endpush

@section('content')
    <div class="block-header">
        <a href="{{ route('admin.theme.create') }}" class="btn btn-primary waves-effect">
            <i class="material-icons">add</i>
            <span>Add New Theme</span>
        </a>

    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>All Theme <span class="badge bg-blue">{{ $themes->count() }}</span></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable"
                                   id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                                <thead>
                                <tr role="row">
                                    <th>Sl. No</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($themes as $key=>$theme)
                                    <tr role="row" class="">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $theme->name }}</td>
                                        <td>{{ $theme->class }}</td>
                                        <td>{{ $theme->created_at->diffForHumans() }}</td>
                                        <td>{{ $theme->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.theme.edit',$theme->id) }}"
                                               class="btn btn-info waves-effect"><i class="material-icons">edit</i></a>
                                            <button class="btn btn-danger waves-effect" type="button"
                                                    onclick="deleteTheme({{ $theme->id }})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-form-{{ $theme->id }}"
                                                  action="{{ route('admin.theme.destroy',$theme->id) }}"
                                                  method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
        function deleteTheme(id) {
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
