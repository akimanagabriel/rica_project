<!DOCTYPE html>

<html class="light-style layout-navbar-fixed layout-menu-fixed" data-assets-path="../../assets/"
    data-template="vertical-menu-template" data-theme="theme-default" dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
        name="viewport" />

    <title>@yield('title') | LICA MS V1</title>

    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="{{ asset('assets/logo/lica.jpg') }}" rel="icon" type="image/x-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link href="{{ asset('assets/vendor/fonts/materialdesignicons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" rel="stylesheet" />

    <!-- Menu waves for no-customizer fix -->
    <link href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" rel="stylesheet" />

    <!-- Core CSS -->
    <link class="template-customizer-core-css" href="{{ asset('assets/vendor/css/rtl/core.css') }}" rel="stylesheet" />
    <link class="template-customizer-theme-css" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/css/demo.css') }}" rel="stylesheet" />

    <!-- Vendors CSS -->
    <link href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" rel="stylesheet" />

    {{-- data tables --}}
    <link href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" rel="stylesheet') }}" />
    <link
        href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" rel="stylesheet') }}" />
    <link
        href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" rel="stylesheet') }}" />
    <link href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" rel="stylesheet') }}" />

    <!-- Page CSS -->
    <link href="{{ asset('assets/vendor/css/pages/dashboards-crm.css') }}" rel="stylesheet" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    {{-- data tables --}}
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>


    {{-- data tables --}}
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    {{-- toast --}}
    <link href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" rel="stylesheet">


    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Aside -->
            @include('shared.aside')
            <!-- / Aside -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                @include('shared.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <main class="container-fluid">
                        {{-- header of each page --}}
                        <div class="my-2">
                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h6 class="text-capitalize text-primary">
                                    @php
                                        $path = str_replace('/', ' > ', request()->path());
                                        $path = str_replace('_', ' ', $path);
                                        $path = ucwords($path);
                                        
                                        $segments = explode(' > ', $path); // Split path into segments
                                        
                                        if (count($segments) > 0) {
                                            $lastSegment = $segments[count($segments) - 1]; // Get the last segment
                                            $lastSegmentLength = strlen($lastSegment);
                                        
                                            if ($lastSegmentLength > 30) {
                                                // If the last segment is greater than 30 characters, replace it with an empty string
                                                $segments[count($segments) - 1] = '';
                                            }
                                        }
                                        
                                        $path = implode(' > ', $segments); // Rejoin the segments
                                    @endphp
                                    {{ $path }}
                                    {{-- validate path length --}}
                                </h6>
                                <h5 class="text-uppercase">@yield('pageTitle')</h5>
                            </div>
                        </div>


                        @yield('content')
                    </main>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('shared.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-crm.js') }}"></script>

    {{-- flash messages --}}
    <!-- Include jQuery and jQuery Toast Plugin CDN links -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    @include('shared.messages')

    {{-- data tables --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    {{-- axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $('table').dataTable({
            paginate: true,
        });

        $(".select2").select2();
    </script>

</body>

</html>
