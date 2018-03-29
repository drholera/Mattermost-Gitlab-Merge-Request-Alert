<?php

namespace MGBot\Gitlab;

use GuzzleHttp\Client;
use MGBot\Config\Config;

class MergeChecker {

  const OPENED_MERGE_REQUESTS = '/merge_requests?state=opened';

  public function runCheck() {
    $mergeRequestsCount = $this->getMergeRequestsCount();
    if ( $mergeRequestsCount > 5 ) {
      $this->displayMessage( $mergeRequestsCount );
    }
  }

  public function getMergeRequestsCount() {
    $url      = $this->getGitlabFullUrl();
    $guzzle   = new Client();
    $response = $guzzle->request( 'GET', $url )->getBody()->getContents();
    $count = 0;
    if ( ! empty( $response ) ) {
    	foreach(json_decode( $response ) as $merge_request) {
    		if ($merge_request->work_in_progress == false) {
    			$count++;
    		}
    	}
    }
      return $count;	
      return count( json_decode( $response ) );

    die('Empty GitLab response');
  }

  public function displayMessage( $mergeRequestsCount ) {
    $matterMostConfig = Config::getMattermostConfig();
    $guzzle           = new Client();

    // Possibility to run it on several channels.
    foreach($matterMostConfig['token'] as $webHook) {
      $guzzle->request( 'POST', $matterMostConfig['server'] . '/hooks/' . $webHook, [
        'headers' => [
          'Content-Type' => 'application/json',
        ],
        'json'    => [
          "username" => $matterMostConfig['username'],
          "icon_url" => $matterMostConfig['icon_url'],
          "text"     => "Guys! We have too many MRs. $mergeRequestsCount for now! Check it when you'll have time. Big brother is watching you!",
        ],
      ] );
    }
  }

  protected function getGitlabFullUrl() {
    $params = getopt('', ['project_id:']);
    if (empty($params['project_id'])) {
      die('Project ID should be specified as --project_id param');
    }
    $config = Config::getGitlabConfig();

    return $config['gitlab_url'] . '/api/' .
           $config['api_version'] . '/projects/' .
           $params['project_id'] . static::OPENED_MERGE_REQUESTS .
           '&private_token=' . $config['private_token'];
  }

}