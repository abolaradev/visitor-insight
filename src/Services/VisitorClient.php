<?php

namespace Abolaradev\Visitor\Services;

use Abolaradev\Visitor\Collections\ClientCollection;
use Abolaradev\Visitor\Collections\DeviceCollection;
use hisorange\BrowserDetect\Facade as Browser;

class VisitorClient
{
    /**
     * Retrieve the visitor's client information, including device, platform, and browser details.
     *
     * @return ClientCollection The visitor's client information.
     */
    public static function get(): ClientCollection
    {
        return ClientCollection::make([
            // User Agent
            'user_agent' => Browser::userAgent(),

            // Device
            'device' => DeviceCollection::make([
                'device_type' => Browser::deviceType(),
                'device_family' => Browser::deviceFamily(),
                'device_model' => Browser::deviceModel(),
            ]),

            // Platform
            'platform' => Browser::platformFamily(),

            // Browser
            'browser' => Browser::browserFamily(),
        ]);
    }
}