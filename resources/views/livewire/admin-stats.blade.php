<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Statistik</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Pending Requests -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-[#F39C12]">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-[#F39C12]">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Pending Requests</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $pendingRequests }}</p>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Requests -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-[#00A39D]">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-teal-100 text-[#00A39D]">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Requests</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalRequests }}</p>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Users -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Nasabah</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <!-- Card 4: Active Rekenings -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Active Rekening</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $activeRekenings }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <!-- Chart 1: Request Status Distribution -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Request Status Distribution</h3>
            <div class="relative h-64">
                <canvas id="requestStatusChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Account Growth -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">New Accounts (Last 7 Days)</h3>
            <div class="relative h-64">
                <canvas id="accountGrowthChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Integration -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        // 1. Request Status Chart (Doughnut)
        const ctxStatus = document.getElementById('requestStatusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Processed', 'Rejected'],
                datasets: [{
                    data: @json($chartStatusData),
                    backgroundColor: [
                        '#F39C12', // Pending - Orange
                        '#00A39D', // Processed - Teal
                        '#EF4444'  // Rejected - Red
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // 2. Account Growth Chart (Line)
        const ctxGrowth = document.getElementById('accountGrowthChart').getContext('2d');
        new Chart(ctxGrowth, {
            type: 'line',
            data: {
                labels: @json($growthLabels),
                datasets: [{
                    label: 'New Accounts',
                    data: @json($growthData),
                    borderColor: '#00A39D',
                    backgroundColor: 'rgba(0, 163, 157, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
