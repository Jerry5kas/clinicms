



<header class="flex items-center justify-between bg-white shadow px-4 py-4 sm:px-6">
    <!-- Mobile sidebar toggle -->
    <!-- Sidebar toggle for both mobile and desktop -->
    <button @click="toggleSidebar()" @click="sidebarOpen = !sidebarOpen" class="text-gray-600 hover:text-black focus:outline-none sm:block">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    <div class="text-lg font-semibold">Dashboard</div>

    <div class="flex items-center space-x-4">
        <span>{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-sm text-red-500 hover:text-red-700">Logout</button>
        </form>
    </div>
</header>
