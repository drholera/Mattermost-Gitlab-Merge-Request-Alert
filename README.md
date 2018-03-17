# Mattermost Gitlab Merge Request Alert

This small script checks how many merge requests you have and alerts to the Mattermost if there are more that 4 opened merge requests.

### Installation

1. Clone or download current repository
2. Run ``` composer install```
3. Update configuration
4. Run ``` php start --project_id=YOUR_PROJECT_ID ``` (project ID specified in Gitlab)

### Configuration
Go to src/Config and edit the Config.php

```   public static function getMattermostConfig() {
    return [
      'server' => 'http://mattermost_server', // Mattermost server.
      'username' => 'MGBot', // username display on chat.
      'icon_url' => 'https://example.xyz/img/MGBot.png', // icon display on chat.
      'token'    => [
        'channel_token', // Channels token.
      ],
    ];
  }

  // Update it with your own credentials.
  public static function getGitlabConfig() {
    return [
      'gitlab_url'  => 'https://your.gitlab.com', // Gitlab server.
      'api_version' => 'v4', // Gitlab api version. Currently teted only for api v4.
      'private_token' => 'USER_TOKEN', // User api token.
    ];
  }
  ```

Feel free to add something, also your comments and issues will help.