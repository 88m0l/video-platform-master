<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{!! asset('theme/css/styles.css') !!}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap');

            html, body {
                    direction: rtl;
                    text-align: right;
                    font-family: "Noto Kufi Arabic", sans-serif!important;
            }


            .sb-nav-fixed #layoutSidenav #layoutSidenav_content {
                padding-right: 225px;
                padding-left: 0;;
            }

            .nav .nav-link .sb-nav-link-icon, .sb-sidename-menu .nav-link .sb-nav-link-icon {
                margin-left: 0.5rem;
                margin-right: 0;
            }


            .page-item:last-child .page-link, .page-item:last-child .datatable-pagination a, .datatable-pagination .page-item:last-child a, .datatable-pagination li:last-child .page-link, .datatable-pagination li:last-child a {
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
            }

            .page-item:first-child .page-link, .page-item:first-child .datatable-pagination a, .datatable-pagination .page-item:first-child a, .datatable-pagination li:first-child .page-link, .datatable-pagination li:first-child a {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
            }

        </style>

    </head>
    <body class="sb-nav-fixed">
       @include('theme.header')
        <div id="layoutSidenav">
           @include('theme.sidebar')
            <div id="layoutSidenav_content" class="overflow-hidden">
                <div class="container-fluid p-4">
                    @if(Session::has('flash_message'))

                        <div class="p-3 mb-2 bg-success text-white rounded text-center">
                            {{ session('flash_message') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{!! asset('theme/js/scripts.js') !!}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>


        @yield('scripts')
    </body>
</html>
