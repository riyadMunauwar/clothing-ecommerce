<section class="p-5 bg-white rounded-sm">
    <canvas id="current-month-orders-chart"></canvas>
</section>


@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('current-month-orders-chart').getContext('2d');
        var ordersData = {!! json_encode($ordersData) !!};
        var labels = Object.keys(ordersData);
        var data = Object.values(ordersData);

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: '{{ now()->format("M Y") }} Orders',
                    data: data,
                    backgroundColor: '#38bdf8',
                    borderColor: '#38bdf8',
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