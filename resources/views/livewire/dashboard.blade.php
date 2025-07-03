<x-layouts.app title="Monitoring">
    <div>
        <x-card title="Temperature & Humidity" shadow separator>
        </x-card>
        <div class="p-4 bg-black-500 rounded-lg text-white">
            <h2 class="text-xl font-bold mb-4">ESP32-BASED SMART GREENHOUSE</h2>
            <div class="flex justify-between gap-4">

                <!-- Temperature -->
                <div class="flex-1 bg-gradient-to-r from-red-900 to-yellow-400 p-4 rounded-lg">
                    <h3 class="font-bold mb-2" style="text-align: center">TEMPERATURE</h3>
                    <div class="flex flex-col items-center justify-center">
                        <div class="flex items-center space-x-1 mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 14.76V5a2 2 0 10-4 0v9.76a4 4 0 104 0z" />
                            </svg>
                        <span id="temperature" class="text-white text-2xl font-bold">{{ $latest->temperature ?? 'N/A' }}</span><span style="font-size:24px">°C</span>
                        </div>
                    </div>
                </div>

                <!-- Humidity -->
                <div class="flex-1 bg-gradient-to-r from-blue-900 to-green-400 p-4 rounded-lg">
                    <h3 class="font-bold mb-2" style="text-align: center">HUMIDITY</h3>
                    <div class="flex flex-col items-center justify-center">
                        <div class="flex items-center space-x-1 mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 0 0 4.5 4.5H18a3.75 3.75 0 0 0 1.332-7.257 3 3 0 0 0-3.758-3.848 5.25 5.25 0 0 0-10.233 2.33A4.502 4.502 0 0 0 2.25 15Z" />
                            </svg>
                            <span id="humidity" class="text-white text-2xl font-bold">{{ $latest->humidity ?? 'N/A' }}</span><span style="font-size:24px">%</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
{{-- AJAX untuk update otomatis --}}
<script>
    function fetchSensorData() {
        fetch('/sensor-latest')
            .then(response => response.json())
            .then(data => {
                document.getElementById('temperature').innerText = data.temperature.toFixed(1);
                document.getElementById('humidity').innerText = data.humidity.toFixed(1);
            })
            .catch(err => {
                console.error('Gagal ambil data sensor:', err);
            });
    }

    fetchSensorData(); // Jalankan pertama kali
    setInterval(fetchSensorData, 5000); // Update tiap 5 detik
</script>


