<?php

/**
 * SOM Metric class.
 *
 * All conversions are limited to 2 decimal places.
 */
class WPStrava_SOMMetric extends WPStrava_SOM {

	/**
	 * Change meters to kilometers.
	 *
	 * @param float $m Distance in meters.
	 * @return float Distance in kilometers.
	 */
	public function distance( $m ) {
		return number_format( $m / 1000, 2 );
	}

	/**
	 * Change kilometers to meters.
	 *
	 * @param float $dist Distance in kilometers.
	 * @return float Distance in meters.
	 */
	public function distance_inverse( $dist ) {
		return $dist * 1000;
	}

	/**
	 * Abbreviated label for this system of measure's distance - Kilometers: km
	 *
	 * @return string 'km'
	 */
	public function get_distance_label() {
		return __( 'km', 'wp-strava' );
	}

	/**
	 * Change meters per second to kilometers per hour.
	 *
	 * @param float $mps Meters per second.
	 * @return float Kilometers per hour.
	 */
	public function speed( $mps ) {
		return number_format( $mps * 3.6, 2 );
	}

	/**
	 * Abbreviated label for this system of measure's speed - Kilometers Per Hour: km/h
	 *
	 * @return string 'km/h'
	 */
	public function get_speed_label() {
		return __( 'km/h', 'wp-strava' );
	}

    /**
     * Change meters per second to kilometers per hour.
     *
     * @param float $mps Meters per second.
     * @return float Kilometers per hour.
     */
    public function pace( $mps ) {
        // 4 m/s => 14,4 km/h => 4:10 min/km

        $kmh = $mps * 3.6;
        $s = 3600 / $kmh;
        $ss = $s/60;
        $ms = floor($ss)*60;
        $sec = round($s-$ms);
        $min = floor($ss);

        return "$min:$sec";
    }

    /**
     * Abbreviated label for this system of measure's speed - Minutes Per Kilometers: min/km
     *
     * @return string 'min/km'
     */
    public function get_pace_label() {
        return __( 'min/km', 'wp-strava' );
    }

    /**
     * Change meters per second to Minutes Per 100 Meters.
     *
     * @param float $mps Meters per second.
     * @return float Minutes Per 100 Meters.
     */
    public function swimpace( $mps ) {

        $kmh = $mps * 3.6;
        $min100m = 60/$kmh/10;

        return number_format( $min100m, 2 );
    }

    /**
     * Abbreviated label for this system of measure's pace - Minutes Per 100 Meters: min/100m
     *
     * @return string 'min/100m'
     */
    public function get_swimpace_label() {
        return __( 'min/100m', 'wp-strava' );
    }

	/**
	 * Change meters to meters };^)
	 *
	 * @param $m Elevation in meters.
	 * @return string Elevation in meters.
	 */
	public function elevation( $m ) {
		return number_format( $m, 2 );
	}

	/**
	 * Abbreviated label for this system of measure's elevation - Meters: meters
	 *
	 * @return string 'meters'
	 */
	public function get_elevation_label() {
		return __( 'meters', 'wp-strava' );
	}
}
