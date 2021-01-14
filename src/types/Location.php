<?php

namespace leealex\telegram\types;

/**
 * This object represents a point on the map.
 *
 * @see https://core.telegram.org/bots/api#location
 * @package leealex\telegram\types
 *
 * @property float $longitude Longitude as defined by sender
 *
 * @property float $latitude Latitude as defined by sender
 *
 * @property float $horizontal_accuracy Optional. The radius of uncertainty for the location, measured in meters; 0-1500
 *
 * @property integer $live_period Optional. Time relative to the message sending date, during which the location can be
 * updated, in seconds. For active live locations only.
 *
 * @property integer $heading Optional. The direction in which user is moving, in degrees; 1-360.
 * For active live locations only.
 *
 * @property integer $proximity_alert_radius Optional. Maximum distance for proximity alerts about approaching another
 * chat member, in meters. For sent live locations only.
 */
class Location extends BaseType
{
}
