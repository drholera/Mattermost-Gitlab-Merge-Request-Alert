require 'getoptlong'
require 'net/http'
require 'json'
require File.expand_path('../../config/config', __FILE__)

class MergeChecker
  OPENED_MERGE_REQUESTS = '/merge_requests?state=opened'

  def run_checker
    merge_requests_count = get_merge_reqests_count
    if merge_requests_count >= 5
      display_message(merge_requests_count)
    end
  end

  def get_merge_reqests_count
    url = get_gitlab_full_url
    response = Net::HTTP.get(URI url)
    count = 0
    if !response.empty?
      JSON.parse(response).each do |merge_request|
        if merge_request['work_in_progress'] == false
          count += 1
        end
      end
    end
    count
  end

  def display_message (merge_requests_count)
    mattermost_config = Config::get_mattermost_config[0]

    mattermost_config['token'].each do |webhook|
      data = {
          # "json" => [
              "username" => mattermost_config['username'],
              "icon_url" => mattermost_config['icon_url'],
              "text" => "Guys! We have too many MRs. #{merge_requests_count} for now! Check it when you'll have time. Big brother is watching you!",
          # ]
      }.to_json

      result = Net::HTTP.post(URI("#{mattermost_config['server']}/hooks/#{webhook}"), data,
                     "Content-Type" => "application/json")

      puts result
    end
  end

  protected

  def get_gitlab_full_url
    params = GetoptLong.new(
        ['--project_id', GetoptLong::REQUIRED_ARGUMENT],
        ['--help', '-h', GetoptLong::NO_ARGUMENT]
    );

    pid = nil

    params.each do |param, value|
      case param
      when '--project_id'
        if value.nil? || value.empty?
          puts 'Project ID should be specified as --project_id param'
          exit 0
        end
        pid = value.to_i
      when '--help'
        puts 'Some help info.'
      end
    end

    config = Config::get_gitlab_config[0]

    "#{config['gitlab_url']}/api/#{config['api_version']}/projects/#{pid}#{OPENED_MERGE_REQUESTS}&private_token=#{config['private_token']}"
  end
end