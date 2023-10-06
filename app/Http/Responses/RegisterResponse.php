<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        return redirect()->route(array_key_exists(
            key: 'register_company',
            array: $request->request->all()
        ) ? 'onboarding.team' : 'messages');
    }
}
