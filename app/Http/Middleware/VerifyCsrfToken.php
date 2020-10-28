<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/hire',
        '/paymnet/pricing',
        '/verification/pay/success',
        '/verification/pay/fail',
        '/milestone/pay/fail',
        '/milestone/pay/success',
        '/message/appointment/success',
    ];
}
