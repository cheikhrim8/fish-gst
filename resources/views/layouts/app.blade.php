<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('light-bootstrap/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.jpeg') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title> {{config('app.name')}} | {{ $title }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}"/>
    <!-- CSS Files -->

    {{-- Bootstrap-select --}}
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset('css/my_style.css')}}">

    {{-- Jquery-ui --}}
    <link rel="stylesheet" type="text/css" href="{{URL::asset('vendor/jquery-ui/jquery-ui.min.css')}}">

    {{-- Jquery-confirm --}}
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset('vendor/jquery-confirm/dist/jquery-confirm.min.css')}}">

    {{-- Datatable and datatable-responsive --}}
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset('vendor/datatables-responsive/dataTables.responsive.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset('vendor/datatables/dataTables.bootstrap4.min.css')}}">
    <!-- END: Vendor CSS-->

    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet"/>

{{--    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/colors.css')}}">--}}

    <script type="text/javascript">
        var racine = '{{url("/")}}/';
        var msg_chargement = '{{ trans("message_erreur.chargement") }}';
        var erreur_req = "{{ trans('message_erreur.request_error') }}";
        var erreur_validation = "{{ trans('message_erreur.validate_error') }}";
        var champs_obigatoire_st = "{{ trans("message_erreur.champs_obligatoire_st") }}";
        var prametre_st = "{{ trans("message_erreur.prametre_st") }}";
        var msg_erreur = "{{ trans("message_erreur.msg_erreur") }}";
        var origine = "{{ trans("text_archive.origine") }}";
        var destination = "{{ trans("text_archive.destination") }}";
        var lang = '{{app()->getLocale()}}';
    </script>

</head>

<body>


<!-- Page Wrapper -->
<div id="wrapper">

@auth()
    <!-- Sidebar -->
    @include('layouts.navigation.sidebar')
    <!-- End of Sidebar -->
@endauth
<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

        @auth()

            <!-- Topbar -->
            @include('layouts.navigation.navbar')
            <!-- End of Topbar -->
        @endauth

        <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Content Row -->
                <div class="row">
                    <!-- Pending Requests Card Example -->
                    <div class="col-12">
                        @yield('content')
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Fish-Project {{now()->year}}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<button class="btn scroll-to-top rounded" id="scroll">
    <i class="fas fa-angle-up"></i>
</button>

@foreach (['main','second','third','forth','add','de_tab','de'] as $type_modal)
    <div id="{{$type_modal}}-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header-body">
                </div>
            </div>
        </div>
    </div>
@endforeach

</body>
<!--   Core JS Files   -->
<!--
    <script src="{{ asset('light-bootstrap/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('light-bootstrap/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('light-bootstrap/js/core/bootstrap.min.js') }}" type="text/javascript"></script>

-->

<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

{{-- Datatable and datatable-responsive --}}
<script src="{{URL::asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('vendor/datatables-responsive/dataTables.responsive.min.js')}}"></script>

{{-- Jquery-ui --}}
<script src="{{URL::asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{URL::asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

{{-- Jquery-confirm --}}
<script src="{{URL::asset('vendor/jquery-confirm/dist/jquery-confirm.min.js')}}"></script>
<!-- END: Page Vendor JS-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>

<script src="{{URL::asset('js/init.js')}}"></script>
<script src="{{URL::asset('js/client.js')}}"></script>
<script src="{{URL::asset('js/chario.js')}}"></script>
<script src="{{URL::asset('js/tinele.js')}}"></script>

@stack('scripts')

</html>
