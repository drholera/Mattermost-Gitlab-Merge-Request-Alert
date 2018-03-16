<?php

namespace MGBot\Config;

/**
 * Class Config.
 *
 * Contains configuration for mattermost and gitlab.
 */
class Config {

  // Update it with your own credentials.
  public static function getMattermostConfig() {
    return [
      'server' => 'http://mattermost_server',
      'username' => 'MGBot', // username display on chat
      'icon_url' => 'https://example.xyz/img/MGBot.png', // icon display on chat
      'token'    => [
        'channel_token', // Channels token
      ],
    ];
  }

  // Update it with your own credentials.
  public static function getGitlabConfig() {
    return [
      'gitlab_url'  => 'https://your.gitlab.com',
      'api_version' => 'v4',
      'private_token' => 'USER_TOKEN',
    ];
  }

  // We don't need instances here.
  private function __construct() {
  }

}