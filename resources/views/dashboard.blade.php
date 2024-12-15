<x-app-layout>
    <!-- Header Section -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <!-- Main Content with full-screen background -->
    <div class="min-h-screen bg-cover bg-center" style="background-image: url('https://i.pinimg.com/736x/b6/db/c1/b6dbc1286429b2e9c6f6472b78d54b60.jpg');">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <!-- Card with overlay effect -->
            <div class="bg-black bg-opacity-60 p-8 rounded-lg shadow-lg text-white transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                <h3 class="text-3xl font-bold mb-4 text-center tracking-wide">
                    {{ __("Selamat Datang, Silva!") }}
                </h3>
                <p class="text-xl text-center mb-8">
                    {{ __("Semoga harimu menyenangkan dan produktif.") }}
                </p>
                <!-- Informational Text -->
                <div class="text-center text-lg mt-6">
                    <p class="text-white mb-4">
                        {{ __("Temukan koleksi buku menarik yang kami tawarkan, dan mulailah menjelajah!") }}
                    </p>
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
