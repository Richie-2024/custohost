<header class="bg-gradient-to-b from-blue-800 via-blue-800 to-blue-800 text-white py-4 px-6 flex justify-between items-center sticky top-0 z-50 shadow-md border-b-2">
  <div class="flex items-center space-x-3">
    <!-- Brand Logo -->
    <img src="{{ asset('images/logo.png') }}" alt="Brand Logo" class="w-10 h-10 rounded-full" />
    <h1 class="text-xl font-semibold">CustoHost</h1>
  </div>

  <!-- Hamburger icon for small screens -->
  <button id="menu-btn" class="lg:hidden text-white focus:outline-none">
    <i class="bi bi-list text-2xl"></i>
  </button>

  <!-- Navigation Links -->
  <nav class="hidden lg:flex space-x-6">
    <a href="{{ route('home') }}" class="hover:text-indigo-400 transition duration-200">Home</a>
    <a href="#" class="hover:text-indigo-400 transition duration-200">{{ Auth::user()->name }}</a>
    <!-- Profile Dropdown -->
    <div class="relative">
      <button id="profile-btn" class="flex items-center space-x-2 text-white hover:text-indigo-400 transition duration-200">
        <img src="{{ Auth::user()->profile_image ? Storage::url(Auth::user()->profile_image) : asset('images/profile.png') }}" 
        alt="Profile Photo" 
        class="w-10 h-10 rounded-full" />

        <i class="bi bi-chevron-down"></i>
      </button>
      <!-- Dropdown Menu -->
      <div id="profile-dropdown" class="absolute right-0 hidden bg-white text-black shadow-lg rounded-md mt-2 w-48 py-2">
        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
          <i class="bi bi-person-circle text-lg mr-3 "></i>
          Profile</a>
        {{-- <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Settings</a> --}}
        <form action="{{ route('logout') }}" method="POST" class="inline">
          @csrf
          <button type="submit" class="block w-full px-4 py-2 text-sm text-red-600 hover:bg-gray-100 flex items-center gap-2">
            <i class="bi bi-box-arrow-right text-lg"></i> Logout
        </button>
        
        </form>
      </div>
    </div>
  </nav>
</header>

<script>
  // Toggle profile dropdown visibility
  document.getElementById('profile-btn').addEventListener('click', function() {
    const dropdown = document.getElementById('profile-dropdown');
    dropdown.classList.toggle('hidden');
  });

  // Close the dropdown if clicked outside
  document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('profile-dropdown');
    const profileButton = document.getElementById('profile-btn');
    if (!profileButton.contains(event.target) && !dropdown.contains(event.target)) {
      dropdown.classList.add('hidden');
    }
  });
</script>

