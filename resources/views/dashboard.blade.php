<div class="flex h-full w-full font-sans">
    @include('layouts.navigation')
    <div class="flex-1 overflow-y-auto p-8 bg-gray-50 dark:bg-gray-900">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Vehicle Management Dashboard</h2>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Total Vehicles -->
            <div
                class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl p-6 shadow-xl hover:scale-105 transform transition-all">
                <div class="flex items-center mb-2">
                    <i data-lucide="truck" class="w-6 h-6 mr-2"></i>
                    <h4 class="text-xl font-semibold">Total Vehicles in Fleet</h4>
                </div>
                <p class="text-4xl font-bold text-center mt-5">{{ $totalVehicles }}</p>
            </div>

            <!-- Services Due Modal -->
            <div>
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-2xl p-6 shadow-xl hover:scale-105 transform transition-all cursor-pointer">
                    <div class="flex items-center mb-2">
                        <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i>
                        <h4 class="text-xl font-semibold">Vehicles with Services Due</h4>
                    </div>

                    <div class="flex">
                        <p class="text-4xl font-bold ml-16 mr-10 mt-5">{{ $dueServices->count() }}</p>
                        <button onclick="downloadDueServicesPDF()"
                            class="flex items-center gap-2 h-10 mt-5 px-4 py-2 bg-white text-orange-600 border border-orange-500 rounded-full text-sm font-semibold shadow-md hover:bg-orange-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v12m0 0l-3-3m3 3l3-3m-6 6h6" />
                            </svg>
                            Download PDF
                        </button>
                    </div>

                    <!-- Hidden list for PDF data -->
                    <ul id="dueServiceList" class="hidden">
                        @foreach ($dueServices as $service)
                            <li>{{ $service->vehicle->license_plate }} - {{ $service->next_service_mileage }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Service Cost -->
            <div
                class="bg-gradient-to-r from-green-500 to-teal-500 text-white rounded-2xl p-6 shadow-xl hover:scale-105 transform transition-all">
                <div class="flex items-center mb-2">
                    <i data-lucide="dollar-sign" class="w-6 h-6 mr-2"></i>
                    <h4 class="text-xl font-semibold">Service Cost (30 Days)</h4>
                </div>
                <p class="text-4xl font-bold mt-5">Rs. {{ number_format($totalServiceCost, 2) }}</p>
            </div>
        </div>

        <!-- Maintenance Cost Card -->
        <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-2xl p-6 shadow-xl mb-8">
            <div class="flex items-center mb-2">
                <i data-lucide="wrench" class="w-6 h-6 mr-2"></i>
                <h4 class="text-xl font-semibold">Maintenance Cost (30 Days)</h4>
            </div>
            <p class="text-4xl font-bold">Rs. {{ number_format($totalMaintenanceCost, 2) }}</p>
        </div>

        <!-- Charts Grid (2 per row, scrollable if too tall) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 overflow-auto max-h-[1000px] pr-2">
            <!-- Chart 1: Service Cost vs Date -->
            <div class="bg-white dark:bg-gray-700 p-4 rounded-xl shadow-md">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Service Cost vs Date</h4>
                <canvas id="costDateChart" class="w-full h-60"></canvas>
            </div>

            <!-- Chart 2: Service Cost per Vehicle -->
            <div class="bg-white dark:bg-gray-700 p-4 rounded-xl shadow-md">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Service Cost per Vehicle</h4>
                <canvas id="costVehicleChart" class="w-full h-60"></canvas>
            </div>

            <!-- Chart 3: Maintenance Cost per Vehicle -->
            <div class="bg-white dark:bg-gray-700 p-4 rounded-xl shadow-md">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Maintenance Cost per Vehicle</h4>
                <canvas id="maintenanceVehicleChart" class="w-full h-60"></canvas>
            </div>

            <!-- Chart 4: Total Cost per Vehicle -->
            <div class="bg-white dark:bg-gray-700 p-4 rounded-xl shadow-md">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Total Cost per Vehicle</h4>
                <canvas id="totalCostVehicleChart" class="w-full h-60"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();

    // PDF Generation
    function downloadDueServicesPDF() {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();
        doc.setFontSize(14);
        doc.text("Vehicles with Services Due", 10, 10);
        const items = Array.from(document.querySelectorAll('#dueServiceList li')).map((el, i) =>
            `${i + 1}. ${el.innerText}`);
        items.forEach((item, index) => {
            doc.text(item, 10, 20 + index * 8);
        });
        doc.save("vehicles_with_services_due.pdf");
    }

    // Charts
    new Chart(document.getElementById('costDateChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: @json($dates),
            datasets: [{
                label: 'Service Cost (Rs.)',
                data: @json($costs),
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                fill: true,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'Rs. ' + value
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('costVehicleChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: @json($vehicleLabels),
            datasets: [{
                label: 'Service Cost (Rs.)',
                data: @json($vehicleCosts),
                backgroundColor: 'rgb(34, 197, 94)',
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'Rs. ' + value
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('maintenanceVehicleChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: @json($maintenanceLabels),
            datasets: [{
                label: 'Maintenance Cost (Rs.)',
                data: @json($maintenanceCosts),
                backgroundColor: 'rgb(249, 115, 22)',
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'Rs. ' + value
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('totalCostVehicleChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: @json($combinedLabels),
            datasets: [{
                label: 'Total Cost (Rs.)',
                data: @json($combinedCosts),
                backgroundColor: 'rgb(168, 85, 247)',
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'Rs. ' + value
                    }
                }
            }
        }
    });
</script>

<!-- Font & Base Tailwind Setup -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
    }
</style>
