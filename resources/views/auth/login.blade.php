<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | CustoHost</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <style>
    body {
      background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)),
        url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
      background-size: cover;
      background-position: center;
    }
    .input-field:focus-within {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }
    .password-toggle {
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center text-white px-4">

  <div class="w-full max-w-md bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl shadow-2xl p-8">
    <!-- Logo -->
    <div class="text-center mb-6">
      <a href="/" class="inline-flex items-center space-x-2">
        <i class="fas fa-home text-3xl text-white"></i>
        <span class="text-2xl font-bold">Custo<span class="text-amber-400">Host</span></span>
      </a>
    </div>

    <!-- Welcome -->
    <div class="text-center mb-6">
      <h1 class="text-2xl font-bold">Welcome back!</h1>
      <p class="text-sm text-gray-200">Login to manage your stay</p>
    </div>

    <!-- Social Login -->
    <div class="mb-6">
      <div class="grid grid-cols-2 gap-3">
        <a href="#" class="bg-white/20 border border-white/30 hover:bg-white/30 text-white font-medium py-2 px-4 rounded-lg flex items-center justify-center">
          <i class="fab fa-google text-red-400 mr-2"></i> Google
        </a>
        <a href="#" class="bg-white/20 border border-white/30 hover:bg-white/30 text-white font-medium py-2 px-4 rounded-lg flex items-center justify-center">
          <i class="fab fa-facebook text-blue-400 mr-2"></i> Facebook
        </a>
      </div>

      <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
          <div class="w-full border-t border-white/30"></div>
        </div>
        <div class="relative flex justify-center mt-5">
          <span class="bg-white/10 px-2 text-sm text-white/80">Or login with email</span>
        </div>
      </div>
    </div>

    <!-- Login Form -->
    <form id="login-form" action="{{ route('login') }}" method="POST" class="space-y-4">
      @csrf

      <!-- Email -->
      <div class="relative input-field border border-gray-300 bg-white/20 rounded-lg px-4 py-3">
        <label for="email" class="block text-xs font-medium text-white mb-1">Email</label>
        <input type="email" id="email" name="email" required class="w-full bg-transparent text-white outline-none">
        <i class="fas fa-envelope absolute right-4 top-1/2 transform -translate-y-1/2 text-white/70"></i>
      </div>

      <!-- Password -->
      <div class="relative input-field border border-gray-300 bg-white/20 rounded-lg px-4 py-3">
        <label for="password" class="block text-xs font-medium text-white mb-1">Password</label>
        <input type="password" id="password" name="password" required class="w-full bg-transparent text-white outline-none pr-10">
        <button type="button" class="password-toggle absolute text-white/60 hover:text-white" onclick="togglePassword()">
          <i class="fas fa-eye"></i>
        </button>
      </div>

      <!-- Remember Me & Forgot -->
      <div class="flex items-center justify-between text-sm">
        <label class="flex items-center">
          <input type="checkbox" id="remember" name="remember" class="rounded text-sky-500 mr-2">
          <span>Remember me</span>
        </label>
        <a href="{{route('password.request')}}" class="text-amber-400 hover:underline">Forgot password?</a>
      </div>

      <!-- Submit -->
      <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-4 rounded-lg transition duration-300 mt-4">
        Login
      </button>
    </form>

    <!-- Register -->
    <div class="text-center mt-6 text-white text-sm">
      Don’t have an account? <a href="{{ route('register') }}" class="text-amber-400 font-medium hover:underline">Sign up</a>
    </div>
  </div>

  <script>
    function togglePassword() {
      const field = document.getElementById('password');
      const icon = field.nextElementSibling.querySelector('i');
      if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }
  </script>
</body>
</html>
