<x-layouts.app title="Plant Monitoring">
    <div>
        <x-card title="Soil Moisture & Pump Status" shadow separator>
        </x-card>
        <div class="p-4 bg-black-500 rounded-lg text-white">
            <h2 class="text-xl font-bold mb-4">ESP32-BASED SMART GREENHOUSE</h2>
            <div class="flex justify-between gap-4">

                <!-- Soil Moisture -->
                <div class="flex-1 bg-gradient-to-r from-green-900 to-lime-400 p-4 rounded-lg">
                    <h3 class="font-bold mb-2" style="text-align: center">SOIL MOISTURE</h3>
                    <div class="flex flex-col items-center justify-center">
                        <div class="flex items-center space-x-1 mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15 11.25 1.5 1.5.75-.75V8.758l2.276-.61a3 3 0 1 0-3.675-3.675l-.61 2.277H12l-.75.75 1.5 1.5M15 11.25l-8.47 8.47c-.34.34-.8.53-1.28.53s-.94.19-1.28.53l-.97.97-.75-.75.97-.97c.34-.34.53-.8.53-1.28s.19-.94.53-1.28L12.75 9M15 11.25 12.75 9" />
                            </svg>
                            <span id="soil" class="text-white text-2xl font-bold">{{ $latest->soil_moisture ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Pump Status -->
               <div class="flex-1 p-4 rounded-lg {{ $latest->pump_status ? 'bg-gradient-to-r from-green-700 to-lime-400' : 'bg-gradient-to-r from-yellow-700 to-red-400' }}">
                    <h3 class="font-bold mb-2 text-center">PUMP STATUS</h3>
                    <div class="flex items-center justify-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                    </svg>
                    <span id="pump" class="text-white text-2xl font-bold">
                        {{ $latest->pump_status ? 'ON' : 'OFF' }}
                    </span>
                </div>
            </div>
            </div>
        </div>
    </div>
</x-layouts.app>

{{-- AJAX untuk update otomatis --}}
<script>
    function fetchPlantData() {
        fetch('/plant-latest') // Tidak perlu "/public/"
            .then(response => response.json())
            .then(data => {
                document.getElementById('soil').innerText = data.soil_moisture;
                document.getElementById('pump').innerText = data.pump_status ? 'ON' : 'OFF';
            })
            .catch(err => {
                console.error('Gagal ambil data plant:', err);
            });
    }

    fetchPlantData();
    setInterval(fetchPlantData, 3000);
</script>

