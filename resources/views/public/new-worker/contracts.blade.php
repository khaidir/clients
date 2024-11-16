@include('layouts.public.header')
@include('layouts.public.sidebar')
<div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
    <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
        <div id="kt_app_toolbar" class="app-toolbar  py-6 ">
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex align-items-start ">
                <div class="d-flex flex-column flex-row-fluid">
                    <div class="d-flex align-items-center pt-1">
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
                            <li class="breadcrumb-item text-white fw-bold lh-1">
                                <a href="/dashboard" class="text-white text-hover-primary">
                                    <i class="ki-outline ki-home text-white fs-3"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <i class="ki-outline ki-right fs-4 text-white mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-white fw-bold lh-1"> Dashboard </li>
                            <li class="breadcrumb-item">
                                <i class="ki-outline ki-right fs-4 text-white mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-white fw-bold lh-1"> Contracts </li>
                        </ul>
                    </div>
                    <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-6 pb-18 py-lg-13">
                        <div class="page-title d-flex align-items-center me-3">
                            <img alt="Logo" src="/assets/media/svg/misc/layer.svg" class="h-60px me-5">
                            <h1 class="page-heading d-flex text-white fw-bolder fs-2 flex-column justify-content-center my-0">
                                Contracts
                                <span class="page-desc text-white opacity-50 fs-6 fw-bold pt-4"> Lists Contract Company </span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-container container-xxl">
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">

                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_content" class="app-content">
                        <div class="card ">
                            <div class="card-body p-0">
                                {{-- <div class="card-px text-center py-20 my-10">
                                    <h2 class="fs-2x fw-bold mb-10">Welcome to Customers App</h2>
                                    <p class="text-gray-500 fs-4 fw-semibold mb-10">
                                        There are no customers added yet.<br>
                                        Kickstart your CRM by adding a your first customer
                                    </p>
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Add Customer</a>
                                </div>
                                <div class="text-center px-4">
                                    <img class="mw-100 mh-300px" alt="" src="/assets/media/illustrations/sketchy-1/2.png">
                                </div> --}}
                                <div class="app-container table-responsives">
                                    <table id="table" class="table align-middle table-row-dashed fs-6 gy-5 dataTable" style="width:100%;">
                                        <thead class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <tr>
                                                <th width="40">ID</th>
                                                <th width="450">Description</th>
                                                <th width="150">Date Request</th>
                                                <th width="120">Status</th>
                                                <th width="70">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.public.footerlint')
            </div>
        </div>
    </div>
</div>
@include('layouts.public.footer')
<script>
$(document).ready(function() {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('public.new-worker.data') }}",
        columns: [
            {
                data: null,
                name: 'number',
                orderable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'description' },
            { data: 'date_request' },
            { data: 'status', render: function(data) {
                return data ? 'Active' : 'Inactive';
            }},
            { data: 'action', orderable: false, searchable: false }
        ]
    });

    $("#dlength").append($("#table_length"));
    $("#dfilter").append($("#table_filter"));
    $("#dinfo").append($("#table_info"));
    $("#dpaging").append($("#table_paginate"));

    $('#dfilter input').removeClass('form-control-sm');
    $('.dataTables_paginate').parent().addClass('pagination-rounded justify-content-end mb-2');
    $('#dfilter input').parent().parent().addClass('col-xs-4');
    $('.select2-container').attr("width","70");
    $(".select2").select2({ width: 'resolve' });

    $('select').select2({
        placeholder: 'Choose'
    });
    $('#generate').addClass("mm-active");
});
</script>
