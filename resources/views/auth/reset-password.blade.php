<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reset Password | CustoHost</title>

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

  <div class="w-full max-w-lg bg-white/10 backdrop-blur-md border border-white/20 rounded-xl shadow-2xl p-8 text-white">

    <!-- Header -->
    <header class="text-center mb-6">
      <h2 class="text-2xl font-bold">Reset Your Password</h2>
      <p class="text-sm text-white/80 mt-1">Enter your email and new password below.</p>
    </header>

    <!-- Form -->
    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
      @csrf

      <!-- Password Reset Token -->
      <input type="hidden" name="token" value="{{ $request->route('token') }}">

      <!-- Email Address -->
      <div>
        <label for="email" class="block text-sm mb-1">Email</label>
        <div class="relative border border-white/30 bg-white/20 rounded-lg px-4 py-3">
          <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $request->email) }}"
            required
            autocomplete="username"
            class="w-full bg-transparent text-white outline-none placeholder-white/70"
            placeholder="you@example.com"
          />
        </div>
        @error('email')
          <span class="text-red-400 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- New Password -->
      <div>
        <label for="password" class="block text-sm mb-1">New Password</label>
        <div class="relative border border-white/30 bg-white/20 rounded-lg px-4 py-3">
          <input
            type="password"
            id="password"
            name="password"
            required
            autocomplete="new-password"
            class="w-full bg-transparent text-white outline-none placeholder-white/70"
            placeholder="••••••••"
          />
        </div>
        @error('password')
          <span class="text-red-400 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Confirm New Password -->
      <div>
        <label for="password_confirmation" class="block text-sm mb-1">Confirm New Password</label>
        <div class="relative border border-white/30 bg-white/20 rounded-lg px-4 py-3">
          <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            required
            autocomplete="new-password"
            class="w-full bg-transparent text-white outline-none placeholder-white/70"
            placeholder="••••••••"
          />
        </div>
        @error('password_confirmation')
          <span class="text-red-400 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Submit Button -->
      <div class="text-right">
        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
          Reset Password
        </button>
      </div>
    </form>

  </div>

</body>
</html>
