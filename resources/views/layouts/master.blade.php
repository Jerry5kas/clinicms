<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClinicMS Dashboard</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        [x-cloak] { display: none !important; }
    </style>

</head>
<body class="bg-gray-100 text-gray-800">

<div x-data="{
    sidebarOpen: false,
    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
        localStorage.setItem('sidebarOpen', JSON.stringify(this.sidebarOpen));
    }
}" class="flex h-screen overflow-hidden relative">



    <!-- Overlay (mobile only) -->
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        class="fixed inset-0 bg-black bg-opacity-50 z-20 sm:hidden"
        @click="sidebarOpen = false"
        x-cloak>
    </div>



    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <!-- Main Content -->
    <div :class="sidebarOpen ? 'ml-0' : 'ml-0'" class="flex-1 flex flex-col transition-all duration-600 ease-in">
        @include('components.topbar')

        <main class="p-4 sm:p-6">
            @yield('content')
        </main>
    </div>

</div>


<!-- Alpine.js (for mobile toggle) -->
<script src="https://unpkg.com/alpinejs" defer></script>


</body>
</html>
