<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="{{url('/')}}">
        <div class="sidebar-brand-icon">
            <img class="rounded" src="{{asset('img/logo.jpeg')}}" width="50" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">
            {{config('app.name')}}
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0"/>

    <!-- Nav Item - Dashboard -->
   {{-- <li class="nav-item {{ \Route::getCurrentRoute()->uri == '/' ? 'active' : '' }}">
        <a class="nav-link "
           href="{{url('/')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>--}}

    <li class="nav-item {{ \Route::getCurrentRoute()->uri == '/' ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Clients</span></a>
    </li>
    <li class="nav-item {{ \Route::getCurrentRoute()->uri == 'charios' ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/charios')}}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Charios</span></a>
    </li>
    <li class="nav-item {{ \Route::getCurrentRoute()->uri == 'tineles' ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/tineles')}}">
            <i class="fas fa-fw fa-box"></i>
            <span>Tineles</span></a>
    </li>
    <li class="nav-item {{ \Route::getCurrentRoute()->uri == 'cartons' ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/cartons')}}">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Cartons</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ \Route::getCurrentRoute()->uri == '/users' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Users</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users</h6>
                <a class="collapse-item" href="#">Users</a>
                <a class="collapse-item" href="#">Cards</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<style>
    .nav-item:hover{
        background-color: rgba(255, 255, 255, 0.11) !important;
    }
    .active {
        border-left: var(--light) solid 5px;
    }
</style>

@push('scripts')
    <script>
        $(document).ready(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('#scroll').fadeIn();
                } else {
                    $('#scroll').fadeOut();
                }
            });
            $('#scroll').click(function () {
                $("html, body").animate({scrollTop: 0}, 600);
                return false;
            });
        });
    </script>
@endpush


