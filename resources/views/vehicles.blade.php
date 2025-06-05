<div class="flex h-full w-full">
    @include('layouts.navigation')
    <div class="flex-1 overflow-y-auto">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Vehicle List') }}
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

                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Vehicle List</h1>
                            <button onclick="document.getElementById('addVehicleModal').classList.remove('hidden')"
                                class="bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-4 rounded shadow">
                                + Add New Vehicle
                            </button>
                        </div>

                        <div class="overflow-x-auto bg-white dark:bg-gray-900 shadow rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th
                                            class="px-4 py-3 w-10 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            No</th>
                                        <th
                                            class="px-4 py-3 w-32 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Make</th>
                                        <th
                                            class="px-4 py-3 w-32 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Model</th>
                                        <th
                                            class="px-4 py-3 w-20 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Year</th>
                                        <th
                                            class="px-4 py-3 w-32 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            License Plate</th>
                                        <th
                                            class="px-4 py-3 w-40 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            License Expiry Date</th>
                                        <th
                                            class="px-4 py-3 w-40 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Insurance Expiry Date</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Status</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white dark:bg-gray-800 divide-y text-sm divide-gray-200 dark:divide-gray-700">
                                    @forelse ($vehicles as $index => $vehicle)
                                        <tr>
                                            <td class="px-4 py-3 w-10">{{ $index + 1 }}</td>
                                            <td class="px-4 py-3 w-32">{{ $vehicle->make }}</td>
                                            <td class="px-4 py-3 w-32">{{ $vehicle->model }}</td>
                                            <td class="px-4 py-3 w-20">{{ $vehicle->year }}</td>
                                            <td class="px-4 py-3 w-32">{{ $vehicle->license_plate }}</td>
                                            <td class="px-4 py-3 w-40">{{ $vehicle->license_expiration_date }}</td>
                                            <td class="px-4 py-3 w-40">{{ $vehicle->insurance_expiration_date }}</td>
                                            <td class="px-4 py-3">
                                                <span
                                                    class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full
                                                {{ $vehicle->status === 'Available'
                                                    ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                                    : ($vehicle->status === 'in_service'
                                                        ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200'
                                                        : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200') }}">
                                                    {{ ucfirst($vehicle->status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 flex gap-2">
                                                <button type="button"
                                                    onclick='openEditModal(
                                                {{ $vehicle->id }},
                                                {!! json_encode($vehicle->make) !!},
                                                {!! json_encode($vehicle->model) !!},
                                                {{ $vehicle->year }},
                                                {!! json_encode($vehicle->license_plate) !!},
                                                {!! json_encode($vehicle->license_expiration_date) !!},
                                                {!! json_encode($vehicle->insurance_expiration_date) !!},
                                                {!! json_encode($vehicle->color) !!},
                                                {!! json_encode($vehicle->type) !!},
                                                {!! json_encode($vehicle->status) !!}
                                            )'
                                                    class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 max-h-fit p-2  rounded ">
                                                    Edit
                                                </button>

                                                <form action="{{ route('vehicles.destroy', $vehicle->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this vehicle?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white text-sm max-h-fit px-3 p-2 rounded">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7"
                                                class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">No
                                                vehicles found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- Pagination Links -->
                            <div class="py-6 flex justify-center">
                                {{ $vehicles->links() }}
                            </div>
                        </div>

                        <!-- Modal -->
                        <div id="addVehicleModal"
                            class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center px-2">
                            <div
                                class="w-full max-w-[700px] bg-white dark:bg-gray-900 rounded-2xl shadow-2xl p-6 transform transition-all scale-95 max-h-[calc(100vh-10rem)] ">
                                <div class="max-w-[500px] mx-auto py-8">
                                    <h2
                                        class="text-lg font-semibold mb-8 text-amber-900 dark:text-gray-100 text-center">
                                        Add New Vehicle</h2>
                                    <form action="{{ route('vehicles.store') }}" method="POST">
                                        @csrf
                                        <div class="space-y-4">
                                            <!-- Row 1 -->
                                            <div class="flex gap-4">
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Make</label>
                                                    <input type="text" name="make" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Model</label>
                                                    <input type="text" name="model" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                            </div>

                                            <!-- Row 2 -->
                                            <div class="flex gap-4">
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year</label>
                                                    <input type="number" name="year" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">License
                                                        Plate</label>
                                                    <input type="text" name="license_plate" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                            </div>

                                            <!-- Row 3 -->
                                            <div class="flex gap-4">
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">License
                                                        Expiry Date</label>
                                                    <input type="date" name="license_expiration_date" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Insurance
                                                        Expiry Date</label>
                                                    <input type="date" name="insurance_expiration_date" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                            </div>

                                            <!-- Row 4 -->
                                            <div class="flex gap-4">
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Color</label>
                                                    <input type="text" name="color" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <!-- Type -->
                                                    <div class="relative inline-block text-left w-full ">
                                                        <label for="typeDropdown"
                                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type</label>
                                                        <div>
                                                            <button type="button" id="typeDropdown"
                                                                class="inline-flex w-full justify-between rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 h-10 dark:bg-gray-700 dark:text-white"
                                                                onclick="toggleTypeDropdown()" aria-haspopup="listbox"
                                                                aria-expanded="false">
                                                                <span id="selectedType">Select type</span>
                                                                <svg class="ml-2 h-5 w-5 text-gray-400"
                                                                    viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.25 8.29a.75.75 0 0 1-.02-1.08z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <div id="typeDropdownMenu"
                                                            class="hidden absolute z-10 mt-2 w-full rounded-md bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-700 max-h-40 overflow-y-auto">
                                                            <div class="py-1" role="listbox" tabindex="-1"
                                                                aria-labelledby="typeDropdown">
                                                                <button type="button"
                                                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                                    onclick="selectType('Car')">Car</button>
                                                                <button type="button"
                                                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                                    onclick="selectType('Van')">Van</button>
                                                                <button type="button"
                                                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                                    onclick="selectType('Motor Bike')">Motor
                                                                    Bike</button>
                                                                <button type="button"
                                                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                                    onclick="selectType('Truck')">Truck</button>
                                                                <button type="button"
                                                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                                    onclick="selectType('Bus')">Bus</button>
                                                                <button type="button"
                                                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                                    onclick="selectType('Other')">Other</button>
                                                            </div>
                                                        </div>


                                                        <input type="hidden" name="type" id="typeInput" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Row 5 -->
                                            <div class="flex gap-4">
                                                <div class="w-1/2">
                                                    <!-- Status -->
                                                    <div class="relative inline-block text-left w-full">
                                                        <label for="statusDropdown"
                                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                                        <div>
                                                            <button type="button" id="statusDropdown"
                                                                class="inline-flex w-full justify-between rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 h-10 dark:bg-gray-700 dark:text-white"
                                                                onclick="toggleStatusDropdown()"
                                                                aria-haspopup="listbox" aria-expanded="false">
                                                                <span id="selectedStatus">Select status</span>
                                                                <svg class="ml-2 h-5 w-5 text-gray-400"
                                                                    viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.25 8.29a.75.75 0 0 1-.02-1.08z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <div id="statusDropdownMenu"
                                                            class="hidden absolute z-10 mt-2 w-full rounded-md bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-700 max-h-48 overflow-y-auto">
                                                            <div class="py-1" role="listbox" tabindex="-1"
                                                                aria-labelledby="statusDropdown">
                                                                <button type="button"
                                                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                                    onclick="selectStatus('Available')">Available</button>
                                                                <button type="button"
                                                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                                    onclick="selectStatus('In Service')">In
                                                                    Service</button>
                                                                <button type="button"
                                                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600"
                                                                    onclick="selectStatus('Maintenance')">Maintenance</button>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="status" id="statusInput"
                                                            required>
                                                    </div>

                                                </div>
                                                <!-- Leave second half empty if needed -->
                                                <div class="w-1/2"></div>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="flex justify-end gap-3 mt-6">
                                            <button type="button"
                                                onclick="document.getElementById('addVehicleModal').classList.add('hidden')"
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

                        <!-- Modal -->
                        <div id="editVehicleModal"
                            class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center px-2">
                            <div
                                class="w-full max-w-[700px] bg-white dark:bg-gray-900 rounded-2xl shadow-2xl p-6 transform transition-all scale-95 max-h-[calc(100vh-10rem)] ">
                                <div class="max-w-[500px] mx-auto py-8">
                                    <h2
                                        class="text-lg font-semibold mb-8 text-amber-900 dark:text-gray-100 text-center">
                                        Edit Vehicle Details</h2>
                                    <form action="{{ route('vehicles.update', ':vehicle_id') }}" method="POST"
                                        id="editVehicleForm">
                                        @csrf
                                        @method('PUT')
                                        <div class="space-y-4">
                                            <!-- Row 1 -->
                                            <div class="flex gap-4">
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Make</label>
                                                    <input type="text" name="make" required id="editMake"
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Model</label>
                                                    <input type="text" name="model" required id="editModel"
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                            </div>

                                            <!-- Row 2 -->
                                            <div class="flex gap-4">
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year</label>
                                                    <input type="number" name="year" required id="editYear"
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">License
                                                        Plate</label>
                                                    <input type="text" name="license_plate" required
                                                        id="editLicensePlate"
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                            </div>

                                            <!-- Row 3 -->
                                            <div class="flex gap-4">
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">License
                                                        Expiry Date</label>
                                                    <input type="date" name="license_expiration_date" required
                                                        id="editLicenseExpiry"
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Insurance
                                                        Expiry Date</label>
                                                    <input type="date" name="insurance_expiration_date" required
                                                        id="editInsuranceExpiry"
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                            </div>

                                            <!-- Row 4 -->
                                            <div class="flex gap-4">
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                                                    <input type="text" name="color" required id="editColor"
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                                    <select name="type" id="editType" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                        <option value="car">Car</option>
                                                        <option value="van">Van</option>
                                                        <option value="motor_bike">Motor Bike</option>
                                                        <option value="truck">Truck</option>
                                                        <option value="bus">Bus</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <!-- Row 5 -->
                                            <div class="flex gap-4">
                                                <div class="w-1/2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                                    <select name="status" id="editStatus" required
                                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white text-sm">
                                                        <option value="available">Available</option>
                                                        <option value="in_service">In Service</option>
                                                        <option value="maintenance">Maintenance</option>
                                                    </select>
                                                </div>
                                                <!-- Leave second half empty if needed -->
                                                <div class="w-1/2"></div>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="flex justify-end gap-3 mt-6">
                                            <button
                                                onclick="document.getElementById('editVehicleModal').classList.add('hidden')"
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

                        <script>
                            function openEditModal(id, make, model, year, licensePlate, licenseExpiry, insuranceExpiry, color, type, status) {
                                // Set the action URL
                                document.getElementById('editVehicleForm').action = "{{ route('vehicles.update', ':vehicle_id') }}".replace(
                                    ':vehicle_id', id);

                                // Fill text inputs
                                document.getElementById('editMake').value = make;
                                document.getElementById('editModel').value = model;
                                document.getElementById('editYear').value = year;
                                document.getElementById('editLicensePlate').value = licensePlate;
                                document.getElementById('editLicenseExpiry').value = licenseExpiry;
                                document.getElementById('editInsuranceExpiry').value = insuranceExpiry;
                                document.getElementById('editColor').value = color;
                                document.getElementById('editType').value = type;

                                // ✅ Show the modal first
                                const modal = document.getElementById('editVehicleModal');
                                modal.classList.remove('hidden');

                                // ✅ Then set the status dropdown *after* a short delay
                                setTimeout(() => {
                                    const statusSelect = document.getElementById('editStatus');
                                    statusSelect.value = status.toLowerCase(); // optional, normalize case
                                }, 100);
                            }
                        </script>
                        <script>
                            // Close modal when clicking outside of it
                            window.onclick = function(event) {
                                const addVehicleModal = document.getElementById('addVehicleModal');
                                const editVehicleModal = document.getElementById('editVehicleModal');
                                if (event.target === addVehicleModal || event.target === editVehicleModal) {
                                    addVehicleModal.classList.add('hidden');
                                    editVehicleModal.classList.add('hidden');
                                }
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function toggleTypeDropdown() {
        const menu = document.getElementById('typeDropdownMenu');
        menu.classList.toggle('hidden');

        const btn = document.getElementById('typeDropdown');
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', !expanded);
    }

    function selectType(type) {
        document.getElementById('selectedType').innerText = type;
        document.getElementById('typeInput').value = type;
        document.getElementById('typeDropdownMenu').classList.add('hidden');
        document.getElementById('typeDropdown').setAttribute('aria-expanded', false);
    }

    function toggleStatusDropdown() {
        const menu = document.getElementById('statusDropdownMenu');
        menu.classList.toggle('hidden');

        const btn = document.getElementById('statusDropdown');
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', !expanded);
    }

    function selectStatus(status) {
        document.getElementById('selectedStatus').innerText = status;
        document.getElementById('statusInput').value = status;
        document.getElementById('statusDropdownMenu').classList.add('hidden');
        document.getElementById('statusDropdown').setAttribute('aria-expanded', false);
    }

    // Close dropdowns on outside click
    document.addEventListener('click', function(e) {
        const typeBtn = document.getElementById('typeDropdown');
        const typeMenu = document.getElementById('typeDropdownMenu');
        const statusBtn = document.getElementById('statusDropdown');
        const statusMenu = document.getElementById('statusDropdownMenu');

        if (!typeBtn.contains(e.target) && !typeMenu.contains(e.target)) {
            typeMenu.classList.add('hidden');
            typeBtn.setAttribute('aria-expanded', false);
        }

        if (!statusBtn.contains(e.target) && !statusMenu.contains(e.target)) {
            statusMenu.classList.add('hidden');
            statusBtn.setAttribute('aria-expanded', false);
        }
    });
</script>
