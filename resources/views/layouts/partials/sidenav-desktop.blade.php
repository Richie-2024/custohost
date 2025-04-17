<aside id="desktop-sidebar" class="w-60 bg-white shadow-lg hidden lg:block sticky top-0 max-h-screen overflow-y-auto transition-all duration-300 ease-in-out z-40 border-r-4 border-gradient-to-b from-blue-500 to-indigo-500">
  <ul class="py-6 space-y-4">
    <!-- Dashboard -->
    <li>
      <a href="{{ route('dashboard') }}" 
         class="block py-2 px-6 rounded-lg flex items-center 
         {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-800 font-semibold' : 'hover:bg-indigo-50 text-gray-800' }}">
          <i class="bi bi-house-door text-lg mr-3"></i>
          Dashboard
      </a>
  </li>
  

    <!-- Projects Section -->
    <li>
      <a href="#" class="desktop--link block py-2 px-6 hover:bg-indigo-50 focus:outline-none rounded-lg flex items-center">
        <i class="bi bi-folder text-lg mr-3"></i>
        Hostels
      </a>
    </li>

    <!-- Reports Dropdown with Nested Subtasks -->
    <li>
      <!-- Top-level Reports Dropdown Toggle -->
      <button class="desktop--dropdown-toggle block w-full text-left py-2 px-6 hover:bg-indigo-50 focus:outline-none flex items-center rounded-lg" data-dropdown-target="desktop--reports-dropdown">
        <i class="bi bi-bar-chart text-lg mr-3"></i>
        Payments
        <i class="bi bi-chevron-down ml-auto text-gray-600"></i>
      </button>

      <!-- Reports Dropdown Menu -->
      <ul id="desktop--reports-dropdown" class="desktop--dropdown hidden pl-6 space-y-2">
        <li>
          <a href="#" class="desktop--dropdown-link block py-2 hover:bg-indigo-100 focus:outline-none rounded-lg">Monthly</a>
        </li>
        <li>
          <a href="#" class="desktop--dropdown-link block py-2 hover:bg-indigo-100 focus:outline-none rounded-lg">Yearly</a>
        </li>
        <li>
          <a href="#" class="desktop--dropdown-link block py-2 hover:bg-indigo-100 focus:outline-none rounded-lg">Custom Reports</a>
        </li>

        <!-- Nested Subtasks Dropdown inside Reports -->
        <li>
          <button class="desktop--nested-dropdown-toggle block w-full text-left py-2 hover:bg-indigo-100 focus:outline-none flex items-center rounded-lg" data-dropdown-target="desktop--reports-subtasks-dropdown">
            <i class="bi bi-caret-right-fill text-lg mr-3"></i>
            Subpayment
            <i class="bi bi-chevron-down ml-auto text-gray-600"></i>
          </button>

          <ul id="desktop--reports-subtasks-dropdown" class="desktop--nested-dropdown hidden pl-6 space-y-2">
            <li>
              <a href="#" class="desktop--dropdown-link block py-2 hover:bg-indigo-200 focus:outline-none rounded-lg">Payment A</a>
            </li>
            <li>
              <a href="#" class="desktop--dropdown-link block py-2 hover:bg-indigo-200 focus:outline-none rounded-lg">Payment B</a>
            </li>
            <li>
              <a href="#" class="desktop--dropdown-link block py-2 hover:bg-indigo-200 focus:outline-none rounded-lg">Payment C</a>
            </li>
          </ul>
        </li>
      </ul>
    </li>

    <!-- Team Management -->
    <li>
      <a href="#" class="desktop--link block py-2 px-6 hover:bg-indigo-50 focus:outline-none rounded-lg flex items-center">
        <i class="bi bi-person-plus text-lg mr-3"></i>
        Room Management
      </a>
    </li>

    <!-- Invoices Section -->
    <li>
      <a href="#" class="desktop--link block py-2 px-6 hover:bg-indigo-50 focus:outline-none rounded-lg flex items-center">
        <i class="bi bi-file-earmark-text text-lg mr-3"></i>
        Invoices
      </a>
    </li>

    <!-- Calendar -->
    <li>
      <a href="#" class="desktop--link block py-2 px-6 hover:bg-indigo-50 focus:outline-none rounded-lg flex items-center">
        <i class="bi bi-calendar text-lg mr-3"></i>
        Bookings
      </a>
    </li>

    <!-- Settings Dropdown -->
    <li>
      <button class="desktop--dropdown-toggle block w-full text-left py-2 px-6 hover:bg-indigo-50 focus:outline-none flex items-center rounded-lg" data-dropdown-target="desktop--settings-dropdown">
        <i class="bi bi-gear text-lg mr-3"></i>
        Settings
        <i class="bi bi-chevron-down ml-auto text-gray-600"></i>
      </button>
      <ul id="desktop--settings-dropdown" class="desktop--dropdown hidden pl-6 space-y-2">
        <li>
          <a href="#" class="desktop--dropdown-link block py-2 hover:bg-indigo-100 focus:outline-none rounded-lg">General</a>
        </li>
        <li>
          <a href="#" class="desktop--dropdown-link block py-2 hover:bg-indigo-100 focus:outline-none rounded-lg">Security</a>
        </li>
        <li>
          <a href="#" class="desktop--dropdown-link block py-2 hover:bg-indigo-100 focus:outline-none rounded-lg">Notifications</a>
        </li>
      </ul>
    </li>
  </ul>
</aside>

<!-- JavaScript for Dropdown Functionality -->
<script>
  // Top-Level Dropdown Toggles
  const desktopDropdownToggles = document.querySelectorAll('.desktop--dropdown-toggle');
  desktopDropdownToggles.forEach((toggle) => {
    toggle.addEventListener('click', function () {
      const targetID = this.getAttribute('data-dropdown-target');
      const targetDropdown = document.getElementById(targetID);
      document.querySelectorAll('.desktop--dropdown').forEach((dropdown) => {
        if (dropdown.id !== targetID) {
          dropdown.classList.add('hidden');
        }
      });
      targetDropdown.classList.toggle('hidden');
    });
  });

  // Nested Dropdown Toggles (e.g., Subtasks inside Reports)
  const desktopNestedDropdownToggles = document.querySelectorAll('.desktop--nested-dropdown-toggle');
  desktopNestedDropdownToggles.forEach((toggle) => {
    toggle.addEventListener('click', function () {
      const targetID = this.getAttribute('data-dropdown-target');
      const targetDropdown = document.getElementById(targetID);
      document.querySelectorAll('.desktop--nested-dropdown').forEach((dropdown) => {
        if (dropdown.id !== targetID) {
          dropdown.classList.add('hidden');
        }
      });
      targetDropdown.classList.toggle('hidden');
    });
  });
</script>
