<section class="p-5 bg-white rounded-sm">
    <canvas id="current-month-sales-chart"></canvas>
</section>


@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('current-month-sales-chart').getContext('2d');
        var salesData = {!! json_encode($salesData) !!};
        var labels = Object.keys(salesData);
        var salesData = Object.values(salesData);

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: '{{ now()->format("M Y") }} Sales',
                        data: salesData,
                        backgroundColor: '#c084fc',
                        borderColor: '#c084fc',
                        borderWidth: 1
                    }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endpush