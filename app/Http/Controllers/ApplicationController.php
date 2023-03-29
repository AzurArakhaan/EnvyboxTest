<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    public function saveApplication(Request $request)
    {
        $customMessages = [
            'name.required' => 'Поле "Имя" должно быть заполнено.',
            'name.max' => 'Имя не может быть больше 30 символов',
            'phone.required' => 'Поле "Телефон" должно быть заполнено.',
            'phone.min' => 'Телефон не может быть меньше 6 символов.',
            'message.required' => 'Поле "Сообщение" должно быть заполнено.',
            'message.min' => 'Сообщение не может быть меньше 10 символов'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'phone' => 'required|string|min:6',
            'message' => 'required|string|min:10'
        ], $customMessages);

        if ($validator->fails()) {
            return response([
                'status' => 'error',
                'message' => $validator->getMessageBag()
            ], 400);
        }

        $data = [
            'name' => htmlentities(trim($request->post('name'))),
            'phone' => htmlentities(trim($request->post('phone'))),
            'message' => htmlentities(trim($request->post('message')))
        ];

        try {
            Application::saveToFile($data);
        } catch (\Exception $e) {
            return response([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'status' => 'ok',
            'status_code' => 200,
            'message' => 'ok'
        ]);
    }
}
