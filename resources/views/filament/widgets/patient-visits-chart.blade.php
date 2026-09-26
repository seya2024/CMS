<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
    {{-- Hidden div to safely pass PHP data to JavaScript --}}
    <div id="chart-data" 
         x-data="{ labels: {{ Js::from($chartData['labels']) }}, data: {{ Js::from($chartData['data']) } }"
         x-cloak
         class="hidden">
    </div>

    {{-- The Chart Canvas --}}
    <div class="relative" style="height: 280px;">
        <canvas id="patientVisitsChart"></canvas>
    </div>
</div>

@push('scripts')
    <!-- Load Chart.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Extract data from the hidden Alpine.js div
            const dataContainer = document.getElementById('chart-data');
            if (!dataContainer) return;
            
            const alpineData = Alpine.$data(dataContainer);
            const labels = alpineData.labels;
            const visits = alpineData.data;

            const ctx = document.getElementById('patientVisitsChart').getContext('2d');

            // 2. Destroy old chart instance if it exists (Prevents Livewire polling bugs)
            if (window.patientVisitsChartInstance) {
                window.patientVisitsChartInstance.destroy();
            }

            // 3. Create the beautiful Gradient Fill
            const gradient = ctx.createLinearGradient(0, 0, 0, 280);
            gradient.addColorStop(0, 'rgba(13, 148, 136, 0.2)'); // Teal fade out
            gradient.addColorStop(1, 'rgba(13, 148, 136, 0.0)'); // Transparent

            // 4. Initialize Chart.js
            window.patientVisitsChartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Patient Visits',
                        data: visits,
                        borderColor: '#0d9488',       // Teal line color
                        backgroundColor: gradient,    // Gradient fill under the line
                        borderWidth: 2.5,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#0d9488',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.4,               // Smooth curved lines
                        fill: true,                 // Fill under the line
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Hide default legend to keep it clean
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { size: 12, weight: 'bold' },
                            bodyFont: { size: 11 },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Visits: ' + context.parsed.y;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false // Remove vertical grid lines
                            },
                            ticks: {
                                color: '#94a3b8', // Gray text
                                font: { size: 11, family: 'Inter' }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f5f9', // Very light gray horizontal lines
                                drawBorder: false,
                            },
                            ticks: {
                                color: '#94a3b8',
                                font: { size: 11, family: 'Inter' },
                                stepSize: 20
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    }
                }
            });
        });
    </script>
@endpush