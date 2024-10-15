@extends('layouts.front')

@section('title', 'My Booking Schedule')
    
@section('content')
    <nav class="mt-8 px-4 w-full flex items-center justify-between">
        <a href="{{ url('/')}}">
        <img src="{{ asset('assets/icons/back.png') }}" alt="back">
        </a>
        <p class="text-center m-auto font-semibold">Schedule</p>
        <div class="w-12"></div>
    </nav>
    <div class="flex flex-col gap-3 px-4">
        <p class="font-semibold">My Packages</p>
        @forelse (Auth::user()->bookings as $item)
            <a href="{{ route('dashboard.booking_detail', $item->id)}}" class="card">
                <div class="bg-white p-4 rounded-[26px] flex items-center gap-4">
                    <p class="text-center text-sm leading-[22px] tracking-035"><span class="font-semibold text-2xl">{{ \Carbon\Carbon::parse($item->start_date)->format('d')}}</span> <br> {{ \Carbon\Carbon::parse($item->start_date)->format('M')}} <br> {{ \Carbon\Carbon::parse($item->start_date)->format('Y')}}</p>
                    <div class="flex items-center gap-4">
                    <div class="w-[92px] h-[92px] flex shrink-0 rounded-xl overflow-hidden">
                        <img src="{{ Storage::url($item->tour->thumbnail) }}" class="w-full h-full object-cover object-center" alt="thumbnail">
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="font-semibold text-sm tracking-035 leading-[22px]">{{ $item->tour->name }}</p>
                        <p class="text-sm leading-[22px] tracking-035 text-darkGrey">{{ $item->tour->days}} days | {{$item->quantity}} packs</p>
                        @if ($item->is_paid == 1)
                            <div class="success-badge w-fit border border-[#60A5FA] p-[4px_8px] rounded-lg bg-[#EFF6FF] flex items-center justify-center">
                                <span class="text-xs leading-[22px] tracking-035 text-[#2563EB]">Success Paid</span>
                            </div>
                        @else
                            <div class="success-badge w-fit border border-yellow-800 p-[4px_8px] rounded-lg bg-yellow-300 flex items-center justify-center">
                                <span class="text-xs leading-[22px] tracking-035 text-yellow-800">Waiting Confirm</span>
                            </div>

                        @endif
                    </div>
                    </div>
                </div>
            </a>
        @empty
            <p class="text-center text-white bg-red-500 rounded-full py-4 font-bold">Sorry, you don't have any booking schedule now !</p>
        @endforelse
        {{-- <a href="trip-details.html" class="card">
            <div class="bg-white p-4 rounded-[26px] flex items-center gap-4">
                <p class="text-center text-sm leading-[22px] tracking-035"><span class="font-semibold text-2xl">3</span> <br> Mar <br> 2024</p>
                <div class="flex items-center gap-4">
                <div class="w-[92px] h-[92px] flex shrink-0 rounded-xl overflow-hidden">
                    <img src="{{ ('assets/thumbnails/santorini.jpg') }}" class="w-full h-full object-cover object-center" alt="thumbnail">
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-semibold text-sm tracking-035 leading-[22px]">Santorini Island Aegean Sea</p>
                    <p class="text-sm leading-[22px] tracking-035 text-darkGrey">4 days | 2 packs</p>
                </div>
                </div>
            </div>
        </a>
        <a href="trip-details.html" class="card">
            <div class="bg-white p-4 rounded-[26px] flex items-center gap-4">
                <p class="text-center text-sm leading-[22px] tracking-035"><span class="font-semibold text-2xl">15</span> <br> Feb <br> 2024</p>
                <div class="flex items-center gap-4">
                <div class="w-[92px] h-[92px] flex shrink-0 rounded-xl overflow-hidden">
                    <img src="{{ ('assets/thumbnails/universal.jpg') }}" class="w-full h-full object-cover object-center" alt="thumbnail">
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-semibold text-sm tracking-035 leading-[22px]">Universal Studio Singapore</p>
                    <p class="text-sm leading-[22px] tracking-035 text-darkGrey">2 days | 2 packs</p>
                </div>
                </div>
            </div>
        </a>
        <a href="trip-details.html" class="card">
            <div class="bg-white p-4 rounded-[26px] flex items-center gap-4">
                <p class="text-center text-sm leading-[22px] tracking-035"><span class="font-semibold text-2xl">1</span> <br> Jan <br> 2024</p>
                <div class="flex items-center gap-4">
                <div class="w-[92px] h-[92px] flex shrink-0 rounded-xl overflow-hidden">
                    <img src="{{ ('assets/thumbnails/cappadocia.jpg') }}" class="w-full h-full object-cover object-center" alt="thumbnail">
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-semibold text-sm tracking-035 leading-[22px]">Cappadocia Mountain</p>
                    <p class="text-sm leading-[22px] tracking-035 text-darkGrey">7 days | 2 packs</p>
                </div>
                </div>
            </div>
        </a> --}}
    </div>
@endsection