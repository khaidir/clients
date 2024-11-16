<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Client</title>
        <meta charset="utf-8"/>
        <meta name="description" content="Grab your copy now and get life-time updates for free."/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Client" />
        <meta property="og:url" content="client"/>
        <meta property="og:site_name" content="Metronic by Keenthemes" />
        <link rel="canonical" href="client.co.id"/>
        <link rel="shortcut icon" href="/assets/media/logos/favicon.ico"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
        <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
        <script>
            // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
            if (window.top != window.self) {
                window.top.location.replace(window.self.location.href);
            }
        </script>
    </head>
    <body id="kt_body" class="app-blank" >
        <script>
            var defaultThemeMode = "light";
            var themeMode;
            if ( document.documentElement ) {
            	if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
            		themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            	} else {
            		if ( localStorage.getItem("data-bs-theme") !== null ) {
            			themeMode = localStorage.getItem("data-bs-theme");
            		} else {
            			themeMode = defaultThemeMode;
            		}
            	}
            	if (themeMode === "system") {
            		themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            	}
            	document.documentElement.setAttribute("data-bs-theme", themeMode);
            }
        </script>
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        <div class="w-lg-500px p-10">
                            <form action="{{ url('login') }}"" class="form w-100" method="POST">
                                @csrf
                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">
                                        Sign In
                                    </h1>
                                    <div class="text-gray-500 fw-semibold fs-6">
                                        Client Segmention
                                    </div>
                                </div>
                                <div class="row g-3 mb-9">
                                    <div class="col-md-12">
                                        <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <img alt="Logo" src="/assets/media/svg/brand-logos/google-icon.svg" class="h-15px me-3"/>
                                        Sign in with Google
                                        </a>
                                    </div>
                                </div>
                                <div class="separator separator-content my-14">
                                    <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}" class="form-control bg-transparent @error('email') is-invalid @enderror"/>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="fv-row mb-3">
                                    <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent @error('password') is-invalid @enderror"/>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                    <a href="/auth/forgot" class="link-primary">
                                    Forgot Password ?
                                    </a>
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="" class="btn btn-primary">
                                        <span class="indicator-label">
                                        Sign In</span>
                                        <span class="indicator-progress">
                                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(/assets/media/misc/auth-bg.png)">
                    <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                        <a href="/" class="mb-0 mb-lg-12">
                        <img alt="Logo" src="/images/clients-white-2.png" class="h-60px h-lg-75px"/>
                        </a>
                        <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="/images/vektor_pabrik.png" alt=""/>
                        <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">
                            Solution of Approval
                        </h1>
                        <div class="d-none d-lg-block text-white fs-base text-center">
                            In this kind of post, <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>
                            introduces a person they’ve interviewed <br/> and provides some background information about
                            <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>
                            and their <br/> work following this is a transcript of the interview.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <script> var hostUrl = "/assets/"; </script> --}}
        <script src="/assets/plugins/global/plugins.bundle.js"></script>
        <script src="/assets/js/scripts.bundle.js"></script>
        {{-- <script src="/assets/js/custom/authentication/sign-in/general.js"></script> --}}
        <script src="/libs/toastr/build/toastr.min.js?v=1.0"></script>
    <script src="/js/pages/toastr.init.js?v=1.0"></script>
        @if (Session::has('error'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ Session::get('error') }}');
            });
        </script>
        @elseif(Session::has('success'))
        <script>
            $(document).ready(function() {
                toastr.success('{{ Session::get('success') }}');
            });
        </script>
        @endif
    </body>
</html>
