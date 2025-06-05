<div class="flex h-full w-full">
    @include('layouts.navigation')
    <div class="flex-1 overflow-y-auto">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Service Records') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        @if (session('success'))
                            <div
                                class="mb-4 p-4 text-green-800 bg-green-100 border border-green-300 rounded-md dark:text-green-200 dark:bg-green-900 dark:border-green-800">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div
                                class="mb-4 p-4 text-red-800 bg-red-100 border border-red-300 rounded-md dark:text-red-200 dark:bg-red-900 dark:border-red-800">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Filter Form -->
                        <form id="filterForm" method="GET" action="{{ route('services.index') }}"
                            class="mb-6 flex gap-6 items-center">
                            <div class="flex items-center gap-4">
                                <div class="relative inline-block text-left w-48">
                                    <label for="vehicleDropdown"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Vehicle</label>

                                    <div>
                                        <button type="button" id="vehicleDropdown"
                                            class="inline-flex w-full justify-between rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 h-10 dark:bg-gray-700 dark:text-white"
                                            onclick="toggleVehicleDropdown()" aria-haspopup="listbox"
                                            aria-expanded="false">
                                            <span id="selectedVehicle">
                                                {{ request('vehicle') ? request('vehicle') : 'All Vehicles' }}
                                            </span>
                                            <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.25 8.29a.75.75 0 0 1-.02-1.08z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div id="vehicleDropdownMenu"
                                        class="hidden absolute z-10 mt-2 w-full rounded-md bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-700 max-h-48 overflow-y-auto">

                                        <!-- Search box -->
                                        <div class="p-2 sticky top-0 bg-white dark:bg-gray-700 z-10">
                                            <input type="text" id="vehicleSearchInput"
                                                placeholder="Search vehicles..."
                                                class="w-full px-2 py-1 text-sm border rounded-md dark:bg-gray-600 dark:text-white dark:placeholder-gray-300"
                                                onkeyup="filterVehicles()" />
                                        </div>

                                        <div class="py-1" role="listbox" tabindex="-1"
                                            aria-labelledby="vehicleDropdown">
                                            <button type="button"
                                                class="vehicle-option w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                onclick="selectVehicle('')">All Vehicles</button>
                                            @foreach ($vehicles as $vehicle)
                                                <button type="button"
                                                    class="vehicle-option w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                    onclick="selectVehicle('{{ $vehicle->license_plate }}')">
                                                    {{ $vehicle->license_plate }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>

                                    <input type="hidden" name="vehicle" id="vehicleInput"
                                        value="{{ request('vehicle') }}">
                                </div>


                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service
                                        Date</label>
                                    <input type="date" id="serviceDateFilter" name="service_date"
                                        value="{{ request('service_date') }}"
                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Next
                                        Service Date</label>
                                    <input type="date" id="nextServiceDateFilter" name="next_service_date"
                                        value="{{ request('next_service_date') }}"
                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                </div>
                            </div>

                            <button type="submit"
                                class="mt-4 bg-amber-500 text-white px-4 py-2 rounded hover:bg-amber-600">
                                Apply Filters
                            </button>

                            <button type="button" id="clearFiltersBtn"
                                class="mt-4 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 px-4 py-2 rounded hover:bg-gray-300">
                                Clear Filters
                            </button>
                        </form>


                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Service Records</h1>
                            <button onclick="document.getElementById('addServiceModal').classList.remove('hidden')"
                                class="bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-4 rounded shadow">
                                + Add New Record
                            </button>
                        </div>

                        <div class="overflow-x-auto bg-white dark:bg-gray-900 shadow rounded-lg">
                            <table class="min-w-full table-fixed text-sm divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th
                                            class="px-4 py-3 w-10 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            No</th>
                                        <th
                                            class="px-4 py-3 w-32 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Vehicle</th>
                                        <th
                                            class="px-4 py-3 w-32 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Service Date</th>
                                        <th
                                            class="px-4 py-3 w-32 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Service Mileage</th>
                                        <th
                                            class="px-4 py-3 w-32 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Next Service Mileage</th>
                                        <th
                                            class="px-4 py-3 w-32 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Next Service Date</th>
                                        <th
                                            class="px-4 py-3 w-60 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Cost</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Actions</th>

                                    </tr>
                                </thead>
                                <tbody id="serviceRecords"
                                    class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($services as $index => $service)
                                        <tr data-vehicle="{{ $service->vehicle->license_plate }}"
                                            data-service-date="{{ $service->service_date }}"
                                            data-next-service-date="{{ $service->next_service_date }}">
                                            <td class="px-4 py-4 w-10">{{ $index + 1 }}</td>
                                            <td class="px-4 py-4 w-40">{{ $service->vehicle->license_plate }}</td>
                                            <td class="px-4 py-4 w-40">{{ $service->service_date }}</td>
                                            <td class="px-4 py-4 w-40 text-center">{{ $service->mileage }}</td>
                                            <td class="px-4 py-4 w-40 text-center">{{ $service->next_service_mileage }}
                                            </td>
                                            <td class="px-4 py-4 w-40 text-center">{{ $service->next_service_date }}
                                            </td>
                                            <td class="px-4 py-4 text-center">Rs.
                                                {{ number_format($service->service_cost, 2) }}</td>
                                            <td class="px-4 py-4">
                                                <button onclick="showServiceDetailsModal({{ json_encode($service) }})"
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                                                    View
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8"
                                                class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No
                                                service records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="py-6 flex justify-center">
                                {{ $services->links() }}
                            </div>

                        </div>

                        <!-- View Service Details Modal -->
                        <div id="viewServiceModal"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="w-[500px] bg-white dark:bg-gray-900 rounded-2xl shadow-2xl p-6">
                                <h2 class="text-lg font-semibold mb-4 text-center text-amber-900 ">Service Details</h2>
                                <div class="space-y-2 text-sm text-gray-700 dark:text-gray-200">
                                    <p><strong class="text-amber-700">Vehicle:</strong> <span id="viewVehicle"></span>
                                    </p>
                                    <p><strong class="text-amber-700">Service Date:</strong> <span
                                            id="viewServiceDate"></span></p>
                                    <p><strong class="text-amber-700">Service Type:</strong> <span
                                            id="viewServiceType"></span></p>
                                    <p><strong class="text-amber-700">Service Mileage:</strong> <span
                                            id="viewMileage"></span></p>
                                    <p><strong class="text-amber-700">Next Service Mileage:</strong> <span
                                            id="viewNextMileage"></span></p>
                                    <p><strong class="text-amber-700">Next Service Date:</strong> <span
                                            id="viewNextDate"></span></p>
                                    <p><strong class="text-amber-700">Location:</strong> <span
                                            id="viewLocation"></span></p>
                                    <p><strong class="text-amber-700">Cost (LKR):</strong> Rs. <span
                                            id="viewCost"></span></p>
                                    <p><strong class="text-amber-700">Service Notes:</strong> <span
                                            id="viewNotes"></span></p>
                                </div>
                                <div class="flex justify-end mt-6">
                                    <button
                                        onclick="document.getElementById('viewServiceModal').classList.add('hidden')"
                                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>


                        <!-- Add Service Record Modal -->
                        <div id="addServiceModal" onclick="closeModalOnOutsideClick(event)"
                            class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center px-2">
                            <div
                                class="w-full max-w-[700px] bg-white dark:bg-gray-900 rounded-2xl shadow-2xl p-4 transform transition-all scale-95 max-h-[calc(100vh-10rem)] overflow-y-auto">
                                <div class="max-w-[500px] mx-auto">
                                    <h2
                                        class="text-lg font-semibold mb-8 text-amber-900 mt-2 dark:text-gray-100 text-center">
                                        Add New Service Record</h2>
                                    <form action="{{ route('services.store') }}" method="POST">
                                        @csrf
                                        <div class="space-y-4">
                                            <!-- Vehicle -->
                                            <div class="relative inline-block text-left w-full">
                                                <label for="vehicleDropdownStyled"
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Vehicle</label>
                                                <div>
                                                    <button type="button" id="vehicleDropdownStyled"
                                                        class="inline-flex w-full justify-between rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 h-10 dark:bg-gray-700 dark:text-white"
                                                        onclick="toggleStyledVehicleDropdown()"
                                                        aria-haspopup="listbox" aria-expanded="false">
                                                        <span id="styledSelectedVehicle">Select Vehicle</span>
                                                        <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.25 8.29a.75.75 0 0 1-.02-1.08z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </div>

                                                <div id="styledVehicleDropdownMenu"
                                                    class="hidden absolute z-10 mt-2 w-full rounded-md bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-700 max-h-48 overflow-y-auto">

                                                    <!-- Search box -->
                                                    <div class="p-2 sticky top-0 bg-white dark:bg-gray-700 z-10">
                                                        <input type="text" id="styledVehicleSearchInput"
                                                            placeholder="Search vehicles..."
                                                            class="w-full px-2 py-1 text-sm border rounded-md dark:bg-gray-600 dark:text-white dark:placeholder-gray-300"
                                                            onkeyup="filterStyledVehicles()" />
                                                    </div>

                                                    <div class="py-1" role="listbox" tabindex="-1"
                                                        aria-labelledby="vehicleDropdownStyled">
                                                        <button type="button"
                                                            class="styled-vehicle-option w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                            onclick="selectStyledVehicle('', 'Select Vehicle')">Select
                                                            Vehicle</button>
                                                        @foreach ($vehicles as $vehicle)
                                                            <button type="button"
                                                                class="styled-vehicle-option w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                                onclick="selectStyledVehicle('{{ $vehicle->id }}', '{{ $vehicle->license_plate }}')">
                                                                {{ $vehicle->license_plate }}
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <input type="hidden" name="vehicle_id" id="styledVehicleInput"
                                                    required>
                                            </div>

                                            <!-- Service Date and Type -->
                                            <div class="flex gap-4">
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service
                                                        Date</label>
                                                    <input type="date" name="service_date" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <div class="relative inline-block text-left w-full">
                                                        <label for="serviceTypeDropdown"
                                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Service
                                                            Type</label>
                                                        <div>
                                                            <button type="button" id="serviceTypeDropdown"
                                                                class="inline-flex w-full justify-between rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 h-10 dark:bg-gray-700 dark:text-white"
                                                                onclick="toggleServiceTypeDropdown()"
                                                                aria-haspopup="listbox" aria-expanded="false">
                                                                <span id="selectedServiceType">Select Service
                                                                    Type</span>
                                                                <svg class="ml-2 h-5 w-5 text-gray-400"
                                                                    viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.25 8.29a.75.75 0 0 1-.02-1.08z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <div id="serviceTypeDropdownMenu"
                                                            class="hidden absolute z-10 mt-2 w-full rounded-md bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-700 max-h-48 overflow-y-auto">
                                                            <div class="py-1" role="listbox" tabindex="-1"
                                                                aria-labelledby="serviceTypeDropdown">
                                                                @php
                                                                    $serviceTypes = [
                                                                        'Full Service',
                                                                        'Partial Service',
                                                                        'Wheel Alignment',
                                                                        'Other',
                                                                    ];
                                                                @endphp
                                                                @foreach ($serviceTypes as $type)
                                                                    <button type="button"
                                                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                                        onclick="selectServiceType('{{ $type }}')">
                                                                        {{ $type }}
                                                                    </button>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="service_type"
                                                            id="serviceTypeInput" required>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- Mileage and Location -->
                                            <div class="flex gap-4">
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service
                                                        Mileage</label>
                                                    <input type="number" name="mileage" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service
                                                        Location</label>
                                                    <input type="text" name="service_location" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                            </div>

                                            <!-- Cost and Done By -->
                                            <div class="flex gap-4">
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cost
                                                        (LKR)</label>
                                                    <input type="number" step="0.01" name="service_cost" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Done
                                                        By</label>
                                                    <input type="text" name="done_by" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                            </div>

                                            <!-- Service Notes -->
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service
                                                    Notes</label>
                                                <textarea name="service_notes" rows="3"
                                                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm"></textarea>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="flex justify-end gap-3 mt-6">
                                            <button type="button"
                                                onclick="document.getElementById('addServiceModal').classList.add('hidden')"
                                                class="px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 text-sm rounded hover:bg-gray-300">
                                                Cancel
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 bg-amber-500 text-white text-sm rounded hover:bg-amber-600">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const vehicleInput = document.getElementById('vehicleInput');
        const serviceDateFilter = document.getElementById('serviceDateFilter');
        const nextServiceDateFilter = document.getElementById('nextServiceDateFilter');
        const clearFiltersBtn = document.getElementById('clearFiltersBtn');
        const selectedVehicle = document.getElementById('selectedVehicle');
        const filterForm = document.getElementById('filterForm');

        clearFiltersBtn.addEventListener('click', () => {
            // Clear values
            vehicleInput.value = '';
            serviceDateFilter.value = '';
            nextServiceDateFilter.value = '';

            // Reset dropdown label to default
            if (selectedVehicle) {
                selectedVehicle.textContent = 'All Vehicles';
            }

            // Submit the form
            filterForm.submit();
        });
    });
</script>


<script>
    function showServiceDetailsModal(service) {
        document.getElementById('viewVehicle').textContent = service.vehicle.license_plate;
        document.getElementById('viewServiceDate').textContent = service.service_date;
        document.getElementById('viewServiceType').textContent = service.service_type || '-';
        document.getElementById('viewMileage').textContent = service.mileage;
        document.getElementById('viewNextMileage').textContent = service.next_service_mileage;
        document.getElementById('viewNextDate').textContent = service.next_service_date;
        document.getElementById('viewLocation').textContent = service.service_location || '-';
        document.getElementById('viewCost').textContent = parseFloat(service.service_cost).toFixed(2);
        document.getElementById('viewNotes').textContent = service.service_notes || 'N/A';

        document.getElementById('viewServiceModal').classList.remove('hidden');
    }
</script>

<script>
    // Close modal when clicking outside of it
    window.closeModalOnOutsideClick = function(event) {
        const addVehicleModal = document.getElementById('addServiceModal');
        if (event.target === addVehicleModal) {
            addServiceModal.classList.add('hidden');
        }
    }
</script>

<script>
    function toggleVehicleDropdown() {
        const menu = document.getElementById('vehicleDropdownMenu');
        menu.classList.toggle('hidden');
        const btn = document.getElementById('vehicleDropdown');
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', !expanded);
    }

    function selectVehicle(vehicle) {
        document.getElementById('selectedVehicle').innerText = vehicle || 'All Vehicles';
        document.getElementById('vehicleInput').value = vehicle;
        document.getElementById('vehicleDropdownMenu').classList.add('hidden');
        document.getElementById('vehicleDropdown').setAttribute('aria-expanded', false);
    }

    // Clear filters
    document.getElementById('clearFiltersBtn').addEventListener('click', function() {
        // Reset form fields
        document.getElementById('filterForm').reset();

        // Reset vehicle dropdown manually
        document.getElementById('selectedVehicle').innerText = 'All Vehicles';
        document.getElementById('vehicleInput').value = '';

        // Optionally: Submit form after clearing
        document.getElementById('filterForm').submit();
    });

    document.addEventListener('click', function(e) {
        const vehicleBtn = document.getElementById('vehicleDropdown');
        const vehicleMenu = document.getElementById('vehicleDropdownMenu');
        if (!vehicleBtn.contains(e.target) && !vehicleMenu.contains(e.target)) {
            vehicleMenu.classList.add('hidden');
            vehicleBtn.setAttribute('aria-expanded', false);
        }
    });
</script>

<script>
    function toggleStyledVehicleDropdown() {
        const menu = document.getElementById('styledVehicleDropdownMenu');
        menu.classList.toggle('hidden');

        const btn = document.getElementById('vehicleDropdownStyled');
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', !expanded);

        // Clear search input and reset filter when dropdown opens
        if (!menu.classList.contains('hidden')) {
            document.getElementById('styledVehicleSearchInput').value = '';
            filterStyledVehicles();
        }
    }

    function filterStyledVehicles() {
        const input = document.getElementById('styledVehicleSearchInput');
        const filter = input.value.toLowerCase();
        const options = document.querySelectorAll('#styledVehicleDropdownMenu .styled-vehicle-option');

        options.forEach(option => {
            const text = option.textContent.toLowerCase();
            option.style.display = text.includes(filter) ? '' : 'none';
        });
    }

    function selectStyledVehicle(value, label) {
        document.getElementById('styledSelectedVehicle').innerText = label;
        document.getElementById('styledVehicleInput').value = value;
        document.getElementById('styledVehicleDropdownMenu').classList.add('hidden');
        document.getElementById('vehicleDropdownStyled').setAttribute('aria-expanded', false);
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const styledBtn = document.getElementById('vehicleDropdownStyled');
        const styledMenu = document.getElementById('styledVehicleDropdownMenu');

        if (!styledBtn.contains(e.target) && !styledMenu.contains(e.target)) {
            styledMenu.classList.add('hidden');
            styledBtn.setAttribute('aria-expanded', false);
        }
    });
</script>

<script>
    function toggleServiceTypeDropdown() {
        const menu = document.getElementById('serviceTypeDropdownMenu');
        menu.classList.toggle('hidden');

        const btn = document.getElementById('serviceTypeDropdown');
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', !expanded);
    }

    function selectServiceType(value) {
        document.getElementById('selectedServiceType').innerText = value;
        document.getElementById('serviceTypeInput').value = value;
        document.getElementById('serviceTypeDropdownMenu').classList.add('hidden');
        document.getElementById('serviceTypeDropdown').setAttribute('aria-expanded', false);
    }

    // Close on outside click
    document.addEventListener('click', function(e) {
        const btn = document.getElementById('serviceTypeDropdown');
        const menu = document.getElementById('serviceTypeDropdownMenu');

        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
            btn.setAttribute('aria-expanded', false);
        }
    });
</script>
