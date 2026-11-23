<?php

namespace Abolaradev\Visitor\Services;

use Illuminate\Support\Facades\Http;

class VisitorIp
{
    /**
     * Retrieve the visitor's IP address.
     *
     * @return string The public IP address in the local environment, or the request IP address in other environments.
     */
    public static function get(): string
    {
        return app()->environment() == 'local'
            ? Http::get('https://api.ipify.org')->throw()->body()
            : request()->ip();
    }
}