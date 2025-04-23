<!-- Mobile Sidebar Overlay -->
<div id="mobile-overlay" class="fixed inset-0 bg-black opacity-50 hidden z-40"></div>

<!-- Mobile Sidebar -->
<aside id="mobile-sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 z-50 overflow-y-auto">

  <!-- Sidebar Header -->
  <div class="flex items-center justify-between px-4 py-4 border-b">
    <img src="{{ asset('images/v8.png') }}" alt="Brand Logo" class="w-16 h-16 rounded-full" />
    <button id="close-sidebar-btn" class="text-gray-600 focus:outline-none">
      <i class="bi bi-x-circle text-2xl"></i>
    </button>
  </div>

  <!-- Navigation Menu -->
  <ul class="py-6 space-y-4">

    <!-- Dashboard -->
    <li>
      <a href="{{ route('dashboard') }}" class="block py-2 px-6 flex items-center {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-800 font-semibold' : 'hover:bg-gray-100 text-gray-800' }}">
        <i class="bi bi-house-door text-lg mr-2"></i> Dashboard
      </a>
    </li>

    @hostel_manager

    @php
      $hostelRoutes = ['hostels.show', 'hostels.create', 'hostels.edit', 'hostels.rooms', 'hostels.bookings'];
      $isHostelActive = collect($hostelRoutes)->contains(fn($route) => request()->routeIs($route));
    @endphp

    <!-- My Hostels -->
    <li>
      <button class="w-full text-left flex items-center py-2 px-6 focus:outline-none dropdown-toggle" data-dropdown-target="my-hostels-dropdown">
        <i class="bi bi-person-badge text-lg mr-2"></i> My Hostels
        <i class="bi bi-chevron-{{ $isHostelActive ? 'up' : 'down' }} ml-auto text-gray-600"></i>
      </button>

      <ul id="my-hostels-dropdown" class="pl-6 space-y-2 dropdown {{ $isHostelActive ? '' : 'hidden' }}">
        @if (Auth::user()->hostels->isEmpty())
          <li>
            <a href="{{ route('hostels.create') }}" class="block py-2 flex items-center hover:bg-indigo-100 {{ request()->routeIs('hostels.create') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-gray-600' }}">
              <i class="bi bi-plus-circle text-sm mr-2"></i> Create Hostel
            </a>
          </li>
        @else
          @foreach (Auth::user()->hostels as $hostel)
            <li>
              <a href="{{ route('hostels.show', $hostel) }}" class="block py-2 flex items-center hover:bg-indigo-100 {{ (request()->routeIs('hostels.show') && request()->route('hostel') == $hostel->id) ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-gray-600' }}">
                <img src="{{ Storage::url($hostel->photo) }}" alt="{{ $hostel->name }}" class="w-8 h-8 rounded-full mr-3 object-cover">
                {{ $hostel->name }}
              </a>
            </li>
          @endforeach
        @endif
      </ul>
    </li>

    <!-- Bookings -->
    <li>
      <a href="{{ route('bookings.all') }}" class="block py-2 px-6 flex items-center {{ request()->routeIs('bookings.all') ? 'bg-indigo-100 text-indigo-800 font-semibold' : 'hover:bg-indigo-50 text-gray-800' }}">
        <i class="bi bi-calendar-check text-lg mr-3"></i> Bookings
      </a>
    </li>

    <!-- Payments -->
    <li>
      <a href="{{ route('payments.index') }}" class="block py-2 px-6 flex items-center {{ request()->routeIs('payments.index') ? 'bg-indigo-100 text-indigo-800 font-semibold' : 'hover:bg-indigo-50 text-gray-800' }}">
        <i class="bi bi-cash-stack text-lg mr-3"></i> Payments
      </a>
    </li>
    @endhostel_manager
    @student
    <li>
      <a href="{{ route('hostels.browse') }}" 
         class="block py-2 px-6  flex items-center 
         {{ request()->routeIs('hostels.browse') ? 'bg-indigo-100 text-indigo-800 font-semibold' : 'hover:bg-indigo-50 text-gray-800' }}">
         <i class="bi bi-house-door text-lg mr-3"></i>Browse Hostels
  
      </a>
    </li>
    <li>
      <a href="{{ route('payments.index') }}" 
         class="block py-2 px-6  flex items-center 
         {{ request()->routeIs('payments.index') ? 'bg-indigo-100 text-indigo-800 font-semibold' : 'hover:bg-indigo-50 text-gray-800' }}">
         <i class="bi bi-cash-stack text-lg mr-3"></i>My Payments
      </a>
    </li>
    <li>
      <a href="{{ route('bookings.all') }}" 
         class="block py-2 px-6  flex items-center 
         {{ request()->routeIs('bookings.all') ? 'bg-indigo-100 text-indigo-800 font-semibold' : 'hover:bg-indigo-50 text-gray-800' }}">
         <i class="bi bi-calendar-check text-lg mr-3"></i>My  Bookings
        </a>
    </li>
    @endstudent


    @php
      $settingRoutes = ['profile.show', 'settings.notifications'];
      $isSettingsActive = collect($settingRoutes)->contains(fn($route) => request()->routeIs($route));
    @endphp

    <!-- Settings -->
    <li>
      <button class="w-full text-left flex items-center py-2 px-6 focus:outline-none dropdown-toggle" data-dropdown-target="settings-dropdown">
        <i class="bi bi-gear text-lg mr-3"></i> Settings
        <i class="bi bi-chevron-{{ $isSettingsActive ? 'up' : 'down' }} ml-auto text-gray-600"></i>
      </button>

      <ul id="settings-dropdown" class="pl-6 space-y-2 dropdown {{ $isSettingsActive ? '' : 'hidden' }}">
        <li>
          <a href="{{ route('profile.show') }}" class="block py-2 flex items-center hover:bg-indigo-100 {{ request()->routeIs('profile.show') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-gray-600' }}">
            <i class="bi bi-person-circle text-lg mr-3"></i> Profile
          </a>
        </li>
      </ul>
    </li>

    

  </ul>

</aside>

<!-- JavaScript for Sidebar and Dropdown Functionality -->
@push('sidenav-mobile-scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const menuBtn = document.getElementById('menu-btn');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const closeSidebarBtn = document.getElementById('close-sidebar-btn');
    const mobileOverlay = document.getElementById('mobile-overlay');
    const mobileLinks = document.querySelectorAll('.mobile-link');
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    function openMobileSidebar() {
      mobileSidebar.style.transform = 'translateX(0)';
      mobileOverlay.classList.remove('hidden');
    }

    function closeMobileSidebar() {
      mobileSidebar.style.transform = 'translateX(-100%)';
      mobileOverlay.classList.add('hidden');
    }

    // Dropdown toggle logic
    dropdownToggles.forEach((toggle) => {
      toggle.addEventListener('click', function () {
        const targetId = this.getAttribute('data-dropdown-target');
        const dropdown = document.getElementById(targetId);

        // Close other dropdowns except the one clicked
        document.querySelectorAll('.dropdown').forEach(d => {
          if (d.id !== targetId) d.classList.add('hidden');
        });

        dropdown.classList.toggle('hidden');
      });
    });

    // Event listeners for opening and closing sidebar
    menuBtn?.addEventListener('click', openMobileSidebar);
    closeSidebarBtn?.addEventListener('click', closeMobileSidebar);
    mobileOverlay?.addEventListener('click', closeMobileSidebar);
    mobileLinks.forEach(link => link.addEventListener('click', closeMobileSidebar));
  });
</script>
@endpush
