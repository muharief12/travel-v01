<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Details Booking') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                <div class="item-card flex flex-row justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($packageBooking->tour->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-white text-xl font-bold">{{ $packageBooking->tour->name }}</h3>
                        <p class="text-slate-300 text-sm">{{ $packageBooking->tour->category->name }}</p>
                        </div>
                    </div> 
                    @if ($packageBooking->is_paid == 1)
                        <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-green-500 text-white">
                            SUCCESS
                        </span>
                    @else
                        <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-orange-500 text-white">
                            PENDING
                        </span> 
                    @endif
                    @if (!$packageBooking->is_paid)
                        <form action="{{ route('admin.package_bookings.update', $packageBooking->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                                Approve Transaction
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.package_bookings.update', $packageBooking->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="font-bold py-4 px-6 bg-red-500 text-white rounded-full">
                                Reject Transaction
                            </button>
                        </form>
                    @endif
                </div>

                <hr class="my-5">

                <div class="grid grid-cols-2 gap-5">
                    <div class="flex flex-col gap-y-4">
                        <div class="flex flex-col">
                            <p class="text-slate-300 text-sm">Name</p>
                            <h3 class="text-white text-xl font-bold">
                                {{ $packageBooking->user->name }}
                            </h3>
                        </div>
        
                        <div class="flex flex-col">
                            <p class="text-slate-300 text-sm">Email</p>
                            <h3 class="text-white text-xl font-bold">
                               {{ $packageBooking->user->email}}
                            </h3>
                        </div>
        
                        <div class="flex flex-col">
                            <p class="text-slate-500 text-sm">Phone</p>
                            <h3 class="text-white text-xl font-bold">
                                {{ $packageBooking->user->phone_number }}
                            </h3>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-4">
                        <div class="flex flex-col">
                            <p class="text-slate-300 text-sm">Quantity</p>
                            <h3 class="text-white text-xl font-bold">
                                {{ $packageBooking->quantity }} people
                            </h3>
                        </div>
        
                        <div class="flex flex-col">
                            <p class="text-slate-300 text-sm">Total Days</p>
                            <h3 class="text-white text-xl font-bold">
                                {{ $packageBooking->tour->days }} days
                            </h3>
                        </div>
        
                        <div class="flex flex-col">
                            <p class="text-slate-300 text-sm">Date</p>
                            <h3 class="text-white text-xl font-bold">
                                {{ \Carbon\Carbon::parse($packageBooking->start_date0)->format('d M Y') }} - {{ \Carbon\Carbon::parse($packageBooking->end_date)->format('d M Y') }}
                            </h3>
                        </div>

                    </div>
                </div>

                <hr class="my-5">

                <div class="grid grid-cols-2 gap-5">
                    <div class="flex flex-col gap-y-4">
                        <div class="flex flex-col">
                            <p class="text-slate-300 text-sm">Sub Total</p>
                            <h3 class="text-white text-xl font-bold">
                                Rp {{ number_format($packageBooking->sub_total, 0, ',','.')}}
                            </h3>
                        </div>
        
                        <div class="flex flex-col">
                            <p class="text-slate-300 text-sm">Insurance</p>
                            <h3 class="text-white text-xl font-bold">
                                Rp {{ number_format($packageBooking->insurance, 0, ',','.')}}
                            </h3>
                        </div>
        
                        <div class="flex flex-col">
                            <p class="text-slate-300 text-sm">Tax</p>
                            <h3 class="text-white text-xl font-bold">
                                Rp {{ number_format($packageBooking->tax, 0, ',','.')}}
                            </h3>
                        </div>

                        <div class="flex flex-col">
                            <p class="text-slate-300 text-sm">Total Amount</p>
                            <h3 class="text-white text-xl font-bold">
                                Rp {{ number_format($packageBooking->total_amount, 0, ',','.')}}
                            </h3>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-4">
                        <h3 class="text-white text-xl font-bold">
                            Bukti Pembayaran
                        </h3>
        
                        <img src="{{ Storage::url($packageBooking->proof) }}" alt="" class="rounded-2xl object-cover w-[300px] h-[200px]">
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
