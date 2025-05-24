<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index() {
        return view('admin.car_view');
    }

    public function getCar() {
        $car = Car::get();
        return response()->json($car);
    }

    public function storeCarApi(Request $request) {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cars', 'public');
            $imageUrl = 'storage/' . $path;
        } else {
            $imageUrl = null;
        }

        $car = Car::create([
            'name' => $request->name,
            'admin_id' => $request->admin_id,
            'transmission' => $request->transmission,
            'cost' => $request->cost,
            'seat' => $request->seat,
            'status' => $request->status == 'true' ? 1 : 0,
            'image' => $imageUrl,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $car,
        ]);
    }

    public function updateCarApi(Request $request) {
        $request->validate([
            'id' => 'required|exists:cars,id',
            'name' => 'required',
            'transmission' => 'required',
            'cost' => 'required|numeric',
            'seat' => 'required|numeric',
            // image is optional
        ]);

        try {
            $car = Car::findOrFail($request->id);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('cars', 'public');
                $imageUrl = 'storage/' . $path;

                if ($car->image && file_exists(public_path($car->image))) {
                    unlink(public_path($car->image));
                }

                $car->image = $imageUrl;
            }

            $car->update([
                'name' => $request->name,
                'admin_id' => $request->admin_id,
                'transmission' => $request->transmission,
                'cost' => $request->cost,
                'seat' => $request->seat,
                'status' => $request->status == 'true' ? 1 : 0,
                'image' => $car->image,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Car updated successfully',
                'data' => $car
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteCarApi(Request $request) {
        $request->validate([
            'id' => 'required',
        ]);

        $car = Car::find($request->id);

        if (!$car) {
            return response()->json([
                'status' => 'failed',
                'message' => "The specified car doesn't exists!"
            ], 404);
        }

        if ($car->image && file_exists(public_path($car->image))) {
            unlink(public_path($car->image));
        }

        $car->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Car deleted successfully'
        ]);
    }

    public function user() {
        return view('cars_view_user');
    }

    public function addCar(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cars', 'public');
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
            'image' => $imageUrl,
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
