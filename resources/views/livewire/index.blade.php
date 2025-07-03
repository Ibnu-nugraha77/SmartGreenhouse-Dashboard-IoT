<div>
     <!-- HEADER -->
     <x-header title="ESP32-BASED SMART GREENHOUSE" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" />
        </x-slot:actions>
    </x-header>
    <!-- CARD  -->
    <x-card title="HOME" subtitle="SEMINAR TEKNIK ELEKTRO 2024/2025-2" >
    </x-card>
    <div 
    x-data="{ 
        slide: 1, 
        total: 3, 
        next() { this.slide = this.slide === this.total ? 1 : this.slide + 1 }, 
        prev() { this.slide = this.slide === 1 ? this.total : this.slide - 1 } 
    }" 
    x-init="setInterval(() => next(), 5000)" 
    class="mt-6 relative w-full max-w-4xl mx-auto overflow-hidden rounded-lg shadow-lg"
    >
    <!-- Slides -->
   <div class="relative w-full aspect-[16/9] overflow-hidden">
        <div class="absolute inset-0 flex transition-transform duration-700" :style="'transform: translateX(-' + (slide - 1) * 100 + '%)'">
            <img src="/images/slide1.jpg" alt="Slide 1" class="w-full h-full object-cover flex-shrink-0" />
            <img src="/images/slide2.jpg" alt="Slide 2" class="w-full h-full object-cover flex-shrink-0" />
            <img src="/images/slide3.jpg" alt="Slide 3" class="w-full h-full object-cover flex-shrink-0" />
        </div>
    </div>

    <!-- Previous/Next buttons -->
    <button @click="slide = slide === 1 ? 3 : slide - 1"
            class="absolute left-0 top-1/2 transform -translate-y-1/2 px-3 py-2 bg-black bg-opacity-50 text-white">
        ‹
    </button>
    <button @click="slide = slide === 3 ? 1 : slide + 1"
            class="absolute right-0 top-1/2 transform -translate-y-1/2 px-3 py-2 bg-black bg-opacity-50 text-white">
        ›
    </button>

    <!-- Indicator dots -->
    <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <template x-for="i in 3" :key="i">
            <button @click="slide = i"
                    :class="{ 'bg-white': slide === i, 'bg-gray-400': slide !== i }"
                    class="w-3 h-3 rounded-full transition-all duration-300"></button>
        </template>
    </div>
</div>

</div>
