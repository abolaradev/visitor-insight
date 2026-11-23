<?php

namespace Abolaradev\Visitor;

use Abolaradev\Visitor\Collections\VisitorCollection;
use Abolaradev\Visitor\Services\VisitorAuth;
use Abolaradev\Visitor\Services\VisitorClient;
use Abolaradev\Visitor\Services\VisitorIp;
use Abolaradev\Visitor\Services\VisitorLocation;
use Abolaradev\Visitor\Services\VisitorTimezone;

class Visitor
{
    /**
     * The visitor's geographic latitude.
     */
    private ?float $latitude = null;

    /**
     * The visitor's geographic longitude.
     */
    private ?float $longitude = null;

    /**
     * Set the visitor's geographic coordinates.
     *
     * @param float $latitude The visitor's geographic latitude.
     * @param float $longitude The visitor's geographic longitude.
     * @return void
     */
    public function location(float $latitude, float $longitude): void
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * Retrieve the visitor's complete profile information.
     *
     * @return VisitorCollection The visitor's profile data, including user, IP, client, location, and timezone information.
     */
    public function profile(): VisitorCollection
    {
        return VisitorCollection::make([
            'user' => VisitorAuth::user(),
            'ip' => VisitorIp::get(),
            'client' => VisitorClient::get(),
            'location' => VisitorLocation::reverseGeoCoding($this->latitude, $this->longitude),
            'timezone' => VisitorTimezone::byCoordinates($this->latitude, $this->longitude)
        ]);
    }
}