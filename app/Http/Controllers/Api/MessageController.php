<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Apartment $apartment)
    {

        $data = $request->validate(
            [
                'apartment_id' => 'required|exists:apartments,id',
                'sender' => 'required|string',
                'email' => 'required|email',
                'subject' => 'required|string',
                'message' => 'required|string',
            ]
        );

        $message = Message::create($data);

        return response()->json($message);
    }
}
