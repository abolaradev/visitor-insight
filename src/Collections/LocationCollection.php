<?php

namespace Abolaradev\Visitor\Collections;

use Illuminate\Support\Collection;

class LocationCollection extends Collection
{
    /**
     * Get the OpenStreetMap place ID.
     */
    public function getPlaceId(): ?int
    {
        return $this->get('place_id');
    }

    /**
     * Get the location latitude.
     */
    public function getLatitude(): ?string
    {
        return $this->get('lat');
    }

    /**
     * Get the location longitude.
     */
    public function getLongitude(): ?string
    {
        return $this->get('lon');
    }

    /**
     * Get the full formatted address.
     */
    public function getFullAddress(): ?string
    {
        return $this->get('display_name');
    }

    /**
     * Get the street name.
     */
    public function getRoad(): ?string
    {
        return $this->get('road');
    }

    /**
     * Get the suburb or neighborhood name.
     */
    public function getSuburb(): ?string
    {
        return $this->get('suburb');
    }

    /**
     * Get the city name.
     */
    public function getCity(): ?string
    {
        return $this->get('city');
    }

    /**
     * Get the district name.
     */
    public function getDistrict(): ?string
    {
        return $this->get('district');
    }

    /**
     * Get the county name.
     */
    public function getCounty(): ?string
    {
        return $this->get('county');
    }

    /**
     * Get the state or province name.
     */
    public function getState(): ?string
    {
        return $this->get('state');
    }

    /**
     * Get the ISO 3166-2 state code.
     */
    public function getStateCode(): ?string
    {
        return $this->get('ISO3166-2-lvl4');
    }

    /**
     * Get the postal code.
     */
    public function getPostcode(): ?string
    {
        return $this->get('postcode');
    }

    /**
     * Get the country name.
     */
    public function getCountry(): ?string
    {
        return $this->get('country');
    }

    /**
     * Get the ISO 3166-1 alpha-2 country code.
     */
    public function getCountryCode(): ?string
    {
        return $this->get('country_code');
    }
}