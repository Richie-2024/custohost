<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Forgot Password | CustoHost</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <style>
    body {
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
        url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
      background-size: cover;
      background-position: center;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4">

  <div class="w-full max-w-md bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl shadow-2xl p-8 text-white">

    <!-- Logo -->
    <div class="text-center mb-6">
      <a href="/" class="inline-flex items-center space-x-2">
        <i class="fas fa-home text-3xl text-white"></i>
        <span class="text-2xl font-bold">Cux-secondary-buttonspan class="text-amber-400">Host</span></span>
      </a>
    </div>

    <!-- Description -->
    <div class="mb-4 text-sm text-white/90 text-center">
      Forgot your password? No problem. Just let us know your email address and we’ll email you a link to reset it.
    </div>

    <!-- Session Status -->
    @if (session('status'))
      <div class="mb-4 text-green-400 text-sm text-center font-medium">
        {{ session('status') }}
      </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
      @csrf

      <!-- Email Input -->
      <div>
        <label for="email" class="block text-sm font-medium text-white mb-1">Email</label>
        <div class="relative border border-white/30 bg-white/20 rounded-lg px-4 py-3">
          <input
            type="email"
            name="email"
            id="email"
            value="{{ old('email') }}"
            required
            autofocus
            class="w-full bg-transparent text-white outline-none placeholder-white/70"
            placeholder="you@example.com"
          />
          <i class="fas fa-envelope absolute right-4 top-1/2 transform -translate-y-1/2 text-white/70"></i>
        </div>
        @error('email')
          <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
        @enderror
      </div>

      <!-- Submit Button -->
      <div class="flex items-center justify-end mt-4">
        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
          Email Password Reset Link
        </button>
      </div>
    </form>

    <!-- Back to Login -->
    <div class="text-center mt-6 text-sm">
      <a href="{{ route('login') }}" class="text-amber-400 hover:underline">Back to login</a>
    </div>

  </div>

</body>
</html>
