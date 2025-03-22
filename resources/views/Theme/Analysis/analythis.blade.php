@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
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
            <!-- End Line Chart -->
        </div>
    </main>
@endsection
