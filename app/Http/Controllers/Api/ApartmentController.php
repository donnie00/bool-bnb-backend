<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::paginate(20);

        return response()->json($apartments);
    }

    public function create(){
        return redirect()->to(config("frontEnd.url"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated(
            [
                'user_id' => 'required|exists:user,id',
                'title' => 'required|string',
                'address' => 'required|string',
                'latitude' => 'required',
                'longitude' => 'required',
                'cover_img' => 'file|image',
                'description' => 'string|size:1000',
                'rooms_qty' => 'required|integer',
                'beds_qty' => 'required|integer',
                'bathrooms_qty' => 'required|integer',
                'mq' => 'integer',
                'daily_price' => 'required|decimal:2',
                'visible' => 'nullable|boolean',
            ]
        );

        if (key_exists('cover_img', $data)) {
            $path = Storage::put('apartment-img', $data['cover_img']);
        }

        $apartment = Apartment::create(
            [
                ...$data,
                'cover_img' => $path ?? null,
            ]
        );

        return redirect()->to(config("frontEnd.url"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
