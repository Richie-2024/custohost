<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Register | CustoHost</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <style>
        .input-field:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        .password-toggle {
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
        }
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)),
                        url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center text-white">

    <div class="w-full max-w-md bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl shadow-2xl p-8 m-4">
        <!-- Logo -->
        <div class="text-center mb-6">
            <a href="/" class="inline-flex items-center space-x-2">
                <i class="fas fa-home text-3xl text-white"></i>
                <span class="text-2xl font-bold">Custo<span class="text-amber-400">Host</span></span>
            </a>
        </div>

        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold">Create an Account</h1>
            <p class="text-sm text-gray-200">Join CustoHost to manage your stay easily</p>
        </div>

        <!-- Form -->
        <form id="registration-form" class="space-y-4" action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Full Name -->
            <div class="relative input-field border border-gray-300 bg-white/20 rounded-lg px-4 py-3">
                <label for="name" class="block text-xs font-medium text-white mb-1">Full Name</label>
                <input type="text" id="name" name="name" required class="w-full bg-transparent text-white outline-none placeholder-white">
                <i class="fas fa-user absolute right-4 top-1/2 transform -translate-y-1/2 text-white/70"></i>
            </div>

            <!-- Email -->
            <div class="relative input-field border border-gray-300 bg-white/20 rounded-lg px-4 py-3">
                <label for="email" class="block text-xs font-medium text-white mb-1">Email</label>
                <input type="email" id="email" name="email" required class="w-full bg-transparent text-white outline-none">
                <i class="fas fa-envelope absolute right-4 top-1/2 transform -translate-y-1/2 text-white/70"></i>
            </div>

            <!-- Phone Number -->
            <div class="relative input-field border border-gray-300 bg-white/20 rounded-lg px-4 py-3">
                <label for="phone" class="block text-xs font-medium text-white mb-1">Phone Number</label>
                <div class="flex">
                    <select name="phone_code" class="bg-white/10 text-white rounded-l-md px-2 outline-none border-r border-gray-300">
                        <option>+255</option>
                        <option>+254</option>
                        <option>+256</option>
                    </select>
                    <input type="tel" id="phone" name="phone" required class="w-full bg-transparent text-white outline-none pl-2">
                </div>
            </div>

            <!-- Password -->
            <div class="relative input-field border border-gray-300 bg-white/20 rounded-lg px-4 py-3">
                <label for="password" class="block text-xs font-medium text-white mb-1">Password</label>
                <input type="password" id="password" name="password" required class="w-full bg-transparent text-white outline-none pr-10">
                <button type="button" class="password-toggle absolute text-white/60 hover:text-white" onclick="togglePassword()">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            <!-- Confirm Password -->
            <div class="relative input-field border border-gray-300 bg-white/20 rounded-lg px-4 py-3">
                <label for="password_confirmation" class="block text-xs font-medium text-white mb-1">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full bg-transparent text-white outline-none pr-10">
                <button type="button" class="password-toggle absolute text-white/60 hover:text-white" onclick="togglePassword('password_confirmation')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            <!-- Terms -->
            <div class="flex items-start mt-4 text-white text-sm">
                <input type="checkbox" id="terms" name="terms" required class="mt-1 mr-2 rounded border-gray-300 text-sky-600 focus:ring-sky-500">
                <label for="terms">
                    I agree to CustoHost's <a href="#" class="text-amber-400 hover:underline">Terms of Service</a> and <a href="#" class="text-amber-400 hover:underline">Privacy Policy</a>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-4 rounded-lg transition duration-300 mt-6">
                Create Account
            </button>
        </form>

        <!-- Login Link -->
        <div class="text-center mt-6 text-white text-sm">
            Already have an account? <a href="{{route('login')}}" class="text-amber-400 font-medium hover:underline">Log in</a>
        </div>
    </div>

    <!-- Password Toggle Script -->
    <script>
        function togglePassword(fieldId = 'password') {
            const field = document.getElementById(fieldId);
            const toggle = field.nextElementSibling.querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                toggle.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password';
                toggle.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>
