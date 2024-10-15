<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl dark:text-gray-200 text-gray-800 leading-tight">
                {{ __('Details Tours') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">


                <div class="item-card flex flex-row justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($packageTour->thumbnail)}}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 dark:text-white text-xl font-bold">{{ $packageTour->name }}</h3>
                        <p class="text-slate-300 text-sm">{{ $packageTour->category->name }}</p>
                        </div>
                    </div> 
                    <div  class="hidden md:flex flex-col">
                        <p class="text-slate-300 text-sm">Price</p>
                        <h3 class="text-indigo-950 text-xl dark:text-white font-bold">Rp {{ number_format($packageTour->price,0,', ','.')}}</h3>
                    </div>
                    <div  class="hidden md:flex flex-col">
                        <p class="text-slate-300 text-sm">Total Days</p>
                        <h3 class="text-indigo-950 text-xl dark:text-white font-bold"> {{ number_format($packageTour->days)}} Days</h3>
                    </div>
                    <div class="hidden md:flex flex-row items-center gap-x-3">
                        <a href="{{ route('admin.package_tours.edit', $packageTour->id)}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('admin.package_tours.destroy', $packageTour->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="my-5">
                <h3 class="text-indigo-950 text-xl font-bold">Gallery Photos</h3>

                <div class="flex flex-row gap-x-5">
                    @forelse ($latestPhotos as $item)
                        <img src="{{ Storage::url($item->photo)}}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                    @empty
                        <p class="text-center text-white bg-red-500 rounded-full py-4 font-bold">Sorry, the Package Tours photo not available</p>
                    @endforelse


                </div>

                <div>
                    <h3 class="text-indigo-950 text-xl dark:text-white font-bold">About</h3>
                <p class="dark:text-slate-200">
                    {{ $packageTour->about }}
                </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
