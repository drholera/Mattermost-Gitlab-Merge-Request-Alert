class Config
  def self.get_mattermost_config
    arr = [
        'server'   => 'http://mattermost_server',
        'username' => 'MGBot', # username display on chat
        'icon_url' => 'https://example.xyz/img/MGBot.png', # icon display on chat
        'token' => [
            'channel_token', # Channels token
        ],
    ]
    arr
  end

  def self.get_gitlab_config
    arr = [
        'gitlab_url'    => 'https://your.gitlab.com',
        'api_version'   => 'v4',
        'private_token' => 'USER_TOKEN',
    ]
    arr
  end

  private_class_method :new
end