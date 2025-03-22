@extends('Layouts.Maser')
@section('content')

    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Dashboard</a></li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-16">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="filter">
                                    <select id="salesFilter" class="form-select filter-selector">
                                        <option value="today" selected>Today</option>
                                        <option value="month">This Month</option>
                                        <option value="year">This Year</option>
                                    </select>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Sales <span id="salesPeriod"></span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="salesCount">Loading...</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="filter">
                                    <select id="revenueFilter" class="form-select filter-selector">
                                        <option value="today" selected>Today</option>
                                        <option value="month">This Month</option>
                                        <option value="year">This Year</option>
                                    </select>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Revenue <span id="revenuePeriod"></span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="revenueAmount">Loading...</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card customers-card">
                                <div class="filter">
                                    <select id="customersFilter" class="form-select filter-selector">
                                        <option value="today" selected>Today</option>
                                        <option value="month">This Month</option>
                                        <option value="year">This Year</option>
                                    </select>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Customers <span id="customersPeriod"></span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="customersCount">Loading...</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Customers Card -->

                        <!-- Reports Chart -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Reports <span>/Last 7 Days</span></h5>

                                    <!-- Line Chart -->
                                    <div id="reportsChart"></div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', () => {
                                            fetch('/api/chart-data') // نطلب البيانات من API
                                                .then(response => response.json())
                                                .then(data => {
                                                    new ApexCharts(document.querySelector('#reportsChart'), {
                                                        series: [
                                                            {
                                                                name: 'Sales',
                                                                data: data.sales,
                                                            },
                                                            {
                                                                name: 'Revenue',
                                                                data: data.revenue,
                                                            },
                                                            {
                                                                name: 'Customers',
                                                                data: data.customers,
                                                            },
                                                        ],
                                                        chart: {
                                                            height: 350,
                                                            type: 'area',
                                                            toolbar: { show: false },
                                                        },
                                                        markers: { size: 4 },
                                                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                                        fill: {
                                                            type: 'gradient',
                                                            gradient: {
                                                                shadeIntensity: 1,
                                                                opacityFrom: 0.3,
                                                                opacityTo: 0.4,
                                                                stops: [0, 90, 100],
                                                            },
                                                        },
                                                        dataLabels: { enabled: false },
                                                        stroke: { curve: 'smooth', width: 2 },
                                                        xaxis: {
                                                            type: 'datetime',
                                                            categories: data.dates, // تم جلبها من API
                                                        },
                                                        tooltip: {
                                                            x: { format: 'yyyy-MM-dd' },
                                                        },
                                                    }).render();
                                                })
                                                .catch(error => console.error('Error fetching chart data:', error));
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <!-- End Reports Chart -->

                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function fetchDashboardStats(filter) {
                fetch(`/api/Crave-analytics?filter=${filter}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("salesCount").innerText = data.sales;
                        document.getElementById("revenueAmount").innerText = `$${data.revenue}`;
                        document.getElementById("customersCount").innerText = data.customers;
                        updateChart(filter);
                    })
                    .catch(error => {
                        console.error("Error fetching dashboard data:", error);
                    });
            }

            function updateChart(filter) {
                fetch(`/api/chart-data?filter=${filter}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("chartPeriod").innerText = document.querySelector(`#${filter}Filter option:checked`).text;

                        if (window.reportsChart) {
                            window.reportsChart.destroy();
                        }

                        window.reportsChart = new ApexCharts(document.querySelector("#reportsChart"), {
                            series: [
                                {
                                    name: "Sales",
                                    data: data.sales,
                                },
                                {
                                    name: "Revenue",
                                    data: data.revenue,
                                },
                                {
                                    name: "Customers",
                                    data: data.customers,
                                },
                            ],
                            chart: {
                                height: 350,
                                type: "area",
                                toolbar: { show: false },
                            },
                            markers: { size: 4 },
                            colors: ["#4154f1", "#2eca6a", "#ff771d"],
                            fill: {
                                type: "gradient",
                                gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.3,
                                    opacityTo: 0.4,
                                    stops: [0, 90, 100],
                                },
                            },
                            dataLabels: { enabled: false },
                            stroke: { curve: "smooth", width: 2 },
                            xaxis: { type: "datetime", categories: data.dates },
                            tooltip: { x: { format: "dd/MM/yy HH:mm" } },
                        });

                        window.reportsChart.render();
                    })
                    .catch(error => console.error("Error fetching chart data:", error));
            }

            document.querySelectorAll(".filter-selector").forEach(select => {
                select.addEventListener("change", function () {
                    const filterType = this.value;
                    fetchDashboardStats(filterType);
                });
            });

            fetchDashboardStats("today");
        });
    </script>


@endsection
