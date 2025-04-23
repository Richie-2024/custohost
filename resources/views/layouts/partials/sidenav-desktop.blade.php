<aside id="desktop-sidebar" class="w-60 bg-white shadow-lg hidden lg:block sticky top-0 max-h-screen overflow-y-auto transition-all duration-300 ease-in-out z-40 border-r-4 border-gradient-to-b from-blue-500 to-indigo-500">
  <ul class="py-6 space-y-4">
    <!-- Dashboard -->
    <li>
      <a href="{{ route('dashboard') }}" 
         class="block py-2 px-6  flex items-center 
         {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-800 font-semibold' : 'hover:bg-indigo-50 text-gray-800' }}">
         <i class="bi bi-grid text-lg mr-3"></i> Dashboard

      </a>
    </li>
    
    @hostel_manager

    <!-- My Hostels Dropdown -->
    @php
      $hostelRoutes = ['hostels.show', 'hostels.create', 'hostels.edit', 'hostels.rooms', 'hostels.bookings'];
      $isHostelActive = collect($hostelRoutes)->contains(function($route) {
          return request()->routeIs($route);
      });
    @endphp
    <li>
      <button class="desktop--dropdown-toggle block w-full text-left py-2 px-6 focus:outline-none flex items-center" data-dropdown-target="desktop--hostels-dropdown">
        <i class="bi bi-house-door text-lg mr-3"></i> My Hostels

        <i class="bi bi-chevron-down ml-auto text-gray-600 transition-transform duration-200 {{ $isHostelActive ? 'rotate-180' : '' }}"></i>
      </button>
      <ul id="desktop--hostels-dropdown" class="desktop--dropdown pl-8 space-y-2 {{ $isHostelActive ? '' : 'hidden' }}">
        @if(Auth::user()->hostels->isEmpty())
          <li>
            <a href="{{ route('hostels.create') }}" 
               data-group="hostels"
               class="desktop--dropdown-link block py-2 hover:bg-indigo-100 focus:outline-none  flex items-center text-gray-500
                      {{ request()->routeIs('hostels.create') ? 'bg-indigo-100 text-indigo-700 font-semibold' : '' }}">
              <i class="bi bi-plus-circle text-sm mr-2"></i> 
              Create Hostel
            </a>
          </li>
          @else
          @foreach (Auth::user()->hostels as $hostel)
              <li>
                  <a href="{{ route('hostels.show', $hostel) }}" 
                     data-group="hostels"
                     class="desktop--dropdown-link block py-2 hover:bg-indigo-100 focus:outline-none flex items-center text-gray-500
                            {{ request()->routeIs('hostels.show') && request()->route('hostel') == $hostel->id ? 'bg-indigo-100 text-indigo-700 font-semibold' : '' }}">
                      <img src="{{ Storage::url($hostel->photo) }}" 
                           alt="{{ $hostel->name }}" 
                           class="w-8 h-8 rounded-full mr-3 object-cover">
                      {{ $hostel->name }}
                  </a>
              </li>
          @endforeach
      @endif
      
      </ul>
    </li>
{{-- Bookings --}}
    <li>
      <a href="{{ route('bookings.all') }}" 
         class="block py-2 px-6 flex items-center 
         {{ request()->routeIs('bookings.all') ? 'bg-indigo-100 text-indigo-800 font-semibold' : 'hover:bg-indigo-50 text-gray-800' }}">
         <i class="bi bi-calendar-check text-lg mr-3"></i> Bookings
      </a>
  </li>
  {{-- Payments --}}
  
  <li>
      <a href="{{ route('payments.index') }}" 
         class="block py-2 px-6 flex items-center 
         {{ request()->routeIs('payments.index') ? 'bg-indigo-100 text-indigo-800 font-semibold' : 'hover:bg-indigo-50 text-gray-800' }}">
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

    <!-- Settings Dropdown -->
    @php
      $settingRoutes = ['profile.show', 'settings.notifications'];
      $isSettingsActive = collect($settingRoutes)->contains(function($route) {
          return request()->routeIs($route);
      });
    @endphp
    <li>
      <button class="desktop--dropdown-toggle block w-full text-left py-2  px-6 focus:outline-none flex items-center " data-dropdown-target="desktop--settings-dropdown">
        <i class="bi bi-gear text-lg mr-3"></i>
        Settings
        <i class="bi bi-chevron-down ml-auto text-gray-600 transition-transform duration-200 {{ $isSettingsActive ? 'rotate-180' : '' }}"></i>
      </button>
      <ul id="desktop--settings-dropdown" class="desktop--dropdown pl-6 space-y-2 {{ $isSettingsActive ? '' : 'hidden' }}">
        <li>
          <a href="{{ route('profile.show') }}" 
          data-group="settings"
          class="desktop--dropdown-link block py-2 ml-3 hover:bg-indigo-100 focus:outline-none text-gray-500
                 {{ request()->routeIs('profile.show') ? 'bg-indigo-100 text-indigo-700 font-semibold' : '' }}">
          <i class="bi bi-person-circle text-lg mr-3 "></i> Profile
       </a>   
        </li>
      
      </ul>
    </li>
  </ul>
</aside>

<!-- Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  const dropdownToggles = document.querySelectorAll('.desktop--dropdown-toggle');

  dropdownToggles.forEach(toggle => {
    toggle.addEventListener('click', function () {
      const targetID = this.getAttribute('data-dropdown-target');
      const targetDropdown = document.getElementById(targetID);
      const chevronIcon = this.querySelector('.bi-chevron-down');

      // Close other dropdowns
      document.querySelectorAll('.desktop--dropdown').forEach(dropdown => {
        if (dropdown.id !== targetID) {
          dropdown.classList.add('hidden');
          const otherToggle = document.querySelector(`[data-dropdown-target="${dropdown.id}"]`);
          const otherChevron = otherToggle?.querySelector('.bi-chevron-down');
          if (otherChevron) {
            otherChevron.classList.remove('rotate-180');
          }
        }
      });

      // Toggle current dropdown and rotate chevron
      targetDropdown.classList.toggle('hidden');
      chevronIcon.classList.toggle('rotate-180');
    });
  });

  // Highlight only one subitem per group
  const subLinks = document.querySelectorAll('.desktop--dropdown-link');

  subLinks.forEach(link => {
    link.addEventListener('click', function () {
      const group = this.dataset.group;
      if (!group) return;

      document.querySelectorAll(`.desktop--dropdown-link[data-group="${group}"]`).forEach(item => {
        item.classList.remove('bg-indigo-100', 'text-indigo-700', 'font-semibold');
        item.classList.add('text-gray-500');
      });

      this.classList.add('bg-indigo-100', 'text-indigo-700', 'font-semibold');
      this.classList.remove('text-gray-500');
    });
  });
});
</script>
