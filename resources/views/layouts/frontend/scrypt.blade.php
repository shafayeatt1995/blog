<!-- SCIPTS -->

<script src="{{ asset('frontend/js/jquery-3.1.1.min.js') }}"></script>

<script src="{{ asset('frontend/js/tether.min.js') }}"></script>

<script src="{{ asset('frontend/js/bootstrap.js') }}"></script>

<script src="{{ asset('frontend/js/swiper.js') }}"></script>

<script src="{{ asset('frontend/js/scripts.js') }}"></script>

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
