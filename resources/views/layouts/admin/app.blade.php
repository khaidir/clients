<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Client - Semen Bangun Andalas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Applicaiton Core" name="description" />
        <meta content="Khaidir Hasan" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="/images/favicon.ico">
        <link href="/libs/select2/css/select2.min.css?v=1.0" rel="stylesheet" type="text/css" />
        <link href="/libs/sweetalert2/sweetalert2.min.css?v=1.0" rel="stylesheet" type="text/css" />
        <link href="/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css?v=1.0" rel="stylesheet" type="text/css" />
        <link href="/libs/toastr/build/toastr.min.css?v=1.0" rel="stylesheet" type="text/css" />
        <link href="/css/bootstrap.min.css?v=1.0" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="/css/icons.min.css?v=1.0" rel="stylesheet" type="text/css" />
        <link href="/css/app.min.css?v=1.0" id="app-style" rel="stylesheet" type="text/css" />
        <link href="/css/custom.min.css?v=1.0" rel="stylesheet" type="text/css" />
        <link href="/css/fonts/hindsiliguri.css?v=1.0" rel="stylesheet">
        <link id="bsdp-css" href="/css/bootstrap-datepicker3.min.css" rel="stylesheet">
        <style>
        body { font-family: 'Hind Siliguri', sans-serif;
        element.style {
        }
        *, ::after, ::before {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }
        #sidebar-menu ul li a {
            font-size: 13px;
        }}
        #label {
            display: inline-block;
            border: 2px dashed #007bff;
            padding: 7px;
            text-align: center;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        #label:hover {
            background-color: #f8f9fa;
        }

        #ktp-icon {
            display: block;
            margin: 0 auto 10px auto; /* Center image and add margin below */
        }
        /* Modal Styling */
        .modal {
                display: none; /* Modal disembunyikan secara default */
                position: fixed;
                z-index: 9999; /* Pastikan modal muncul di atas semua elemen */
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.8); /* Latar belakang gelap untuk fokus ke gambar */
                justify-content: center;
                overflow: auto;
                text-align: center;
            }

            /* Gambar dalam modal */
            .modal-content {
                max-width: 80%;
                max-height: 80%;
                margin: auto;
                justify-content: center;
                display: block;
            }

            /* Close button di pojok kanan atas */
            .close {
                position: absolute;
                top: 15px;
                right: 25px;
                color: #fff;
                font-size: 35px;
                font-weight: bold;
                cursor: pointer;
            }

            .close:hover,
            .close:focus {
                color: #ccc;
                text-decoration: none;
                cursor: pointer;
            }

            /* Caption di bawah gambar */
            #caption {
                margin: 10px;
                text-align: center;
                color: #fff;
                font-size: 18px;
            }
            #modalImage {
                max-height: 80vh; /* Maksimal tinggi gambar dalam modal */
                object-fit: contain;
            }


        </style>
        @yield('style')
    </head>
    <body data-topbar="dark" data-sidebar="light" data-layout-mode="light">
        <div id="layout-wrapper">
            @include('layouts.admin.header')
            @include('layouts.admin.sidebar')
            <div class="main-content">
                @yield('content')
            </div>
        </div>
        <div class="rightbar-overlay"></div>
        <script src="/libs/jquery/jquery.min.js?v=1.0"></script>
        <script src="/libs/bootstrap/js/bootstrap.bundle.min.js?v=1.0"></script>
        <script src="/libs/metismenu/metisMenu.min.js?v=1.0"></script>
        <script src="/libs/simplebar/simplebar.min.js?v=1.0"></script>
        <script src="/libs/node-waves/waves.min.js?v=1.0"></script>
        <script src="/js/app.js?v=1.0"></script>

        <script src="/libs/datatables.net/js/jquery.dataTables.min.js?v=1.0"></script>
        <script src="/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js?v=1.0"></script>
        <script src="/libs/select2/js/select2.min.js?v=1.0"></script>
        <script src="/libs/sweetalert2/sweetalert2.min.js?v=1.0"></script>
        <script src="/js/pages/sweet-alerts.init.js?v=1.0"></script>
        <script src="/libs/toastr/build/toastr.min.js?v=1.0"></script>
        <script src="/js/pages/toastr.init.js?v=1.0"></script>
        <script src="/js/bootstrap-datepicker.min.js"></script>
        @yield('scripts')
        @include('layouts.includes.message')
    </body>
</html>
