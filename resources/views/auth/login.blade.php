<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | HostelHub</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        .auth-bg {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="min-h-screen flex">
    <!-- Left Column (Background Image) -->
    <div class="hidden lg:block w-1/2 auth-bg text-white p-12 flex flex-col justify-between">
        <div>
            <a href="/" class="flex items-center space-x-2">
                <i class="fas fa-home text-3xl"></i>
                <span class="text-2xl font-bold">Hostel<span class="text-amber-300">Hub</span></span>
            </a>
        </div>
        <div>
            <h2 class="text-3xl font-bold mb-4">Your Student Accommodation Awaits</h2>
            <p class="text-lg">Login to book your perfect room and manage your stay</p>
        </div>
        <div class="flex space-x-4">
            <a href="#" class="text-white hover:text-amber-300"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-white hover:text-amber-300"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-white hover:text-amber-300"><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <!-- Right Column (Login Form) -->
    <div class="w-full lg:w-1/2 bg-gray-50 flex items-center justify-center p-8">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <div class="lg:hidden mb-8 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center space-x-2">
                    <i class="fas fa-home text-3xl text-sky-600"></i>
                    <span class="text-2xl font-bold">Hostel<span class="text-amber-500">Hub</span></span>
                </a>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-1">Welcome back!</h1>
                    <p class="text-gray-600 mb-6">Login to continue to your account</p>

                    <!-- Social Login Buttons -->
                    <div class="mb-6">
                        <div class="grid grid-cols-2 gap-3">
                            <a href="#" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-lg flex items-center justify-center">
                                <i class="fab fa-google text-red-500 mr-2"></i> Google
                            </a>
                            <a href="#" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-lg flex items-center justify-center">
                                <i class="fab fa-facebook text-blue-600 mr-2"></i> Facebook
                            </a>
                        </div>
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="bg-white px-2 text-gray-500">Or login with email</span>
                            </div>
                        </div>
                    </div>

                    <!-- Login Form -->
                    <form id="login-form" class="space-y-4" action="{{ route('login') }}" method="POST">
                        @csrf
                    
                        <!-- Email -->
                        <div class="relative input-field border border-gray-300 rounded-lg px-4 py-3 focus-within:border-sky-500">
                            <label for="email" class="block text-xs font-medium text-gray-500 mb-1">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full outline-none text-gray-800 @error('email') border-red-500 @enderror">
                            <i class="fas fa-envelope absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    
                        <!-- Password -->
                        <div class="relative input-field border border-gray-300 rounded-lg px-4 py-3 focus-within:border-sky-500">
                            <label for="password" class="block text-xs font-medium text-gray-500 mb-1">Password</label>
                            <input type="password" id="password" name="password" required
                                class="w-full outline-none text-gray-800 pr-10 @error('password') border-red-500 @enderror">
                            <button type="button" class="password-toggle absolute text-gray-400 hover:text-gray-600" onclick="togglePassword()">
                                <i class="fas fa-eye"></i>
                            </button>
                            @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    
                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember" name="remember" class="rounded border-gray-300 text-sky-600 focus:ring-sky-500 mr-2">
                                <label for="remember" class="text-sm text-gray-600">Remember me</label>
                            </div>
                            <a href="forgot-password.html" class="text-sm text-sky-600 hover:underline">Forgot password?</a>
                        </div>
                    
                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 mt-6">
                            Login
                        </button>
                    </form>
                    

                    <!-- Registration Link -->
                    <div class="text-center mt-6">
                        <p class="text-gray-600">Don't have an account? <a href="register.html" class="text-sky-600 font-medium hover:underline">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Toggle password visibility
        function togglePassword() {
            const field = document.getElementById('password');
            const toggle = field.nextElementSibling;
            const icon = toggle.querySelector('i');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Form submission
        document.getElementById('login-form').addEventListener('submit', function(e) {            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('remember').checked;
            
            // Simple validation
            if (!email || !password) {
                alert('Please fill in all fields');
                return;
            }
            
        });

       
    </script>
</body>
</html>