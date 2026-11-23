<?php

namespace Abolaradev\Visitor\Services;

use Abolaradev\Visitor\Collections\LocationCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class VisitorLocation
{
    /**
     * Retrieve location information using reverse geocoding.
     *
     * @param float|null $latitude The geographic latitude.
     * @param float|null $longitude The geographic longitude.
     * @return LocationCollection|null The visitor's location information, or null if coordinates are unavailable.
     */
    public static function reverseGeoCoding(?float $latitude, ?float $longitude): ?LocationCollection
    {
        if (is_null($latitude) || is_null($longitude)) {
            return null;
        }

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
}