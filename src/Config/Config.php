<?php

namespace MGBot\Config;

// Singleton config.
class Config {

	// We don't need instances here.
	private function __construct() {}

    // Update it with your own credentials.
	public static function getMattermostConfig() {
		return [
			'username' => 'MGBot', // username display on chat
		    'icon_url' => 'https://example.xyz/img/MGBot.png', // icon display on chat
		    'token' => [
			    'token_channels1',
		        'token_channels2', // Channels token
	        ]
        ];
    }

    // Update it with your own credentials.
    public static function getGitlabConfig() {
    	return [
    		'gitlab_url' => 'https://your.gitlab.com',
    		'api_version' => 'v4',
    		'project_id' => 525,
    	];
    }

}