<div class="flex h-full w-full">
    @include('layouts.navigation')
    <div class="flex-1 overflow-y-auto">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Meter Readings') }}
            </h2>
        </x-slot>

        <div class="py-8">
            <div class="w-full px-6 lg:px-8"> {{-- changed from max-w-7xl mx-auto --}}
                {{-- Card --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
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
                    {{-- Filters --}}
                    <form method="GET" action="{{ route('meterreads.index') }}" class="mb-6 flex gap-6 items-center"
                        id="filterForm">
                        <div class="flex items-center gap-4">
                            <div class="relative inline-block text-left w-48">
                                <label for="vehicleDropdown"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Vehicle</label>

                                <div>
                                    <button type="button" id="vehicleDropdown"
                                        class="inline-flex w-full justify-between rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 h-10 dark:bg-gray-700 dark:text-white"
                                        onclick="toggleVehicleDropdown()" aria-haspopup="listbox" aria-expanded="false">
                                        <span id="selectedVehicle">
                                            {{ request('vehicle') ? request('vehicle') : 'All Vehicles' }}
                                        </span>
                                        <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
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
                                        <input type="text" id="vehicleSearchInput" placeholder="Search vehicles..."
                                            class="w-full px-2 py-1 text-sm border rounded-md dark:bg-gray-600 dark:text-white dark:placeholder-gray-300"
                                            onkeyup="filterVehicles()" />
                                    </div>

                                    <div class="py-1" role="listbox" tabindex="-1" aria-labelledby="vehicleDropdown">
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

                                <input type="hidden" name="vehicle" id="vehicleInput" value="{{ request('vehicle') }}">
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 items-end mt-4">
                            <button type="submit"
                                class="bg-amber-500 text-white px-4 py-2 rounded hover:bg-amber-600 shadow font-semibold">
                                Apply Filters
                            </button>

                            <a href="{{ route('meterreads.index') }}"
                                class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 px-4 py-2 rounded hover:bg-gray-300 dark:hover:bg-gray-500 shadow">
                                Clear Filters
                            </a>
                        </div>
                    </form>


                    {{-- Add Button --}}
                    <div class="mb-6 text-right">
                        <button onclick="document.getElementById('add-reading-modal').classList.remove('hidden')"
                            class="bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-4 rounded shadow">
                            + Add New Reading
                        </button>
                    </div>

                    {{-- Readings Table --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vehicle</th>
                                    <th
                                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Mileage (km)</th>
                                </tr>
                            </thead>
                            <tbody id="readingsTableBody" class="bg-white divide-y divide-gray-200">
                                @forelse ($readings as $reading)
                                    <tr data-vehicle="{{ $reading->vehicle->license_plate }}">
                                        <td class="px-4 py-3 text-center text-sm text-gray-900">
                                            {{ $reading->vehicle->license_plate }}</td>
                                        <td class="px-4 py-3 text-center text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($reading->date)->format('Y-m-d') }}</td>
                                        <td class="px-4 py-3 text-center text-sm text-gray-900">{{ $reading->mileage }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">No
                                            readings found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="py-6 flex justify-center">
                            {{ $readings->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- Modal --}}
        <div id="add-reading-modal" onclick="closeModalOnOutsideClick(event)"
            class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center px-2">
            <div
                class="w-full max-w-[700px] bg-white dark:bg-gray-900 rounded-2xl shadow-2xl p-4 transform transition-all scale-95 max-h-[calc(100vh-10rem)]">
                <div class="max-w-[500px] mx-auto">
                    <h2 class="text-lg font-semibold mb-8 text-amber-900 mt-2 dark:text-gray-100 text-center">Add New
                        Service Record</h2>
                    <form action="{{ route('meterreads.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <!-- Vehicle -->
                            <div class="relative inline-block text-left w-full">
                                <label for="vehicleDropdownStyled"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Vehicle</label>
                                <div>
                                    <button type="button" id="vehicleDropdownStyled"
                                        class="inline-flex w-full justify-between rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 h-10 dark:bg-gray-700 dark:text-white"
                                        onclick="toggleStyledVehicleDropdown()" aria-haspopup="listbox"
                                        aria-expanded="false">
                                        <span id="styledSelectedVehicle">Select Vehicle</span>
                                        <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.25 8.29a.75.75 0 0 1-.02-1.08z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>

                                <div id="styledVehicleDropdownMenu"
                                    class="hidden absolute z-10 mt-2 w-full rounded-md bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-700 max-h-48 overflow-y-auto">

                                    <!-- Search input -->
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
                                            onclick="selectStyledVehicle('', 'Select Vehicle')">Select Vehicle</button>
                                        @foreach ($vehicles as $vehicle)
                                            <button type="button"
                                                class="styled-vehicle-option w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                onclick="selectStyledVehicle('{{ $vehicle->id }}', '{{ $vehicle->license_plate }}')">
                                                {{ $vehicle->license_plate }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

                                <input type="hidden" name="vehicle_id" id="styledVehicleInput" required>
                            </div>

                            <!-- Service Date and Type -->
                            <div class="flex gap-4">
                                <div class="w-1/2">
                                    <label for="date"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                                    <input type="date" name="date" required
                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                </div>
                                <div class="w-1/2">
                                    <label for="mileage"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mileage
                                        (km)</label>
                                    <input type="number" name="mileage" id="mileage" required
                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end gap-3 mt-6">
                                <button type="button"
                                    onclick="document.getElementById('add-reading-modal').classList.add('hidden')"
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clearButton = document.getElementById('clearFilter');
        const vehicleFilter = document.getElementById('vehicleFilter');

        clearButton.addEventListener('click', function(e) {
            e.preventDefault();
            vehicleFilter.value = '';
            document.getElementById('filterForm').submit();
        });
    });
</script>
<script>
    // Close modal when clicking outside of it
    window.closeModalOnOutsideClick = function(event) {
        const addReadingModal = document.getElementById('add-reading-modal');
        if (event.target === addReadingModal) {
            addReadingModal.classList.add('hidden');
        }
    }
</script>

<script>
    function toggleVehicleDropdown() {
        const menu = document.getElementById('vehicleDropdownMenu');
        const btn = document.getElementById('vehicleDropdown');
        const expanded = btn.getAttribute('aria-expanded') === 'true';

        menu.classList.toggle('hidden');
        btn.setAttribute('aria-expanded', !expanded);
    }

    function selectVehicle(vehicle) {
        document.getElementById('selectedVehicle').innerText = vehicle || 'All Vehicles';
        document.getElementById('vehicleInput').value = vehicle;
        document.getElementById('vehicleDropdownMenu').classList.add('hidden');
        document.getElementById('vehicleDropdown').setAttribute('aria-expanded', false);
    }

    function filterVehicles() {
        const input = document.getElementById('vehicleSearchInput').value.toLowerCase();
        const items = document.querySelectorAll('.vehicle-option');

        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(input) ? 'block' : 'none';
        });
    }

    document.addEventListener('click', function(e) {
        const dropdownBtn = document.getElementById('vehicleDropdown');
        const dropdownMenu = document.getElementById('vehicleDropdownMenu');

        if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
            dropdownBtn.setAttribute('aria-expanded', false);
        }
    });

    // Optional: Reset filters
    const clearBtn = document.getElementById('clearFiltersBtn');
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            document.getElementById('filterForm').reset();
            document.getElementById('selectedVehicle').innerText = 'All Vehicles';
            document.getElementById('vehicleInput').value = '';
            document.getElementById('vehicleDropdownMenu').classList.add('hidden');
            document.getElementById('vehicleDropdown').setAttribute('aria-expanded', false);
            document.getElementById('filterForm').submit();
        });
    }
</script>


<script>
    function toggleStyledVehicleDropdown() {
        const menu = document.getElementById('styledVehicleDropdownMenu');
        menu.classList.toggle('hidden');

        const btn = document.getElementById('vehicleDropdownStyled');
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', !expanded);

        if (!menu.classList.contains('hidden')) {
            // Clear search and reset filter when opening
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

    // Close styled dropdown on outside click
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
