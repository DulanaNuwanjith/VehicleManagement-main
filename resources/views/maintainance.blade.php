<div class="flex h-full w-full">
    @include('layouts.navigation')
    <div class="flex-1 overflow-y-auto">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Maintainance Records') }}
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
                        <form method="GET" action="{{ route('maintainances.index') }}"
                            class="mb-6 flex gap-6 items-center" id="filterForm">
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
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Maintainance
                                        Date</label>
                                    <input type="date" name="date" value="{{ request('date') }}"
                                        id="serviceDateFilter"
                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-3 items-end mt-4">
                                <button type="submit"
                                    class="bg-amber-500 text-white px-4 py-2 rounded hover:bg-amber-600">
                                    Apply Filters
                                </button>
                                <a href="{{ route('maintainances.index') }}"
                                    class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 px-4 py-2 rounded hover:bg-gray-300">
                                    Clear Filters
                                </a>
                            </div>
                        </form>

                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Maintainance Records</h1>
                            <button onclick="document.getElementById('addServiceModal').classList.remove('hidden')"
                                class="bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-4 rounded shadow">
                                + Add New Record
                            </button>
                        </div>

                        <div class="overflow-x-auto bg-white dark:bg-gray-900 shadow rounded-lg">
                            <table class="min-w-full table-fixed divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th
                                            class="px-6 py-3 w-10 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            No</th>
                                        <th
                                            class="px-4 py-3 w-[150px] text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase  ">
                                            Vehicle</th>
                                        <th
                                            class="px-4 py-3 w-[150px] text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Maintainance Date</th>
                                        <th
                                            class="px-4 py-3 w-[200px] text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase ">
                                            Cost</th>
                                        <th
                                            class="px-4 py-3 w-[500px] text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Description</th>

                                    </tr>
                                </thead>
                                <tbody id="serviceRecords"
                                    class="bg-white dark:bg-gray-800 text-sm divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($maintainances as $index => $maintainace)
                                        <tr class="record-row "
                                            data-vehicle="{{ $maintainace->vehicle->license_plate }}"
                                            data-date="{{ $maintainace->date }}">
                                            <td class="px-6 py-4 w-10">{{ $index + 1 }}</td>
                                            <td class="px-4 py-4  w-[150px] text-left">
                                                {{ $maintainace->vehicle->license_plate }}</td>
                                            <td class="px-4 py-4 w-[150px] text-center">{{ $maintainace->date }}</td>
                                            <td class="px-4 py-4 w-[300px] text-center">Rs.
                                                {{ number_format($maintainace->cost, 2) }}</td>
                                            <td class="px-4 py-4 w-[400px]">{{ $maintainace->description }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7"
                                                class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No
                                                maintainance records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>

                            <div class="py-6 flex justify-center">
                                {{ $maintainances->appends(request()->query())->links() }}
                            </div>
                        </div>

                        <!-- Add Maintenance Record Modal -->
                        <div id="addServiceModal" onclick="onclick(event)"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white dark:bg-gray-900 w-full max-w-2xl p-6 rounded-2xl shadow-2xl relative">

                                <h2 class="text-lg font-bold mb-8 text-amber-900 text-center dark:text-gray-100">Add
                                    Maintenance Record</h2>

                                <form action="{{ route('maintainances.store') }}" method="POST">
                                    @csrf

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Vehicle Select -->
                                        <div class="relative inline-block text-left w-full">
                                            <label for="vehicleDropdown2"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Vehicle</label>
                                            <div>
                                                <button type="button" id="vehicleDropdown2"
                                                    class="inline-flex w-full justify-between rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 h-10 dark:bg-gray-700 dark:text-white"
                                                    onclick="toggleVehicleDropdown2()" aria-haspopup="listbox"
                                                    aria-expanded="false">
                                                    <span id="selectedVehicle2">Select Vehicle</span>
                                                    <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.25 8.29a.75.75 0 0 1-.02-1.08z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <div id="vehicleDropdownMenu2"
                                                class="hidden absolute z-10 mt-2 w-full rounded-md bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-700 max-h-48 overflow-y-auto">

                                                <!-- Search box -->
                                                <div class="p-2 sticky top-0 bg-white dark:bg-gray-700 z-10">
                                                    <input type="text" id="vehicleSearchInput2"
                                                        placeholder="Search vehicles..."
                                                        class="w-full px-2 py-1 text-sm border rounded-md dark:bg-gray-600 dark:text-white dark:placeholder-gray-300"
                                                        onkeyup="filterVehicles2()" />
                                                </div>

                                                <div class="py-1" role="listbox" tabindex="-1"
                                                    aria-labelledby="vehicleDropdown2">
                                                    <button type="button"
                                                        class="vehicle-option2 w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                        onclick="selectVehicle2('', 'Select Vehicle')">
                                                        Select Vehicle
                                                    </button>
                                                    @foreach ($vehicles as $vehicle)
                                                        <button type="button"
                                                            class="vehicle-option2 w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                            onclick="selectVehicle2('{{ $vehicle->id }}', '{{ $vehicle->license_plate }}')">
                                                            {{ $vehicle->license_plate }}
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <input type="hidden" name="vehicle_id" id="vehicleInput2" required>
                                        </div>

                                        <!-- Date -->
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                                            <input type="date" name="date" required
                                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                        </div>

                                        <!-- Mileage -->
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mileage</label>
                                            <input type="number" name="mileage" required
                                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                        </div>

                                        <!-- Cost -->
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service
                                                Cost (Rs.)</label>
                                            <input type="number" name="cost" step="0.01" required
                                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                        </div>

                                        <!-- Done by -->
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Done
                                                by</label>
                                            <input type="text" name="done_by" step="0.01" required
                                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                        </div>

                                        <!-- Description -->
                                        <div class="md:col-span-2">
                                            <label
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                            <textarea name="description" rows="3"
                                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm"
                                                placeholder="Enter maintenance details..."></textarea>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="flex justify-end gap-3 mt-6">
                                        <button type="button"
                                            onclick="document.getElementById('addServiceModal').classList.add('hidden')"
                                            class="px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 text-sm rounded hover:bg-gray-300">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                            class="bg-amber-500 hover:bg-amber-600 text-white text-sm py-2 px-4 rounded shadow">
                                            Save Record
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


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const vehicleFilter = document.getElementById('vehicleFilter');
        const serviceDateFilter = document.getElementById('serviceDateFilter');
        const clearFiltersBtn = document.getElementById('clearFiltersBtn');

        function filterRecords() {
            const vehicleValue = vehicleFilter.value.trim().toLowerCase();
            const dateValue = serviceDateFilter.value.trim();

            document.querySelectorAll('.record-row').forEach(row => {
                const rowVehicle = row.dataset.vehicle.trim().toLowerCase();
                const rowDate = row.dataset.date.trim();

                const matchesVehicle = !vehicleValue || rowVehicle === vehicleValue;
                const matchesDate = !dateValue || rowDate === dateValue;

                if (matchesVehicle && matchesDate) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Clear button resets the filters and shows all
        clearFiltersBtn.addEventListener('click', () => {
            vehicleFilter.value = '';
            serviceDateFilter.value = '';
            filterRecords(); // Show all
        });
    });
</script>

<!-- <script>
    function closeModalOnOutsideClick(event) {
        const modal = document.getElementById('addServiceModal');
        modal.classList.add('hidden');
    }
</script> -->

<script>
    // Close modal when clicking outside of it
    window.onclick = function(event) {
        const addVehicleModal = document.getElementById('addServiceModal');
        if (event.target === addVehicleModal || event.target === addServiceModal) {
            addVehicleModal.classList.add('hidden');
            editVehicleModal.classList.add('hidden');
        }
    }
</script>


<script>
    function toggleVehicleDropdown2() {
        const menu = document.getElementById('vehicleDropdownMenu2');
        menu.classList.toggle('hidden');

        const btn = document.getElementById('vehicleDropdown2');
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', !expanded);

        if (!menu.classList.contains('hidden')) {
            // Clear search and reset filter when opening
            document.getElementById('vehicleSearchInput2').value = '';
            filterVehicles2();
        }
    }

    function filterVehicles2() {
        const input = document.getElementById('vehicleSearchInput2');
        const filter = input.value.toLowerCase();
        const options = document.querySelectorAll('#vehicleDropdownMenu2 .vehicle-option2');

        options.forEach(option => {
            const text = option.textContent.toLowerCase();
            option.style.display = text.includes(filter) ? '' : 'none';
        });
    }

    function selectVehicle2(id, label) {
        document.getElementById('selectedVehicle2').innerText = label;
        document.getElementById('vehicleInput2').value = id;
        document.getElementById('vehicleDropdownMenu2').classList.add('hidden');
        document.getElementById('vehicleDropdown2').setAttribute('aria-expanded', false);
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const btn = document.getElementById('vehicleDropdown2');
        const menu = document.getElementById('vehicleDropdownMenu2');

        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
            btn.setAttribute('aria-expanded', false);
        }
    });
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
