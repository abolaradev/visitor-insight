<?php

namespace Abolaradev\Visitor\Services;

use Abolaradev\Visitor\Collections\LocationCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class VisitorLocation
{
    /**
     * Retrieve location information using reverse geocoding, utilizing cached data when available.
     *
     * @param float|null $latitude The visitor's geographic latitude.
     * @param float|null $longitude The visitor's geographic longitude.
     * @return LocationCollection|null The visitor's location information, or null if coordinates are unavailable.
     */
    public static function reverseGeoCoding(?float $latitude, ?float $longitude): ?LocationCollection
    {
        if (is_null($latitude) || is_null($longitude)) {
            return null;
        }

        $cache_key = self::generateCacheKey($latitude, $longitude);

        return Cache::remember($cache_key, now()->addWeek(), function () use ($latitude, $longitude) {

            $openstreetmap_api_url = "https://nominatim.openstreetmap.org/reverse";

            $data = [
                'lat' => $latitude,
                'lon' => $longitude,
                'zoom' => 18,
                'format' => 'jsonv2',
                'addressdetails' => 1
            ];

            $response = Http::acceptJson()
                            ->withUserAgent('VisitorInsight/1.0 (laravel@gmail.com)')
                            ->get($openstreetmap_api_url, $data)
                            ->throw()
                            ->collect();

            return self::getLocationData($response);
        });
    }

    /**
     * Extract the relevant location fields from the API response.
     *
     * @param Collection $collection The API response data.
     * @return LocationCollection The extracted location information.
     */
    private static function getLocationData(Collection $collection): LocationCollection
    {
        $location_data = $collection->only([
            'place_id',
            'lat',
            'lon',
            'display_name',
            'address'
        ]);

        return LocationCollection::make($location_data);
    }

    /**
     * Generate a cache key based on the visitor's geographic coordinates.
     *
     * @param float $latitude The visitor's geographic latitude.
     * @param float $longitude The visitor's geographic longitude.
     * @return string The hashed cache key generated from coordinates rounded to four decimal places.
     */
    private static function generateCacheKey(float $latitude, float $longitude): string
    {
        $coordinates = sprintf(
            '[%s,%s]',
            number_format($latitude, 4, '.', ''),
            number_format($longitude, 4, '.', '')
        );

        return 'visitor-location:' . $coordinates;
    }
}