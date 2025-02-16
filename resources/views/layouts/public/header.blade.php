<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Client</title>
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Client" />
        <meta property="og:url" content="#" />
        <meta property="og:site_name" content="" />
        <link rel="canonical" href="#" />
        <link rel="shortcut icon" href="#" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <link href="{{ asset('assets/landing/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/landing/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/landing/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/landing/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="/libs/toastr/build/toastr.min.css?v=1.0" rel="stylesheet" type="text/css" />
        <style>
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
            .image-input-placeholder {
                background-image: url('/assets/media/svg/files/blank-image.svg');
            }
            [data-bs-theme="dark"] .image-input-placeholder {
                background-image: url('/assets/media/svg/files/blank-image-dark.svg');
            }
            .upload-container.slim {
                border: 2px dashed #d1d5db;
                border-radius: 8px;
                padding: 15px 15px;
                background-color: #f9fafb;
                transition: border-color 0.3s ease;
                text-align: left;
                min-height: 65px;
                cursor: pointer;
            }
            .upload-container.slim:hover {
                border-color: #2563eb;
            }
            .upload-content {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                height: 65px;
            }
            .upload-icon {
                font-size: 24px;
                color: #2563eb;
                flex-shrink: 0;
            }
            .upload-text {
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .upload-title {
                font-size: 16px;
                font-weight: 600;
                color: #1f2937;
                margin-bottom: 4px;
            }
            .upload-subtitle {
                font-size: 13px;
                color: #6b7280;
                margin-bottom: 8px;
            }
            .upload-filename {
                font-size: 12px;
                color: #4b5563;
                word-break: break-all;
                margin-top: -2px;
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

        </style>
        <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
    </head>
    <body id="kt_body" class="page-loading-enabled page-loading header-fixed header-mobile-fixed subheader-enabled page-loading" data-kt-app-header-fixed-mobile="true" data-kt-app-toolbar-enabled="true" class="app-default">
        <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: light)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
        <div class="page-loader">
            <div class="spinner spinner-primary"></div>
        </div>
        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">

