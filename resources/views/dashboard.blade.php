@extends('layouts.app', [
        'activePage' => 'dashboard',
        'title' => 'Dashboard',
        'navName' => 'Dashboard',
        'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            {{--            Write your code here--}}
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endpush
