<!-- Mobile Sidebar Overlay -->
<div id="mobile-overlay" class="fixed inset-0 bg-black opacity-50 hidden z-40"></div>

<!-- Mobile Sidebar -->
<aside id="mobile-sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 z-50 overflow-y-auto">
  <!-- Sidebar Header -->
  <div class="flex flex-row items-center justify-between px-4 py-4 border-b">
    <!-- Brand Logo -->
    <img src="{{ asset('images/v8.png') }}" alt="Brand Logo" class="w-16 h-16 rounded-full" />
    <!-- Close Button -->
    <button id="close-sidebar-btn" class="text-gray-600 focus:outline-none">
      <i class="bi bi-x-circle text-2xl"></i>
    </button>
  </div>

  <!-- Navigation Menu -->
  <ul class="py-6 space-y-4">
    <!-- Dashboard -->
    <li>
      <a href="{{ route('dashboard') }}" class="mobile-link block py-2 px-6 hover:bg-gray-100 flex items-center">
        <i class="bi bi-house-door text-lg mr-2"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="#" class="mobile-link block py-2 px-6 hover:bg-gray-100 flex items-center">
        <i class="bi bi-house-door text-lg mr-2"></i> Hello
      </a>
    </li>
    
    <!-- Client Management Dropdown -->
    <li>
      <button class="dropdown-toggle block w-full text-left py-2 px-6 hover:bg-gray-100 flex items-center focus:outline-none" data-dropdown-target="clients-dropdown">
        <i class="bi bi-person-badge text-lg mr-2"></i> Client Management
        <i class="bi bi-chevron-down ml-auto text-gray-600"></i>
      </button>
      <ul id="clients-dropdown" class="dropdown hidden pl-6 space-y-2">
        <li><a href="#" class="dropdown-link block py-2 hover:bg-gray-100">Client List</a></li>
        <li><a href="#" class="dropdown-link block py-2 hover:bg-gray-100">Add Client</a></li>
        <li><a href="#" class="dropdown-link block py-2 hover:bg-gray-100">Client Reports</a></li>
      </ul>
    </li>
    
    <!-- Support Tickets Dropdown -->
    <li>
      <button class="dropdown-toggle block w-full text-left py-2 px-6 hover:bg-gray-100 flex items-center focus:outline-none" data-dropdown-target="tickets-dropdown">
        <i class="bi bi-life-preserver text-lg mr-2"></i> Support Tickets
        <i class="bi bi-chevron-down ml-auto text-gray-600"></i>
      </button>
      <ul id="tickets-dropdown" class="dropdown hidden pl-6 space-y-2">
        <li><a href="#" class="dropdown-link block py-2 hover:bg-gray-100">Open Tickets</a></li>
        <li><a href="#" class="dropdown-link block py-2 hover:bg-gray-100">Resolved Tickets</a></li>
        <li><a href="#" class="dropdown-link block py-2 hover:bg-gray-100">Ticket Reports</a></li>
      </ul>
    </li>

    <!-- Financials Dropdown -->
    <li>
      <button class="dropdown-toggle block w-full text-left py-2 px-6 hover:bg-gray-100 flex items-center focus:outline-none" data-dropdown-target="financials-dropdown">
        <i class="bi bi-currency-dollar text-lg mr-2"></i> Financials
        <i class="bi bi-chevron-down ml-auto text-gray-600"></i>
      </button>
      <ul id="financials-dropdown" class="dropdown hidden pl-6 space-y-2">
        <li><a href="#" class="dropdown-link block py-2 hover:bg-gray-100">Invoices</a></li>
        <li><a href="#" class="dropdown-link block py-2 hover:bg-gray-100">Payments</a></li>
        <li><a href="#" class="dropdown-link block py-2 hover:bg-gray-100">Reports</a></li>
      </ul>
    </li>

    <!-- Settings Dropdown -->
    <li>
      <button class="dropdown-toggle block w-full text-left py-2 px-6 hover:bg-gray-100 flex items-center focus:outline-none" data-dropdown-target="settings-dropdown">
        <i class="bi bi-gear text-lg mr-2"></i> Settings
        <i class="bi bi-chevron-down ml-auto text-gray-600"></i>
      </button>
      <ul id="settings-dropdown" class="dropdown hidden pl-6 space-y-2">
        <li><a href="#" class="dropdown-link block py-2 hover:bg-gray-100">Profile</a></li>
        <li><a href="#" class="dropdown-link block py-2 hover:bg-gray-100">Preferences</a></li>
        <li><a href="#" class="dropdown-link block py-2 hover:bg-gray-100">Security</a></li>
      </ul>
    </li>
  </ul>
</aside>

<!-- JavaScript for Sidebar Functionality -->
@push('sidenav-mobile-scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Sidebar elements
    const menuBtn = document.getElementById('menu-btn');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const closeSidebarBtn = document.getElementById('close-sidebar-btn');
    const mobileOverlay = document.getElementById('mobile-overlay');
    const mobileLinks = document.querySelectorAll('.mobile-link');

    // Dropdown elements
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    const dropdownLinks = document.querySelectorAll('.dropdown-link');

    // Function to open the mobile sidebar
    function openMobileSidebar() {
      mobileSidebar.style.transform = 'translateX(0)';
      mobileOverlay.classList.remove('hidden');
    }

    // Function to close the mobile sidebar
    function closeMobileSidebar() {
      mobileSidebar.style.transform = 'translateX(-100%)';
      mobileOverlay.classList.add('hidden');
    }

    // Toggle dropdown functionality with enhanced logic
    dropdownToggles.forEach((toggle) => {
      toggle.addEventListener('click', function () {
        const targetID = this.getAttribute('data-dropdown-target');
        const targetDropdown = document.getElementById(targetID);

        // Close all other dropdowns
        document.querySelectorAll('.dropdown').forEach((dropdown) => {
          if (dropdown.id !== targetID) {
            dropdown.classList.add('hidden');
          }
        });

        // Toggle the target dropdown visibility
        targetDropdown.classList.toggle('hidden');
      });
    });

    // Close sidebar when dropdown links are clicked
    dropdownLinks.forEach((link) => {
      link.addEventListener('click', closeMobileSidebar);
    });

    // Event listeners for mobile sidebar
    menuBtn.addEventListener('click', openMobileSidebar);
    closeSidebarBtn.addEventListener('click', closeMobileSidebar);
    mobileOverlay.addEventListener('click', closeMobileSidebar);
    mobileLinks.forEach(link => {
      link.addEventListener('click', closeMobileSidebar);
    });
  });
</script>
@endpush
