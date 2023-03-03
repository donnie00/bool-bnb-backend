<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

//Da gestire l'autenticazione

class ApartmentController extends Controller
{
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
                'description' => 'string|max:1000',
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $apartment = Apartment::findOrFail($id);

        return response()->json($apartment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = $request->validate(
            [
                'user_id' => 'exists:user,id',
                'title' => 'string',
                'address' => 'string',
                'latitude' => '',
                'longitude' => '',
                'cover_img' => 'file|image',
                'description' => 'string|size:1000',
                'rooms_qty' => 'integer',
                'beds_qty' => 'integer',
                'bathrooms_qty' => 'integer',
                'mq' => 'integer',
                'daily_price' => 'decimal:2',
                'visible' => 'nullable|boolean',
            ]
        );

        $apartment = Apartment::findOrFail($id);

        $apartment->update($data);

        return response()->json($apartment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $apartment = Apartment::findOrFail($id);

        $apartment->delete();
    }
}
