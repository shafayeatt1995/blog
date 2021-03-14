<!-- Jquery Core Js -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.js') }}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{ asset('backend/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset('backend/plugins/node-waves/waves.js') }}"></script>

<!-- Custom Js -->
<script src="{{ asset('backend/js/admin.js') }}"></script>

<script src="{{ asset('backend/js/sweet-aleart.js') }}"></script>

<script src="{{ asset('backend/js/toastr.min.js') }}"></script>

{!! Toastr::message() !!}

<script>
    @if($errors->any())
    @foreach($errors->all()  as $error)
    toastr.error('{{ $error }}', 'Error', {
        closeButton: true,
    });
    @endforeach
    @endif
</script>


