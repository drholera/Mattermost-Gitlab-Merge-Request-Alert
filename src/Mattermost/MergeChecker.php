<?php 

namespace MGBot\Mattermost;

use MGBot\Config\Config;

class MergeChecker {

	const OPENED_MERGE_REQUESTS = '/merge_requests?state=opened';

	public function getMergeRequestsCount() {
    return $this->getGitlabFullUrl();
	}


	protected function getGitlabFullUrl() {
		$config = Config::getGitlabConfig();

		return $config['gitlab_url'] . '/api/' . $config['api_version'] . '/projects/' . $config['project_id'] . static::OPENED_MERGE_REQUESTS;
	}

}