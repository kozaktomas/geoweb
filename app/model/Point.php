<?php

namespace Jednoadem\Communications;

use Nette\Object;

class Point extends Object
{

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @param float|null $latitude
     * @param float|null $longitude
     */
    function __construct($latitude = NULL, $longitude = NULL)
    {
        $this->latitude = (float) $latitude;
        $this->longitude = (float) $longitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = (float) $latitude;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = (float) $longitude;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }


}