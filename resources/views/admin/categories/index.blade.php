<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl dark:text-gray-200">
                {{ __('Manage Categories') }}
            </h2>
            <a href="{{ route('admin.categories.create')}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

             
                @forelse ($categories as $category)
                    <div class="item-card flex flex-row justify-between items-center">
                        <div class="flex flex-row items-center md:w-[150px] gap-x-3">
                            <img src="{{ Storage::url($category->icon)}}" alt="{{ $category->name}} Icon" class="rounded-2xl object-cover w-[60px] h-[60px]">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 dark:text-white text-xl font-bold">{{ $category->name }}</h3>
                            </div>
                        </div> 
                        <div  class="hidden md:flex flex-col">
                            <p class="text-slate-300 text-sm">Date</p>
                            <h3 class="text-indigo-950 dark:text-white text-xl font-bold">{{ $category->created_at->format('d F Y')}}</h3>
                        </div>
                        <div class="hidden md:flex flex-row items-center gap-x-3">
                            <a href="{{ route('admin.categories.edit', $category->id)}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                                Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-white bg-red-500 rounded-full py-4 font-bold">Sorry, the category data not available</p>
                @endforelse
                

            </div>
        </div>
    </div>
</x-app-layout>
