<?php

namespace Abolaradev\Visitor\Services;

use Galahad\TimezoneMapper\Facades\TimezoneMapper;

class VisitorTimezone 
{
    /**
     * Get the visitor's timezone based on geographic coordinates.
     *
     * @param float|null $latitude The visitor's latitude.
     * @param float|null $longitude The visitor's longitude.
     * @return string|null The timezone identifier (e.g. Asia/Tehran), or null if coordinates are unavailable.
     */
    public static function byCoordinates(?float $latitude, ?float $longitude): ?string
    {
        if (is_null($latitude) || is_null($longitude)) {
            return null;
        }

        return TimezoneMapper::mapCoordinates(
            latitude: $latitude,
            longitude: $longitude,
            fallback: 'UTC'
        );
    }
}