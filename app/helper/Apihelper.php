<?php
namespace App\helper;
class Apihelper {
    static function sendrespone($code=200,$message="",$data=null){
        $response = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($response,$code);
    }


}
