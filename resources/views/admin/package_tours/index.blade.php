<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl dark:text-gray-200 text-gray-800 leading-tight">
                {{ __('Manage Tours') }}
            </h2>
            <a href="{{ route('admin.package_tours.create')}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">


                @forelse ($packageTours as $item)
                    <div class="item-card flex flex-row justify-between items-center">
                        <div class="flex flex-row items-center md:w-[30%] gap-x-3">
                            <img src="{{ Storage::url($item->thumbnail)}}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 dark:text-white text-xl font-bold">{{ $item->name }}</h3>
                            <p class="text-slate-300 text-sm">{{ $item->category->name }}</p>
                            </div>
                        </div> 
                        <div  class="hidden md:flex flex-col">
                            <p class="text-slate-300 text-sm">Price</p>
                            <h3 class="text-indigo-950 text-xl dark:text-white font-bold">Rp {{ number_format($item->price, 0, ', ', '.') }}</h3>
                        </div>
                        <div  class="hidden md:flex flex-col">
                            <p class="text-slate-300 text-sm">Total Days</p>
                            <h3 class="text-indigo-950 text-xl dark:text-white font-bold">{{ $item->days }} Days</h3>
                        </div>
                        <div class="hidden md:flex flex-row items-center gap-x-3">
                            <a href="{{ route('admin.package_tours.show', $item->id)}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                                Manage
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-white bg-red-500 rounded-full py-4 font-bold">Sorry, the Package Tours data not available</p>
                @endforelse
                

            </div>
        </div>
    </div>
</x-app-layout>
