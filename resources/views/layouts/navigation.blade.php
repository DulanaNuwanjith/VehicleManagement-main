<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vehicle Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-white to-amber-600 min-h-screen shadow-md flex flex-col">
        <!-- Logo -->
        <div class="flex items-center p-4 text-xl font-bold text-gray-700 border-b">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('icons/mainLogo.png') }}" alt="Logo" class="h-18 w-60 mr-2" />
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex flex-col justify-between flex-1 p-3 text-base font-bold text-amber-900">
            <!-- Menu Items -->
            <ul class="space-y-2">
                <li>
                    <a class="flex items-centerc bg-white px-4 py-2 rounded">
                        <span>VEHICAL MANAGEMENT</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('dashboard') ? 'bg-gray-200' : '' }}">
                        <img src="{{ asset('icons/statisctics.png') }}" alt="Dashboard" class="w-6 h-6 mr-5" />
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('vehicles.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('vehicles.*') ? 'bg-gray-200' : '' }}">
                        <img src="{{ asset('icons/list.png') }}" alt="Vehicles" class="w-6 h-6 mr-5" />
                        <span>Vehicles</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('services.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('services.*') ? 'bg-gray-200' : '' }}">
                        <img src="{{ asset('icons/sign.png') }}" alt="Service" class="w-6 h-6 mr-5" />
                        <span>Service</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('maintainances.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('maintainances.*') ? 'bg-gray-200' : '' }}">
                        <img src="{{ asset('icons/repair.png') }}" alt="Maintainance" class="w-6 h-6 mr-5" />
                        <span>Maintainance</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('meterreads.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('meterreads.*') ? 'bg-gray-200' : '' }}">
                        <img src="{{ asset('icons/speedometer.png') }}" alt="Meter Reading" class="w-6 h-6 mr-5" />
                        <span>Meter Reading</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('travelrecords.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('travelrecords.*') ? 'bg-gray-200' : '' }}">
                        <img src="{{ asset('icons/travel.png') }}" alt="Meter Reading" class="w-6 h-6 mr-5" />
                        <span>Travel Records</span>
                    </a>
                </li>
            </ul>

            <!-- Profile and Logout as Sidebar Buttons -->
            <ul class="space-y-2 border-t pt-4 mt-4">
                <li>
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('profile.edit') ? 'bg-gray-200' : '' }}">
                        <img src="{{ asset('icons/employee.png') }}" alt="Profile Icon" class="w-6 h-6 mr-5" />
                        <span>Profile</span>
                    </a>
                </li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center px-4 py-2 rounded hover:bg-gray-200 text-left text-amber-900">
                            <img src="{{ asset('icons/close.png') }}" alt="Logout Icon" class="w-6 h-6 mr-5" />
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

</body>

</html>
