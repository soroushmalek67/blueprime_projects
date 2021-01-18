<?php
	 $name = $_GET['name'];
              ini_set('display_errors', 1);
              require_once('TwitterAPIExchange.php');

              /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
              $settings = array(
                  'oauth_access_token' => "328652527-zTDIs9ni3pSU0TYIIdq4e6dCV5R96y9XvHLUzbaz",
                  'oauth_access_token_secret' => "TbEe80eZt89ZlYiRzPPzqXMPYJGc9vKPpUux44Mtd1wTv",
                  'consumer_key' => "DbOfEYTZgGUC7dqsjfso3pzX1",
                  'consumer_secret' => "4YR3G4NjDT6FR7IjyewsaoZSaArjMyX6gvUkzaWB5f96AS8FQi"
              );

              $url = 'https://api.twitter.com/1.1/search/tweets.json';
              $requestMethod = 'GET';
              $getfield = '?q=@' . $name . '&result_type=recent';

              // Perform the request
              $twitter = new TwitterAPIExchange($settings);
              $api_response = $twitter ->setGetfield($getfield)
                                   ->buildOauth($url, $requestMethod)
                                   ->performRequest();             

//echo $getfield;
              $response = json_decode($api_response);
              if ($response)
              {
              	if ($response->statuses)
              	{
	              echo "<table class='table table-striped table-bordered table-hover'>";
	              echo "<thead>";
	              echo "<tr style='background:#373;color:white'>";
	              echo "<th>User</th><th>Time</th><th>Tweet</th></tr>";
	              echo "</thead>";
	              echo "<tbody>";
 	              foreach($response->statuses as $tweet)
	              {
//	                echo "<tr><td>{$tweet->user->screen_name}</td>";
                  $url2 = 'https://api.twitter.com/1.1/users/search.json';
                  //$requestMethod = 'GET';
                  $getfield2 = '?q=@' . $tweet->user->screen_name;

                  // Perform the request
                  //$twitter = new TwitterAPIExchange($settings);

                  $api_response = $twitter ->setGetfield($getfield2)
                                       ->buildOauth($url2, $requestMethod)
                                       ->performRequest();             

                  $response2 = json_decode($api_response);
//                  foreach($response2 as $user)
//                  {
                    echo "<tr><td><img src='". $response2[0]->profile_image_url . "'><br/>". $response2[0]->name . "<br/><span class='label label-success'>". $response2[0]->location . "</span></td>";
//                  }       
                  echo "<td>{$tweet->created_at}</td><td>{$tweet->text}</td></tr>";
	              }       
	              echo "</tbody>";
	              echo "</table>";
              	}
              	else
              	{
	                echo "No tweets found.";
              	}
              }
              else 
              {
	                echo "Connection Issue.";
              }     

?>