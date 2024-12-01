@extends('layouts.admin.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    /* CSS untuk container grafik */
    .chart-container {
        width: 80%; /* Lebar relatif */
        margin: 0 auto; /* Pusatkan */
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 10px;
    }
    canvas {
        display: block;
        max-width: 100%; /* Grafik responsive */
    }
</style>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-0 d-sm-flex align-items-center justify-content-between">
                    <h2 class="mb-sm-0 m-0 font-size-18 page-title">Dashboard</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div class="text-dark font-weight-bolder font-size-h2">{{ @$total_sia }}</div>
                        <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">New Worker</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div class="text-dark font-weight-bolder font-size-h2">{{ @$total_visitor }}</div>
                        <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Visitor</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div class="text-dark font-weight-bolder font-size-h2">{{ @$total_company }}</div>
                        <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Companies</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div class="text-dark font-weight-bolder font-size-h2">{{ @$total_goods }}</div>
                        <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Goods</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-sm-6">
                <div class="card py-3 px-3">
                    <h4>Contract Monthly</h4>
                    <canvas id="siaChart" height="350"></canvas>
                </div>
            </div>
            <div class="col-xl-6 col-sm-6">
                <div class="card py-3 px-3">
                    <canvas id="extenedeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    const labels = @json($labels);
    const data = {
        labels: labels,
        datasets: [{
            label: 'Total Request',
            data: @json($values),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };
    const siaChart = new Chart(
        document.getElementById('siaChart'),
        config
    );
});
</script>
@endsection

