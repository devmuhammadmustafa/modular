<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('base::layouts.partials.head')
</head>

<body>
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    @include('base::layouts.partials.spinner')
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    @include('base::layouts.partials.sidebar')
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
        @yield('content')
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>



<form method="POST" action="" id="delete-form">
    @csrf
    @method('DELETE')
</form>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('modules/base/lib/chart/chart.min.js') }}"></script>
<script src="{{ asset('modules/base/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('modules/base/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('modules/base/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('modules/base/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('modules/base/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('modules/base/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
@include('base::layouts.partials.scripts')

<!-- Template Javascript -->
<script src="{{ asset('modules/base/js/main.js') }}"></script>
</body>

</html>
