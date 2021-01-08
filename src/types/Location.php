<?php

namespace leealex\telegram\types;

/**
 * This object represents a point on the map.
 *
 * @see https://core.telegram.org/bots/api#location
 * @package leealex\telegram\types
 */
class Location extends BaseType
{
    /**
     * Longitude as defined by sender
     * @var float
     */
    public $longitude;
    /**
     * Latitude as defined by sender
     * @var float
     */
    public $latitude;
    /**
     * Optional. The radius of uncertainty for the location, measured in meters; 0-1500
     * @var float
     */
    public $horizontal_accuracy;
    /**
     * Optional. Time relative to the message sending date, during which the location can be updated, in seconds.
     * For active live locations only.
     * @var integer
     */
    public $live_period;
    /**
     * Optional. The direction in which user is moving, in degrees; 1-360.
     * For active live locations only.
     * @var integer
     */
    public $heading;
    /**
     * Optional. Maximum distance for proximity alerts about approaching another chat member, in meters.
     * For sent live locations only.
     * @var integer
     */
    public $proximity_alert_radius;
}
