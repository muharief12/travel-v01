@extends('layouts.front')

@section('title', 'Home | Travela')
    
@section('content')
    <h1 class="font-semibold text-2xl leading-[36px] text-center">Explore New<br>Experience with Us</h1>
    <div id="categories" class="flex flex-col gap-3">
        <h2 class="font-semibold px-4">Categories</h2>
        <div class="main-carousel buttons-container">
        @forelse ($categories as $item)
            <a href="{{ route('front.category', $item->slug)}}" class="group px-2 first-of-type:pl-4 last-of-type:pr-4">
                <div class="p-3 flex items-center gap-2 rounded-[10px] border border-[#4D73FF] group-hover:bg-[#4D73FF] transition-all duration-300">
                <div class="w-6 h-6 flex shrink-0">
                    <img src="{{ Storage::url($item->icon)}}" alt="icon">
                </div>
                <span class="text-sm tracking-[0.35px] text-[#4D73FF] group-hover:text-white transition-all duration-300">{{ $item->name }}</span>
                </div>
            </a>
        @empty
            <p class="text-center w-full text-white bg-red-500 rounded-full py-4 font-bold">Sorry, the Categories data not available</p>
        @endforelse
        {{-- <a href="category.html" class="group px-2 first-of-type:pl-4 last-of-type:pr-4">
            <div class="p-3 flex items-center gap-2 rounded-[10px] border border-[#4D73FF] group-hover:bg-[#4D73FF] transition-all duration-300">
            <div class="w-6 h-6 flex shrink-0">
                <img src="assets/icons/mountain.svg" alt="icon">
            </div>
            <span class="text-sm tracking-[0.35px] text-[#4D73FF] group-hover:text-white transition-all duration-300">Mountain</span>
            </div>
        </a>
        <a href="category.html" class="group px-2 first-of-type:pl-4 last-of-type:pr-4">
            <div class="p-3 flex items-center gap-2 rounded-[10px] border border-[#4D73FF] group-hover:bg-[#4D73FF] transition-all duration-300">
            <div class="w-6 h-6 flex shrink-0">
                <img src="assets/icons/tent.svg" alt="icon">
            </div>
            <span class="text-sm tracking-[0.35px] text-[#4D73FF] group-hover:text-white transition-all duration-300">Nature</span>
            </div>
        </a>
        <a href="category.html" class="group px-2 first-of-type:pl-4 last-of-type:pr-4">
            <div class="p-3 flex items-center gap-2 rounded-[10px] border border-[#4D73FF] group-hover:bg-[#4D73FF] transition-all duration-300">
            <div class="w-6 h-6 flex shrink-0">
                <img src="assets/icons/historical.svg" alt="icon">
            </div>
            <span class="text-sm tracking-[0.35px] text-[#4D73FF] group-hover:text-white transition-all duration-300">Historical</span>
            </div>
        </a> --}}
        </div>
    </div>
    <div id="recommendations" class="flex flex-col gap-3">
        <h2 class="font-semibold px-4">Trip Recommendation</h2>
        <div class="main-carousel card-container">
        @forelse ($tours as $item)
            <a href="{{ route('front.detail', $item->slug)}}" class="group px-2 first-of-type:pl-4 last-of-type:pr-4">
                <div class="w-[288px] p-4 flex flex-col gap-3 rounded-[26px] bg-white shadow-[6px_8px_20px_0_#00000008]">
                <div class="w-full h-[330px] rounded-xl flex shrink-0 overflow-hidden">
                    <img src="{{ Storage::url($item->thumbnail)}}" class="w-full h-full object-cover" alt="thumbnails">
                </div>
                <div class="flex justify-between gap-2">
                    <div class="flex flex-col gap-1">
                    <p class="font-semibold two-lines">{{ $item->name }}</p>
                    <div class="flex items-center gap-1">
                        <div class="w-4 h-4 flex shrink-0">
                        <img src="assets/icons/location-map.svg" alt="icon">
                        </div>
                        <span class="text-sm text-darkGrey tracking-035">{{ $item->location }}</span>
                    </div>
                    </div>
                    <div class="flex flex-col gap-1 text-right">
                    <p class="text-sm leading-[21px]">
                        <span class="font-semibold text-[#4D73FF] text-nowrap">Rp {{ number_format($item->price, 0, ', ', '.')}}</span><br>
                        <span class="text-darkGrey">/ {{ $item->days }} days</span>
                    </p>
                    <div class="flex items-center gap-1 justify-end">
                        <div class="w-4 h-4 flex shrink-0">
                        <img src="assets/icons/Star.svg" alt="icon">
                        </div>
                        <span class="font-semibold text-sm leading-[21px]">4.8</span>
                    </div>
                    </div>
                </div>
                </div>
            </a>
        @empty
            <p class="text-center text-white bg-red-500 rounded-full py-4 font-bold">Sorry, the Package Tours data not available</p>
        @endforelse
        {{-- <a href="details.html" class="group px-2 first-of-type:pl-4 last-of-type:pr-4">
            <div class="w-[288px] p-4 flex flex-col gap-3 rounded-[26px] bg-white shadow-[6px_8px_20px_0_#00000008]">
            <div class="w-full h-[330px] rounded-xl flex shrink-0 overflow-hidden">
                <img src="assets/thumbnails/raja.jpg" class="w-full h-full object-cover" alt="thumbnails">
            </div>
            <div class="flex justify-between gap-2">
                <div class="flex flex-col gap-1">
                <p class="font-semibold two-lines">Raja Ampat Salawati Island</p>
                <div class="flex items-center gap-1">
                    <div class="w-4 h-4 flex shrink-0">
                    <img src="assets/icons/location-map.svg" alt="icon">
                    </div>
                    <span class="text-sm text-darkGrey tracking-035">Papua, Indonesia</span>
                </div>
                </div>
                <div class="flex flex-col gap-1 text-right">
                <p class="text-sm leading-[21px]">
                    <span class="font-semibold text-[#4D73FF] text-nowrap">Rp 900.000</span><br>
                    <span class="text-darkGrey">/3days</span>
                </p>
                <div class="flex items-center gap-1 justify-end">
                    <div class="w-4 h-4 flex shrink-0">
                    <img src="assets/icons/Star.svg" alt="icon">
                    </div>
                    <span class="font-semibold text-sm leading-[21px]">4.8</span>
                </div>
                </div>
            </div>
            </div>
        </a>
        <a href="details.html" class="group px-2 first-of-type:pl-4 last-of-type:pr-4">
            <div class="w-[288px] p-4 flex flex-col gap-3 rounded-[26px] bg-white shadow-[6px_8px_20px_0_#00000008]">
            <div class="w-full h-[330px] rounded-xl flex shrink-0 overflow-hidden">
                <img src="assets/thumbnails/maldives.jpg" class="w-full h-full object-cover" alt="thumbnails">
            </div>
            <div class="flex justify-between gap-2">
                <div class="flex flex-col gap-1">
                <p class="font-semibold two-lines">Maldives Exotic Island</p>
                <div class="flex items-center gap-1">
                    <div class="w-4 h-4 flex shrink-0">
                    <img src="assets/icons/location-map.svg" alt="icon">
                    </div>
                    <span class="text-sm text-darkGrey tracking-035">Bali, Indonesia</span>
                </div>
                </div>
                <div class="flex flex-col gap-1 text-right">
                <p class="text-sm leading-[21px]">
                    <span class="font-semibold text-[#4D73FF] text-nowrap">Rp 900.000</span><br>
                    <span class="text-darkGrey">/3days</span>
                </p>
                <div class="flex items-center gap-1 justify-end">
                    <div class="w-4 h-4 flex shrink-0">
                    <img src="assets/icons/Star.svg" alt="icon">
                    </div>
                    <span class="font-semibold text-sm leading-[21px]">4.8</span>
                </div>
                </div>
            </div>
            </div>
        </a> --}}
        </div>
    </div>
    <div id="discover" class="px-4">
        <div class="w-full h-[130px] flex flex-col gap-[10px] rounded-[22px] items-center overflow-hidden relative">
        <img src="assets/backgrounds/Banner.png" class="w-full h-full object-cover object-center" alt="background">
        <div class="absolute z-10 flex flex-col gap-[10px] transform -translate-y-1/2 top-1/2 left-4">
            <p class="text-white font-semibold">Discover the<br>Beauty of Japan</p>
            <a href="" class="bg-[#4D73FF] p-[8px_24px] rounded-[10px] text-white font-semibold text-xs w-fit">Discover</a>
        </div>
        </div>
    </div>
    <div id="explore" class="flex flex-col px-4 gap-3">
        <h2 class="font-semibold">More to Explore</h2>
        <a href="details.html" class="card">
            <div class="bg-white p-4 flex flex-col gap-3 rounded-[26px] shadow-[6px_8px_20px_0_#00000008]">
                <div class="w-full h-full aspect-[311/150] rounded-xl overflow-hidden">
                <img src="assets/thumbnails/castle.jpg" class="w-full h-full object-cover object-center" alt="thumbnail">
                </div>
                <div class="flex justify-between gap-2">
                <div class="flex flex-col gap-1">
                    <p class="font-semibold two-lines">Fortress Osaka Castle Park</p>
                    <div class="flex items-center gap-1">
                    <div class="w-4 h-4 flex shrink-0">
                        <img src="assets/icons/location-map.svg" alt="icon">
                    </div>
                    <span class="text-sm text-darkGrey tracking-035">Osaka, Japan</span>
                    </div>
                </div>
                <div class="flex flex-col gap-1 text-right">
                    <p class="text-sm leading-[21px]">
                    <span class="font-semibold text-[#4D73FF] text-nowrap">Rp 25.000.000</span><br>
                    <span class="text-darkGrey">/10days</span>
                    </p>
                    <div class="flex items-center gap-1 justify-end">
                    <div class="w-4 h-4 flex shrink-0">
                        <img src="assets/icons/Star.svg" alt="icon">
                    </div>
                    <span class="font-semibold text-sm leading-[21px]">4.8</span>
                    </div>
                </div>
                </div>
            </div>
        </a>
        <a href="details.html" class="card">
        <div class="bg-white p-4 flex flex-col gap-3 rounded-[26px] shadow-[6px_8px_20px_0_#00000008]">
            <div class="w-full h-full aspect-[311/150] rounded-xl overflow-hidden">
            <img src="assets/thumbnails/santorini.jpg" class="w-full h-full object-cover object-center" alt="thumbnail">
            </div>
            <div class="flex justify-between gap-2">
            <div class="flex flex-col gap-1">
                <p class="font-semibold two-lines">Santorini Island Aegean Sea</p>
                <div class="flex items-center gap-1">
                <div class="w-4 h-4 flex shrink-0">
                    <img src="assets/icons/location-map.svg" alt="icon">
                </div>
                <span class="text-sm text-darkGrey tracking-035">South Aegean, Greece</span>
                </div>
            </div>
            <div class="flex flex-col gap-1 text-right">
                <p class="text-sm leading-[21px]">
                <span class="font-semibold text-[#4D73FF] text-nowrap">Rp 20.000.000</span><br>
                <span class="text-darkGrey">/8days</span>
                </p>
                <div class="flex items-center gap-1 justify-end">
                <div class="w-4 h-4 flex shrink-0">
                    <img src="assets/icons/Star.svg" alt="icon">
                </div>
                <span class="font-semibold text-sm leading-[21px]">4.8</span>
                </div>
            </div>
            </div>
        </div>
        </a>
        <a href="details.html" class="card">
        <div class="bg-white p-4 flex flex-col gap-3 rounded-[26px] shadow-[6px_8px_20px_0_#00000008]">
            <div class="w-full h-full aspect-[311/150] rounded-xl overflow-hidden">
            <img src="assets/thumbnails/athena.jpg" class="w-full h-full object-cover object-center" alt="thumbnail">
            </div>
            <div class="flex justify-between gap-2">
            <div class="flex flex-col gap-1">
                <p class="font-semibold two-lines">Temple of Athena Nike</p>
                <div class="flex items-center gap-1">
                <div class="w-4 h-4 flex shrink-0">
                    <img src="assets/icons/location-map.svg" alt="icon">
                </div>
                <span class="text-sm text-darkGrey tracking-035">Acropolis, Greeces</span>
                </div>
            </div>
            <div class="flex flex-col gap-1 text-right">
                <p class="text-sm leading-[21px]">
                <span class="font-semibold text-[#4D73FF] text-nowrap">Rp 30.000.000</span><br>
                <span class="text-darkGrey">/8days</span>
                </p>
                <div class="flex items-center gap-1 justify-end">
                <div class="w-4 h-4 flex shrink-0">
                    <img src="assets/icons/Star.svg" alt="icon">
                </div>
                <span class="font-semibold text-sm leading-[21px]">5</span>
                </div>
            </div>
            </div>
        </div>
        </a>
    </div>

    <script src="{{ url('https://code.jquery.com/jquery-3.7.1.min.js')}}" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- JavaScript -->
    <script src="{{ url('https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js')}}"></script>
    <script src="{{ asset('js/flickity-slider.js')}}"></script>
    <script src="{{ asset('js/two-lines-text.js')}}"></script>
@endsection