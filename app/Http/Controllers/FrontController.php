<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageBookingCheckoutRequest;
use App\Http\Requests\StorePackageBookingRequest;
use App\Http\Requests\UpdatePackageBookingRequest;
use App\Models\Category;
use App\Models\PackageBank;
use App\Models\PackageBooking;
use App\Models\PackageTour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index() {
        $categories = Category::all();
        $tours = PackageTour::take(3)->get();
        return view('front.index', compact('categories','tours'));
    }

    public function detail(PackageTour $packageTour) {
        return view('front.detail', compact('packageTour'));
    }
    
    public function booking(PackageTour $packageTour) {
        $bookingCheck = Auth::user()->bookings()->where('package_tour_id', $packageTour->id)->where('is_paid', 0)->first();
        
        return view('front.booking', compact('packageTour','bookingCheck'));
    }

    public function booking_store(StorePackageBookingRequest $request, PackageTour $packageTour) {
        $user = Auth::user();
        $bank = PackageBank::orderByDesc('id')->first();
        $packageBookingId = Null;

        DB::transaction(function() use ($request, $user, $bank, &$packageBookingId, $packageTour) {
            $validated = $request->validated();
            $startDate = new Carbon($validated['start_date']);
            $totalDays = $packageTour->days - 1;
            $endDate = $startDate->addDays($totalDays);

            $sub_total = $packageTour->price * $validated['quantity'];
            $insurance = 300000 * $validated['quantity'];
            $tax = $sub_total * 0.10;

            $validated['package_tour_id'] = $packageTour->id;
            $validated['user_id'] = $user->id;
            $validated['package_bank_id'] = $bank->id;
            $validated['start_date'] = $startDate;
            $validated['end_date'] = $endDate;
            $validated['sub_total'] = $sub_total;
            $validated['insurance'] = $insurance;
            $validated['tax'] = $tax;
            $validated['total_amount'] = $sub_total + $insurance + $tax;
            $validated['proof'] = 'waitingtrx.png';
            $validated['is_paid'] = false;

            $packageBooking = PackageBooking::create($validated);
            $packageBookingId = $packageBooking->id;
        });

        if ($packageBookingId) {
            return redirect()->route('front.choose_bank', $packageBookingId);
        } else {
            return back()->withErrors('Sorry, Failed to create a new booking tour!');
        }
    }

    public function choose_bank(PackageBooking $packageBooking) {
        $user = Auth::user();

        if ($packageBooking->user_id != $user->id) {
            abort(403);
        }

        $banks = PackageBank::all();

        return view('front.choose_bank', compact('packageBooking','banks'));
    }

    public function choose_bank_store(UpdatePackageBookingRequest $request, PackageBooking $packageBooking) {
        $user = Auth::user();

        if ($packageBooking->user_id != $user->id) {
            abort(403);
        }

        DB::transaction(function() use ($request, $packageBooking) {
            $validated = $request->validated() ;
            $packageBooking->update([
                'package_bank_id' => $validated['package_bank_id'],
            ]);            
        });

        return redirect()->route('front.booking_payment', $packageBooking->id);
    }

    public function booking_payment(PackageBooking $packageBooking) {
        return view('front.booking_payment', compact('packageBooking'));
    }

    public function booking_payment_store(StorePackageBookingCheckoutRequest $request, PackageBooking $packageBooking) {
        $user = Auth::user();
        if ($packageBooking->user_id != $user->id) {
            abort(403);
        }

        DB::transaction(function() use ($request, $packageBooking) {
            $validated = $request->validated();
            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $packageBooking->update($validated);
        });

        return redirect()->route('front.booking_finish');
    }

    public function booking_finish() {
        return view('front.booking_finish');
    }

    public function my_bookings(PackageBooking $packageBooking) {
        return view('dashboard.my_bookings', compact('packageBooking'));
    }

    public function booking_detail(PackageBooking $packageBooking) {
        return view('dashboard.booking_detail', compact('packageBooking'));
    }

}
