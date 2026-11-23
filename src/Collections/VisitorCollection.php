<?php

namespace Abolaradev\Visitor\Collections;

use Illuminate\Support\Collection;

class VisitorCollection extends Collection
{
    /**
     * Get the authenticated user.
     */
    public function getAuthUser(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return $this->get('user');
    }

    /**
     * Get the visitor's IP address.
     */
    public function getIp(): ?string
    {
        return $this->get('ip');
    }

    /**
     * Get the visitor's client information.
     */
    public function getClient(): ?ClientCollection
    {
        return $this->get('client');
    }

    /**
     * Get the visitor's geographical location.
     */
    public function getLocation(): ?LocationCollection
    {
        return $this->get('location');
    }

    /**
     * Get the visitor's timezone.
     */
    public function getTimezone(): ?string
    {
        return $this->get('timezone');
    }
}