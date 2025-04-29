<?php

namespace App\Fortify\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Http\RedirectResponse;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request): RedirectResponse
    {
        return redirect('/login'); // 🔥 Aquí decides a dónde ir después del registro
    }
}
