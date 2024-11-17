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
        </style>
        <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
    </head>
    <body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-toolbar-enabled="true" class="app-default">
        <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: light)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
            <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
