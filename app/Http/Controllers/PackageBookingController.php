<?php

namespace App\Http\Controllers;

use App\Models\PackageBooking;
use App\Http\Requests\UpdatePackageBookingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packageBookings = PackageBooking::with(['user','tour'])->orderByDesc('id')->paginate(10);
        return view('admin.package_bookings.index', compact('packageBookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageBooking $packageBooking)
    {
        return view('admin.package_bookings.show', compact('packageBooking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageBooking $packageBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageBooking $packageBooking)
    {
        DB::transaction(function () use ($packageBooking) {
            if ($packageBooking->is_paid == 0) {
                $packageBooking->update([
                    'is_paid' => true,
                ]);
            } else {
                $packageBooking->update([
                    'is_paid' => false,
                ]);
            }
        });

        return redirect()->route('admin.package_bookings.show', $packageBooking->id)->with('success', 'Payment Status hasbeen updated successful.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageBooking $packageBooking)
    {
        //
    }
}
