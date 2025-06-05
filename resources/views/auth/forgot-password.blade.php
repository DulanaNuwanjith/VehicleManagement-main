<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Rangiri</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-amber-500 to-white">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-4xl bg-white shadow-lg rounded-2xl overflow-hidden flex">
            <!-- Left Panel -->
            <div
                class="w-1/2 bg-gradient-to-br from-amber-500 to-amber-300 text-white flex flex-col justify-center items-center p-8">
                <div class=" items-center rounded-lg mt-6 h-40 mb-32">
                    <img src="{{ asset('icons/mainLogo.png') }}" alt="Logo" class="w-48 object-contain" />
                </div>
                <p class="text-sm text-center font-sans px-4 text-amber-900">
                    Our vision is to be the leading Sri Lankan holding company, securing its interests as a preferred
                    partner for institutional investors in the private and public sectors, as well as multinational
                    corporations, to standardize the efficacy and profitability of the businesses in which Rangiri
                    Holdings has a stake.
                </p>
            </div>

            <!-- Right Panel -->
            <div class="w-1/2 p-8 flex flex-col justify-center">
                <h2 class="text-2xl font-sans font-bold text-amber-700 mb-2">VEHICAL MANAGEMENT SYSTEM</h2>
                <h2 class="text-lg font-sans font-bold text-amber-700 mb-2">(RANGIRI HOLDINGS)</h2>
                <p class="text-sm text-gray-600 mb-6 font-semibold">Forgot your password?</p>
                <p class="text-sm text-gray-600 mb-6">No problem. Just let us know your email address and we will email
                    you a password reset link that will allow you to choose a new one.</p>
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <input id="email" type="email" placeholder="Email" name="email" :value="old('email')"
                        required autofocus
                        class="w-full text-sm font-sans mb-4 px-4 py-2 rounded-full bg-green-100 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-amber-400" />

                    {{-- Show error messages --}}
                    @if ($errors->any())
                        <p class="text-red-500 text-sm mb-4">{{ $errors->first() }}</p>
                    @endif

                    <button type="submit"
                        class="w-full font-sans font-semibold bg-amber-600 text-white py-2 rounded-full hover:bg-amber-700 transition">Email
                        Password Reset Link</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
