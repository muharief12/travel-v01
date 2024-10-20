<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageTourRequest;
use App\Http\Requests\UpdatePackagaeTourRequest;
use App\Models\Category;
use App\Models\PackageTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class PackageTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packageTours = PackageTour::orderByDesc('id')->paginate(10);
        return view('admin.package_tours.index', compact('packageTours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderByDesc('id')->get();
        return view('admin.package_tours.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageTourRequest $request)
    {
        DB::transaction(function() use ($request) {
           $validated = $request->validated();
           if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails/'.date('Y/m/d'),'public');
                $validated['thumbnail'] = $thumbnailPath;
           }
           $validated['slug'] = Str::slug($validated['name']);
           $packageTour = PackageTour::create($validated);

           if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $photoPath = $photo->store('package_photos/'.date('Y/m/d'),'public');
                    $packageTour->photos()->create([
                        'photo' => $photoPath,
                    ]);
                }
           }
        });

        return redirect()->route('admin.package_tours.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageTour $packageTour)
    {
        $latestPhotos = $packageTour->photos()->orderByDesc('id')->take(3)->get();
        return view('admin.package_tours.show', compact('packageTour','latestPhotos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageTour $packageTour)
    {
        $categories = Category::orderByDesc('id')->get();
        $latestPhotos = $packageTour->photos()->orderByDesc('id')->take(3)->get();
        return view('admin.package_tours.edit', compact('packageTour','latestPhotos','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackagaeTourRequest $request, PackageTour $packageTour)
    {
        DB::transaction(function() use ($request, $packageTour) {
           $validated = $request->validated();
           if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails/'.date('Y/m/d'),'public');
                $validated['thumbnail'] = $thumbnailPath;
           }
           $validated['slug'] = Str::slug($validated['name']);
           $packageTour->update($validated);

           if ($request->hasFile('photos')) {
                // Cek apakah ada foto yang sudah ada
                $existingPhotos = $packageTour->photos;

                // Jika ada, hapus foto lama dari storage dan database
                if ($existingPhotos->isNotEmpty()) {
                    foreach ($existingPhotos as $existingPhoto) {
                        // Hapus file dari storage
                        Storage::disk('public')->delete($existingPhoto->photo);
                        
                        // Hapus data foto dari database
                        $existingPhoto->delete();
                    }
                }
                foreach ($request->file('photos') as $photo) {
                    $photoPath = $photo->store('package_photos/'.date('Y/m/d'),'public');
                    $packageTour->photos()->create([
                        'photo' => $photoPath,
                    ]);
                }
           }
        });

        return redirect()->route('admin.package_tours.show', $packageTour->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageTour $packageTour)
    {
        $packageTour->photos()->delete();
        $packageTour->delete();

        return redirect()->route('admin.package_tours.index');
    }
}
