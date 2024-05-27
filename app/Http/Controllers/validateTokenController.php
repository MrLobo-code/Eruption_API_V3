<?php

namespace App\Http\Controllers;

use App\Common\Exceptions\DetailedException;
use App\Common\Responders\ErrorResponder;
use App\Utils\Token;
use Illuminate\Http\Request;

class validateTokenController
{

    public function __invoke(Request $request)
    {
        try {
            $token = $request->header('x-access-token');
            $validateToken = Token::validateToken($token);

            if (!$validateToken) {
                throw new \Exception("Permiso denegado");
            }

            $token_data = Token::getDataToken($token);

            return response()->json($token_data, 200);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $code = $e->getCode();

            return response()->json(compact('message', 'code'), 500);
        }
    }
}
