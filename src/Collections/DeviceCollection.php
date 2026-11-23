<?php

namespace Abolaradev\Visitor\Collections;

use Illuminate\Support\Collection;

class DeviceCollection extends Collection
{
    /**
     * Get the device type (e.g. desktop, mobile, tablet).
     */
    public function getDeviceType(): ?string
    {
        return $this->get('device_type');
    }

    /**
     * Get the device family.
     */
    public function getDeviceFamily(): ?string
    {
        return $this->get('device_family');
    }

    /**
     * Get the device model.
     */
    public function getDeviceModel(): ?string
    {
        return $this->get('device_model');
    }
}