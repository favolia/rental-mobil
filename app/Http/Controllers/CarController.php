<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index() {
        $cars = Car::latest()->get();
        return view('admin.car_view', compact('cars'));
    }

    public function user() {
        $cars = Car::latest()->get();
        return view('cars_view_user', compact('cars'));
    }

    public function addCar(Request $request)
    {
        if ($request->hasFile('image')) {
            // Simpan file ke storage/app/public/cars
            $path = $request->file('image')->store('cars', 'public');
            // Simpan hanya path relatif seperti 'cars/nama-file.jpg'
            $imageUrl = 'storage/' . $path;
        } else {
            $imageUrl = null;
        }

        $car = Car::create([
            'name' => $request->name,
            'admin_id' => Auth::user()->id,
            'transmission' => $request->transmission,
            'cost' => $request->cost,
            'seat' => $request->seat,
            'status' => $request->has('status') ? 1 : 0,
            'image' => $imageUrl, // simpan path lengkap ke public
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $car,
        ]);
    }


    public function editCar($id) {
        $car = Car::findOrFail($id);
        return response()->json($car);
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        // Hapus file image jika ada
        if (file_exists($car->image)) {
            unlink($car->image);
        }

        $car->delete();

        return redirect()->back()->with('success', 'Mobil berhasil dihapus.');
    }

    public function updateCar(Request $request) {
        $carId = $request->id;
        $car = Car::findOrFail($carId);

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('cars', 'public');
            $imageUrl = 'storage/' . $path;
            if(file_exists($car->image)) {
                unlink($car->image);
            }
            $save_url = $imageUrl;

            $car->update([
                'name' => $request->name,
                'admin_id' => Auth::user()->id,
                'transmission' => $request->transmission,
                'cost' => $request->cost,
                'seat' => $request->seat,
                'status' => $request->has('status') ? 1 : 0,
                'image' => $save_url
            ]);
        } else {
            $car->update([
                'name' => $request->name,
                'admin_id' => Auth::user()->id,
                'transmission' => $request->transmission,
                'cost' => $request->cost,
                'seat' => $request->seat,
                'status' => $request->has('status') ? 1 : 0,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $car
        ]);
    }

}
