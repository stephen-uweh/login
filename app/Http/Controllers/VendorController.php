<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorResource;
use App\Http\Resources\VendorResourceCollection;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class VendorController extends Controller
{
    public function create(array $data){
        return Vendor::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function show(Vendor $vendor): VendorResource {
        return new VendorResource($vendor);
    }

    public function index(): VendorResourceCollection{
        return new VendorResourceCollection(Vendor::paginate());
    }

    public function store(Request $request){
        $request->validate([
            'first_name' => ['required', 'unique'],
            'last_name' => ['required', 'unique'],
            'username' => ['required', 'unique'],
            'password' =>  'required',
        ]);
        $vendor = $this->create($request->all());
        return new VendorResource($vendor);
    }
    public function update(Vendor $vendor, Request $request): VendorResource{
        $vendor->update($request->all());
        return new VendorResource($vendor);
    }
    public function destroy(Vendor $vendor){
        $vendor->delete();
        return response()->json(["data" => "Record deleted"], 200);
    }
}
