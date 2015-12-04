?
<?php
    require_once('TwitterAPIExchange.php'); 
     
    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
   $settings = array(
        'oauth_access_token' => "3693376757-PI5bLRQtxbzB6GPaY42SLZHolaPZYw5GJEcsoE4",
        'oauth_access_token_secret' => "A1SpBKL0Onkgs7Yfg65yQbzFVJlrQoNHsZGKMdKQX8Ja8",
        'consumer_key' => "JLlgDr4ZzuYtXM3HyiFrZchtm",
        'consumer_secret' => "0zvr6HEblWioU5QQ9MOVotQ7RTze7xKyU5ESfzFF1fmhXzLGo5"
    );


//get_user_timeline function
//This code is used to get user timeline
function get_user_timelines($settings, $user_id = "18839785", $screen_name = "narendramodi", $count = "20") {

	$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
	$requestMethod = "GET";
	$getfield = "?user_id=" . $user_id . "&screen_name=" . $screen_name . "&count=" . $count;
	//$getfield = "?user_id=18839785&screen_name=narendramodi&count=20";

	$twitter = new TwitterAPIExchange($settings);
	$string = json_decode($twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                 ->performRequest(),$assoc = TRUE);	


    	if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}


	echo "<h1><u>" . "Get User Timeline of user ID " . $user_id . "</u></h1>";
	echo "<br>";
	$i = 0;
	foreach($string as $items)
	
        {
	
	$i++;
	    echo "<u>Tweet number : " . $i . "</u><br>";
	    echo "Profile Picture: " . "<img src=" . $items['user']['profile_image_url_https'] . "/>" . "<br />";
	    echo "Tweeted by: ". $items['user']['name']."<br />";
            echo "Screen name: ". $items['user']['screen_name']."<br />";
	    echo "Time and Date of Tweet: ".$items['created_at']."<br />";
            echo "Tweet: ". $items['text']."<br />";
            echo "Followers: ". $items['user']['followers_count']."<br />";
            echo "Friends: ". $items['user']['friends_count']."<br />";
            echo "Listed: ". $items['user']['listed_count']."<br />";
	    echo "<br>";
	
        }
}

function get_statuses_lookup($settings, $id = "20,432656548536401920") {

	$url = "https://api.twitter.com/1.1/statuses/lookup.json";
	$requestMethod = "GET";
	$getfield = "?id=" . $id;
	
	$twitter = new TwitterAPIExchange($settings);

	$string = json_decode($twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest(),$assoc = TRUE);	


    	if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}

	echo "<h1><u>" . "Get Status lookup of Tweet ID " . $id . "</u></h1>";
	echo "<br>";
	$i = 0;
	foreach($string as $items)
        {
	
	$i++;
	    echo "<u>Tweet number : " . $i . "</u><br>";
	    echo "Profile Picture: " . "<img src=" . $items['user']['profile_image_url_https'] . "/>" . "<br />";
            echo "Screen name: ". $items['user']['screen_name']."<br />";
            echo $items['created_at']."<br />";
            echo $items['text']."<br />";
	    echo "Time and Date of Tweet: ".$items['created_at']."<br />";
            echo "Tweet: ". $items['text']."<br />";
            echo "Followers: ". $items['user']['followers_count']."<br />";
            echo "Friends: ". $items['user']['friends_count']."<br />";
            echo "Listed: ". $items['user']['listed_count']."<br />";
	    echo "<br>";
	
        }

}


//Search Tweets
function search_tweet($settings,$q) {
	$url = "https://api.twitter.com/1.1/search/tweets.json";
	$requestMethod = "GET";
	$getfield = "?q=" . $q;
	$twitter = new TwitterAPIExchange($settings);
	$string = json_decode($twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest(),$assoc = TRUE);

if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}

	echo "<h1><u>" . "Search tweets of " . $q . "</u></h1>";
	echo "<br>";
	$i = 0;
	foreach($string["statuses"] as $items)
        {
	
	$i++;
	    echo "<u>Number : " . $i . "</u><br>";
	    echo "Profile Picture: " . "<img src=" . $items['user']['profile_image_url_https'] . "/>" . "<br />";
            echo "Screen name: ". $items['user']['screen_name']."<br />";
	    echo "Name: ". $items['user']['name']."<br />";
            echo "Time and Date of Tweet: ".$items['created_at']."<br />";
            echo "Tweet: ". $items['text']."<br />";
            echo "<br>";
	
        }

	
}


//Get Status Retweet

function get_statuses_retweet($settings, $id = "327473909412814850", $count = "20") {

    $url = "https://api.twitter.com/1.1/statuses/retweeters/ids.json";
    $requestMethod = "GET";
    $getfield = "?id=" . $id . "&count=" . $count;
   
    $twitter = new TwitterAPIExchange($settings);

    $string = json_decode($twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest(),$assoc = TRUE);   


        if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}


	echo "<h1><u>ReTweet IDS for the Tweet ID " . $id . "</u></h1>";
	echo "<br>";
	$i = 0;
	foreach($string["ids"] as $items)
        {
	
	$i++;
	    echo "ReTweet ID : " . $i. " = " . $items . "<br>";
	}

}


//Status Show id
function show_status_id($settings, $id = "647290776779538432")
//---------------------------------------------------------------------------------------------------------------------------------------
{ 
   $url = "https://api.twitter.com/1.1/statuses/show.json";
    $requestMethod = "GET";
    $getfield = "?id=" . $id;
   
    $twitter = new TwitterAPIExchange($settings);

    $string = json_decode($twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest(),$assoc = TRUE);   


        if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}



    echo "<h1><u>" . "Text and related details of the Tweet ID " . $string["id"] . "</u></h1> <br />";
    echo "Text : " . $string["text"] . "<br />";
    echo "Profile Picture" . "<img src=" . $string["user"]["profile_image_url_https"] . "/>" ."<br />";
    echo "Name of Tweeter : " . $string["user"]["screen_name"] . "<br />";
    echo "Screen name of Tweeter : " . $string["user"]["screen_name"] . "<br />";
    echo "Location : " . $string["user"]["location"] . "<br />";
    echo "Created At : " . $string["user"]["created_at"] . "<br />";
    
 
}
//---------------------------------------------------------------------------------------------------------------------------------------


//Friend list
function get_friend_list($settings, $user_id = "18948365") {

	$url = "https://api.twitter.com/1.1/friends/list.json";
	$requestMethod = "GET";
	$getfield = "?user_id=" . $user_id;
	
	$twitter = new TwitterAPIExchange($settings);
	$string = json_decode($twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest(),$assoc = TRUE);	


    	if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}


	echo "<h1><u>" . "Get Friend List of user ID " . $user_id . "</u></h1>";
	echo "<br>";
	$i = 0;
	foreach($string["users"] as $items)
        {
	
	$i++;
	    echo "Number : " . $i . "<br>";
	    echo "Profile Picture : " . "<img src=" . $items['profile_image_url_https'] . "/>" . "<br />";
	    echo "Name : " . $items["name"] . "<br />";
            echo "Screen name: ". $items["screen_name"]."<br />";
	    echo "<br>";
	
        }

}


//Get Followers of user id
function get_follower_id($settings, $user_id = "18839785") {

	$url = "https://api.twitter.com/1.1/followers/ids.json";
	$requestMethod = "GET";
	$getfield = "?user_id=" . $user_id;
	
	$twitter = new TwitterAPIExchange($settings);

	$string = json_decode($twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest(),$assoc = TRUE);	


    	if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}

	


	 echo "<h1><u>" . "Follower IDs of User ID " . $user_id . "</u></h1> <br />";

	$i = 0;
	foreach($string["ids"] as $items)
        {
	
	$i++;
		
            echo "ID: ". $items. "<br />";
	    echo "<br>";
	
        }

	
}

//GET users/lookup
function get_user_lookup($settings, $user_id  = "18839785") {

	$url = "https://api.twitter.com/1.1/users/lookup.json";
	$requestMethod = "GET";
	$getfield = "?user_id=" . $user_id;
	
	$twitter = new TwitterAPIExchange($settings);

	$string = json_decode($twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest(),$assoc = TRUE);	


    	if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}


	echo "<h1><u>" . "Get User lookup of user ID " . $user_id . "</u></h1>";
	echo "<br>";

	$i = 0;
	foreach($string as $items)
        {
	
	$i++;
	    echo "Profile Picture: " . "<img src=" . $items['profile_image_url_https'] . "/>" . "<br />";
	    echo "Screen name: ". $items['screen_name']."<br />";
	    echo "<u>Name: ". $items['name']."</u><br />";
            echo "Followers: ". $items['followers_count']."<br />";
            echo "Friends: ". $items['friends_count']."<br />";
            echo "Listed: ". $items['listed_count']."<br />";
	    echo "<br>";
	
        }

}


switch ($_POST[action])
{
case "get_user_timeline"  : get_user_timelines($settings, $_POST[user_id1], $_POST[screen_name1], $_POST[count1]); break;
case "get_user_lookup" 	  : get_user_lookup($settings, $_POST[user_id2]); break;
case "get_status_lookup"  : get_statuses_lookup($settings, $_POST[id3]); break;
case "get_search_tweet"   : search_tweet($settings, $_POST[q4]); break;
case "get_friend_list"	  : get_friend_list($settings, $_POST[id5]); break;
case "get_statuses_retweets" : get_statuses_retweet($settings, $_POST[id7], $_POST[count7]);break;
case "show_ids" 	: show_status_id($settings, $id = "647290776779538432"); break;
case "follower_id"	: get_follower_id($settings, $_POST[user_id10]); break;
}




?>
