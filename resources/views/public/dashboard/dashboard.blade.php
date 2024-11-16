@include('layouts.public.header')
@include('layouts.public.sidebar')

<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
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
                    </ul>
                </div>
                <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-6 pb-18 py-lg-13">
                    <div class="page-title d-flex align-items-center me-3">
                        <img alt="Logo" src="/assets/media/svg/misc/layer.svg" class="h-60px me-5">
                        <h1 class="page-heading d-flex text-white fw-bolder fs-2 flex-column justify-content-center my-0">
                            Dashboard
                            <span class="page-desc text-white opacity-50 fs-6 fw-bold pt-4"> Dashboard Company </span>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-container container-xxl">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div class="row g-5 g-xl-8">
                        <div class="col-xl-5">
                            <div class="row mb-5 mb-xl-8 g-5 g-xl-8">
                                <div class="col-6">
                                    <a class="card flex-column justfiy-content-start align-items-start text-start w-100 text-gray-800 text-hover-primary p-10" href="#">
                                    <i class="ki-outline ki-rocket fs-2tx mb-5 ms-n1 text-gray-500"></i>
                                    <span class="fs-4 fw-bold">Request Visitor Access</span>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a class="card flex-column justfiy-content-start align-items-start text-start w-100 text-gray-800 text-hover-primary p-10" href="#">
                                    <i class="ki-outline ki-technology-2 fs-2tx mb-5 ms-n1 text-gray-500"></i>
                                    <span class="fs-4 fw-bold">Request New Worker Access</span>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a class="card flex-column justfiy-content-start align-items-start text-start w-100 text-gray-800 text-hover-primary p-10" href="#">
                                    <i class="ki-outline ki-fingerprint-scanning fs-2tx mb-5 ms-n1 text-gray-500"></i>
                                    <span class="fs-4 fw-bold">Request Extend Periode</span>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a class="card flex-column justfiy-content-start align-items-start text-start w-100 text-gray-800 text-hover-primary p-10" href="#">
                                    <i class="ki-outline ki-abstract-26 fs-2tx mb-5 ms-n1 text-gray-500"></i>
                                    <span class="fs-4 fw-bold">History Verification</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 ps-xl-12">
                            <div class="card card-xl-stretch mb-xl-4">
                                <div class="card-body p-0 d-flex justify-content-between flex-column overflow-hidden">
                                    <div class="d-flex flex-stack flex-wrap flex-grow-1 px-9 ">
                                        <div class="me-2">
                                            <span class="fw-bold text-gray-800 d-block mt-5 fs-3">Persentase Approval</span>
                                            <span class="text-gray-500 fw-bold">New Worker Access</span>
                                        </div>
                                    </div>
                                    <div class="card card-bordered">
                                        <div class="card-body">
                                            <div id="chartPie" style="height: 300px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 ps-xl-12">
                            <div class="card card-xl-stretch mb-xl-4">
                                <div class="card-body p-0 d-flex justify-content-between flex-column overflow-hidden">
                                    <div class="d-flex flex-stack flex-wrap flex-grow-1 px-9 ">
                                        <div class="me-2">
                                            <span class="fw-bold text-gray-800 d-block mt-5 fs-3">Statistic Request Access</span>
                                            <span class="text-gray-500 fw-bold">Tahun 2024</span>
                                        </div>
                                    </div>
                                    <div class="card card-bordered">
                                        <div class="card-body">
                                            <div id="chartdiv" style="height: 350px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.public.footerlint')
        </div>
    </div>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script>
        am5.ready(function () {
        // Root element for XY Chart
        var root = am5.Root.new("chartdiv");

        // Set themes
        root.setThemes([am5themes_Animated.new(root)]);

        // Create chart
        var chart = root.container.children.push(
            am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            paddingLeft: 0,
            wheelX: "panX",
            wheelY: "zoomX",
            layout: root.verticalLayout,
            })
        );

        // Add legend
        var legend = chart.children.push(
            am5.Legend.new(root, {
            centerX: am5.p50,
            x: am5.p50,
            })
        );

        // Data
        var data = [
            { month: "Jan", "Visitor Access": 100, "New Worker Access": 150, "Extend Period": 300 },
            { month: "Feb", "Visitor Access": 130, "New Worker Access": 270, "Extend Period": 220 },
            { month: "Mar", "Visitor Access": 280, "New Worker Access": 290, "Extend Period": 240 },
        ];

        // Create axes
        var xAxis = chart.xAxes.push(
            am5xy.CategoryAxis.new(root, {
            categoryField: "month",
            renderer: am5xy.AxisRendererX.new(root, {
                cellStartLocation: 0.1,
                cellEndLocation: 0.9,
                minorGridEnabled: true,
                grid: { location: 1 },
            }),
            tooltip: am5.Tooltip.new(root, {}),
            })
        );

        xAxis.data.setAll(data);

        var yAxis = chart.yAxes.push(
            am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, { strokeOpacity: 0.1 }),
            })
        );

        // Function to create series
        function makeSeries(name, fieldName) {
            var series = chart.series.push(
            am5xy.ColumnSeries.new(root, {
                name: name,
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: fieldName,
                categoryXField: "month",
            })
            );

            series.columns.template.setAll({
            tooltipText: "{name}, {categoryX}: {valueY}",
            width: am5.percent(50),
            tooltipY: 0,
            strokeOpacity: 0,
            });

            series.data.setAll(data);
            series.appear();

            series.bullets.push(() =>
            am5.Bullet.new(root, {
                locationY: 0,
                sprite: am5.Label.new(root, {
                text: "{valueY}",
                fill: root.interfaceColors.get("alternativeText"),
                centerY: 0,
                centerX: am5.p50,
                populateText: true,
                }),
            })
            );

            legend.data.push(series);
        }

        // Add series
        makeSeries("Visitor Access", "Visitor Access");
        makeSeries("New Worker Access", "New Worker Access");
        makeSeries("Extend Period", "Extend Period");

        // Animate chart on load
        chart.appear(1000, 100);
        });

        am5.ready(function () {
        // Root element for Pie Chart
        var root = am5.Root.new("chartPie");

        // Set themes
        root.setThemes([am5themes_Animated.new(root)]);

        // Create chart
        var chart = root.container.children.push(
            am5percent.PieChart.new(root, {
            radius: am5.percent(90),
            innerRadius: am5.percent(40),
            layout: root.horizontalLayout,
            })
        );

        // Create series
        var series = chart.series.push(
            am5percent.PieSeries.new(root, {
            name: "Series",
            valueField: "tot_status",
            categoryField: "aproval",
            })
        );

        // Set data
        series.data.setAll([
            { aproval: "Register", tot_status: 501.9 },
            { aproval: "Awaiting Approval", tot_status: 301.9 },
            { aproval: "Approved", tot_status: 201.1 },
        ]);

        // Disable labels and ticks
        series.labels.template.set("visible", false);
        series.ticks.template.set("visible", false);

        // Add gradient
        series.slices.template.set("strokeOpacity", 0);
        series.slices.template.set(
            "fillGradient",
            am5.RadialGradient.new(root, {
            stops: [
                { brighten: -0.8 },
                { brighten: -0.5 },
                { brighten: 0 },
            ],
            })
        );

        // Add legend
        var legend = chart.children.push(
            am5.Legend.new(root, {
            centerY: am5.percent(50),
            y: am5.percent(50),
            layout: root.verticalLayout,
            })
        );

        // Customize legend
        legend.valueLabels.template.setAll({ textAlign: "right" });
        legend.labels.template.setAll({
            maxWidth: 140,
            width: 140,
            oversizedBehavior: "wrap",
        });

        legend.data.setAll(series.dataItems);

        // Animate series on load
        series.appear(1000, 100);
        });

    </script>
@include('layouts.public.footer')
