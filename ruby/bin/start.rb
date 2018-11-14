#!/usr/bin/env ruby
require File.expand_path('../../lib/gitlab/merge_checker', __FILE__ )
checker = MergeChecker.new
checker.run_checker
exit 200