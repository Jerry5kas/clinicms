<aside x-cloak
       :class="[
           sidebarOpen ? 'translate-x-0' : '-translate-x-full',
           'fixed sm:relative sm:translate-x-0',
           sidebarOpen ? 'sm:w-64' : 'sm:w-16'
       ]"
       class="z-30 h-full bg-white border-r transition-all duration-300 ease-in-out flex flex-col sm:z-0 w-64">

<!-- Header (Brand + Close) -->
    <div class="flex items-center justify-between p-4 text-xl font-bold border-b">
        <div :class="{ 'text-center w-full': !sidebarOpen }">
            <span x-show="sidebarOpen">ClinicMS</span>
            <span x-show="!sidebarOpen">🏥</span>
        </div>
        <!-- Toggle Button -->
        <button @click="toggleSidebar()" class="text-gray-600 sm:hidden">
            <!-- hamburger icon -->
        </button>


        <!-- Mobile close button -->
        <button @click="sidebarOpen = false"
                class="sm:hidden text-gray-600 hover:text-gray-900 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>


    <nav class="p-4 space-y-2 text-sm">
        <a href="{{ route('dashboard') }}"
           class="flex items-center p-2 gap-3 hover:bg-gray-100 transition-all duration-200"
           :class="{ 'justify-center': !sidebarOpen, 'justify-start': sidebarOpen }">

            <!-- Replace with Lucide or Heroicons -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-7-7v18"/>
            </svg>

            <!-- Text label, only shown when expanded -->
            <span x-show="sidebarOpen" class="whitespace-nowrap">Dashboard</span>
        </a>


        <a href="{{ route('dashboard') }}"
           class="flex items-center p-2 gap-3 hover:bg-gray-100 transition-all duration-200"
           :class="{ 'justify-center': !sidebarOpen, 'justify-start': sidebarOpen }">

            <!-- Replace with Lucide or Heroicons -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-7-7v18"/>
            </svg>

            <!-- Text label, only shown when expanded -->
            <span x-show="sidebarOpen" class="whitespace-nowrap">Doctors</span>
        </a>

    </nav>

</aside>
