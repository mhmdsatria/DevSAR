<div x-data="{
    activeIndex: 0,
    itemsCount: {{ count($items) }},
    init() {
        setInterval(() => {
            this.activeIndex = (this.activeIndex + 1) % this.itemsCount;
        }, 4000);
    }
}" class="relative w-full overflow-hidden"> {{-- Added overflow-hidden to the main container --}}

    <div class="flex transition-transform duration-500 ease-in-out"
         :style="`transform: translateX(-${activeIndex * 100}%)`"> {{-- Control slide position --}}
        @foreach ($items as $index => $item)
            <div class="w-full flex-shrink-0"> {{-- Each slide takes full width and doesn't shrink --}}
                <img src="{{ asset('carousel/' . $item->gambar) }}" alt="Carousel {{ $index + 1 }}"
                     class="w-full h-48 sm:h-64 md:h-72 object-cover"> {{-- Adjusted image height for responsiveness --}}
            </div>
        @endforeach
    </div>

    {{-- Carousel Navigation (Optional: Dots or Arrows) --}}
    <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
        @foreach ($items as $index => $item)
            <button @click="activeIndex = {{ $index }}"
                    :class="{ 'bg-blue-500': activeIndex === {{ $index }}, 'bg-gray-300': activeIndex !== {{ $index }} }"
                    class="w-3 h-3 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75"></button>
        @endforeach
    </div>

    {{-- Optional: Prev/Next Arrows --}}
    <button @click="activeIndex = (activeIndex - 1 + itemsCount) % itemsCount"
            class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 focus:outline-none">
        &#10094;
    </button>
    <button @click="activeIndex = (activeIndex + 1) % itemsCount"
            class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 focus:outline-none">
        &#10095;
    </button>
</div>