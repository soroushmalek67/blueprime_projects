<?php

class AdminController extends BaseController
{

	protected $viewBase = 'admin';

	public function __construct()
	{

	}

	public function home()
	{
		$this->view('home');
	}

	public function enrichTwitterStats()
	{
		require_once(base_path().'/vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php');

		$quota = 170;

		$settings = array(
		    'oauth_access_token' => "371966895-85l4a3aE38CYioTnwRW0n8kpRrUphpqjg5n0ARqb",
		    'oauth_access_token_secret' => "I0K4sg5im8LaZ5YFTqggGcWRYut9VmRBFTZr8obWqGir7",
		    'consumer_key' => "qoDvBAPspADrC9irMYQWrHMaT",
		    'consumer_secret' => "SZMafVPziuI5nwzWp1tHYmAxXtdK6wqizR6pfWS0N1dGVlRKJf"
		);


		$url = 'https://api.twitter.com/1.1/users/show.json';
		$requestMethod = 'GET';
		$twitter = new TwitterAPIExchange($settings);

		$userCompanies = UserCompany::where("twitter_url", "!=", "")
									->where("twitter_followers", "=", 0)
									->get();
		$i=0;
		foreach ($userCompanies as $userCompany) {
			if($userCompany->twitter_url != "" && $userCompany->twitter_followers == 0)
			{
				$twitter_url_parts = explode('/', $userCompany->twitter_url);
				$screen_name =  $twitter_url_parts[count($twitter_url_parts) - 1];
				$getfield = '?screen_name='.$screen_name;
				$res = $twitter->setGetfield($getfield)
				             ->buildOauth($url, $requestMethod)
				             ->performRequest();
				$res = json_decode($res);
				if(!isset($res->errors))
				{
					$userCompany->twitter_followers = $res->followers_count;
					$userCompany->twitter_following = $res->friends_count;
					$userCompany->twitter_tweets = $res->statuses_count;
					$userCompany->save();
					if($i++ >= $quota)
						break;
				}
			}
		}

		return "DONE";
	}

}