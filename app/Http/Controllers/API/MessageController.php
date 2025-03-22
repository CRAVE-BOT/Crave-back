<?php

namespace App\Http\Controllers\API;

use App\helper\Apihelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MessageRequest;
use App\Models\Messages;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(MessageRequest $request)
    {
        $data = $request->validated();
        $insert = Messages::create($data);
        if ($insert) {
            return Apihelper::sendrespone('201', 'Message added successfully', null);
        }
    }

}
