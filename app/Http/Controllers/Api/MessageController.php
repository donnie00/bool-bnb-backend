<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated(
            [
                'apartment_id' => 'required|exists:apartment,id',
                'sender' => 'required|string',
                'email' => 'required|email',
                'subject' => 'required|string',
                'message' => 'required|text',
            ]
        );

        $message = Message::create($data);
    }
}
