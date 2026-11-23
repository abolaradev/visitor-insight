<?php

namespace Abolaradev\Visitor\Collections;

use Illuminate\Support\Collection;

class ClientCollection extends Collection
{
    /**
     * Get the client's User-Agent string.
     */
    public function getUserAgent(): ?string
    {
        return $this->get('user_agent');
    }

    /**
     * Get the client's device information.
     */
    public function getDevice(): ?DeviceCollection
    {
        return $this->get('device');
    }

    /**
     * Get the client's operating system and platform.
     */
    public function getPlatform(): ?string
    {
        return $this->get('platform');
    }

    /**
     * Get the client's browser information.
     */
    public function getBrowser(): ?string
    {
        return $this->get('browser');
    }
}