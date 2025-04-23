<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo and Primary Navigation -->
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <i data-lucide="home" class="h-6 w-6 text-blue-600"></i>
                        CustoHost
                    </a>
                </div>

                <!-- Primary Navigation -->
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('dashboard') }}" 
                       class="{{ request()->routeIs('dashboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        <i data-lucide="layout-dashboard" class="h-4 w-4 mr-2"></i>
                        Dashboard
                    </a>

                    @role('hostel_manager')
                        <a href="{{ route('hostels.index') }}" 
                           class="{{ request()->routeIs('hostels.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i data-lucide="building" class="h-4 w-4 mr-2"></i>
                            Hostels
                        </a>

                        <a href="{{ route('rooms.index') }}" 
                           class="{{ request()->routeIs('rooms.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i data-lucide="door-open" class="h-4 w-4 mr-2"></i>
                            Rooms
                        </a>

                        <a href="{{ route('bookings.index') }}" 
                           class="{{ request()->routeIs('bookings.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i data-lucide="calendar" class="h-4 w-4 mr-2"></i>
                            Bookings
                        </a>

                        <a href="{{ route('payments.index') }}" 
                           class="{{ request()->routeIs('payments.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i data-lucide="credit-card" class="h-4 w-4 mr-2"></i>
                            Payments
                        </a>
                    @else
                        <a href="{{ route('hostels.browse') }}" 
                           class="{{ request()->routeIs('hostels.browse') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i data-lucide="search" class="h-4 w-4 mr-2"></i>
                            Browse Hostels
                        </a>

                        <a href="{{ route('bookings.index') }}" 
                           class="{{ request()->routeIs('bookings.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i data-lucide="calendar" class="h-4 w-4 mr-2"></i>
                            My Bookings
                        </a>

                        <a href="{{ route('payments.index') }}" 
                           class="{{ request()->routeIs('payments.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i data-lucide="credit-card" class="h-4 w-4 mr-2"></i>
                            Payments
                        </a>
                    @endrole
                </div>
            </div>

            <!-- User Menu -->
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <div class="ml-3 relative">
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-500">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i data-lucide="log-out" class="h-4 w-4 mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
                        aria-controls="mobile-menu"
                        aria-expanded="false"
                        onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <span class="sr-only">Open main menu</span>
                    <i data-lucide="menu" class="h-6 w-6"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="hidden sm:hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" 
               class="{{ request()->routeIs('dashboard') ? 'bg-blue-50 border-blue-500 text-blue-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Dashboard
            </a>

            @role('hostel_manager')
                <a href="{{ route('hostels.index') }}" 
                   class="{{ request()->routeIs('hostels.*') ? 'bg-blue-50 border-blue-500 text-blue-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Hostels
                </a>

                <a href="{{ route('rooms.index') }}" 
                   class="{{ request()->routeIs('rooms.*') ? 'bg-blue-50 border-blue-500 text-blue-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Rooms
                </a>

                <a href="{{ route('bookings.index') }}" 
                   class="{{ request()->routeIs('bookings.*') ? 'bg-blue-50 border-blue-500 text-blue-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Bookings
                </a>

                <a href="{{ route('payments.index') }}" 
                   class="{{ request()->routeIs('payments.*') ? 'bg-blue-50 border-blue-500 text-blue-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Payments
                </a>
            @else
                <a href="{{ route('hostels.browse') }}" 
                   class="{{ request()->routeIs('hostels.browse') ? 'bg-blue-50 border-blue-500 text-blue-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Browse Hostels
                </a>

                <a href="{{ route('bookings.index') }}" 
                   class="{{ request()->routeIs('bookings.*') ? 'bg-blue-50 border-blue-500 text-blue-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    My Bookings
                </a>

                <a href="{{ route('payments.index') }}" 
                   class="{{ request()->routeIs('payments.*') ? 'bg-blue-50 border-blue-500 text-blue-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Payments
                </a>
            @endrole
        </div>

        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                        <i data-lucide="user" class="h-6 w-6 text-gray-500"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>