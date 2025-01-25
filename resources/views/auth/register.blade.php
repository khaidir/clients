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
        <meta property="og:site_name" content="SBA"/>
        <link rel="canonical" href="client.co.id"/>
        <link rel="shortcut icon" href="/assets/media/logos/favicon.ico"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
        <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
        <script>
            var defaultThemeMode = "light";
            var themeMode;
            if (window.top != window.self) {
                window.top.location.replace(window.self.location.href);
            }
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
    </head>
    <body id="kt_body" class="app-blank" >
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        <div class="w-lg-500px p-10">
                            <form action="{{ url('register') }}"" class="form w-100" method="POST">
                                @csrf
                                <div class="text-center mb-11">
                                    <a href="/" class="mb-0 mb-lg-12">
                                        <img alt="Logo" src="/images/clients-2.png" class="h-60px h-lg-75px"/>
                                    </a>
                                    <h1 class="text-gray-900 fw-bolder mb-3 mt-7">
                                        Company Register
                                    </h1>
                                    <div class="text-gray-500 fw-semibold fs-6">
                                        Client Segmention
                                    </div>
                                </div>
                                <div class="fv-row mb-5">
                                    <input type="text" placeholder="Fullname" name="name" autocomplete="off" value="{{ old('name') }}" class="form-control bg-transparent @error('name') is-invalid @enderror"/>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="fv-row mb-5">
                                    <input type="text" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}" class="form-control bg-transparent @error('email') is-invalid @enderror"/>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="fv-row mb-5">
                                    <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent @error('password') is-invalid @enderror"/>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="fv-row mb-5">
                                    <input type="password" placeholder="Password Confirmation" name="password_confirm" autocomplete="off" class="form-control bg-transparent @error('password_confirm') is-invalid @enderror"/>
                                    @if ($errors->has('password_confirm'))
                                        <span class="text-danger">{{ $errors->first('password_confirm') }}</span>
                                    @endif
                                </div>
                                <div class="fv-row mb-5">
                                    <input type="text" placeholder="Address" name="address" autocomplete="off" value="{{ old('address') }}" class="form-control bg-transparent @error('address') is-invalid @enderror"/>
                                    @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                <div class="fv-row mb-5">
                                    <input type="text" placeholder="Position" name="position" autocomplete="off" value="{{ old('position') }}" class="form-control bg-transparent @error('position') is-invalid @enderror"/>
                                    @if ($errors->has('position'))
                                        <span class="text-danger">{{ $errors->first('position') }}</span>
                                    @endif
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="" class="btn btn-warning">
                                        <span class="indicator-label">
                                        Register</span>
                                        <span class="indicator-progress">
                                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(/assets/media/misc/bg_login.png);   border-top-left-radius:20%">
                    <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                        <img class="d-none d-lg-block mx-auto w-375px w-md-50 w-xl-500px mb-10 mb-lg-20" src="/images/img_login.jpg" style="border-radius: 5%;" alt=""/>
                        <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-5">
                            Solution of Approval
                        </h1>
                        <div class="d-none d-lg-block text-white fs-base text-center">
                        The Approval Application is a software solution designed to streamline and manage approval workflows within an organization.
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <script src="/assets/plugins/global/plugins.bundle.js"></script>
        <script src="/assets/js/scripts.bundle.js"></script>
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
