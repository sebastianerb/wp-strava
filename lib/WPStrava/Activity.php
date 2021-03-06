<?php
/*
 * Activity is a class wrapper for the Strava REST API functions.
 */
class WPStrava_Activity {

	const ACTIVITIES_URL = 'http://strava.com/activities/';
	const ATHLETES_URL   = 'http://strava.com/athletes/';

	/**
	 * Get single activity by ID.
	 *
	 * @param string  $athlete_token Token of athlete to retrieve for
	 * @param int     $activity_id ID of activity to retrieve.
	 * @return object stdClass representing this activity.
	 * @author Justin Foell
	 */
	public function get_activity( $athlete_token, $activity_id ) {
		return WPStrava::get_instance()->get_api( $athlete_token )->get( "activities/{$activity_id}" );
	}

	/**
	 * Get activity list from Strava API.
	 *
	 * @author Justin Foell
	 *
	 * @param string   $athlete_token Token of athlete to retrieve for
	 * @param int      $club_id       Club ID of all club riders (optional).
	 * @param int|null $quantity      Number of records to retrieve (optional).
	 * @return array Array of activities.
	 */
	public function get_activities( $athlete_token, $club_id = null, $quantity = null ) {
		$api = WPStrava::get_instance()->get_api( $athlete_token );

		$data = null;

		$args = $quantity ? array( 'per_page' => $quantity ) : null;

		//Get the json results using the constructor specified values.
		if ( is_numeric( $club_id ) ) {
			$data = $api->get( "clubs/{$club_id}/activities", $args );
		} else {
			$data = $api->get( 'athlete/activities', $args );
		}

		if ( is_array( $data ) ) {
			return $data;
		}

		return array();

	}

	/**
	 * Undocumented function
	 *
	 * @param array $activities
	 * @param float $dist Distance in default system of measure (km/mi).
	 * @return void
	 * @author Justin Foell
	 */
	public function get_activities_longer_than( $activities, $dist ) {
		$som    = WPStrava_SOM::get_som();
		$meters = $som->distance_inverse( $dist );

		$long_activities = array();
		foreach ( $activities as $activity_info ) {
			if ( $activity_info->distance > $meters ) {
				$long_activities[] = $activity_info;
			}
		}

		return $long_activities;
	}

}
