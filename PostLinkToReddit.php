<?php
    // reddit username
    $username = 'as_easy';

    // reddit password
    $password = '01004700299';

    // client id
    $clientId = '6GkfIUgnfEVDog';

    // client secret
    $clientSecret = 'RB8_krlcQ81hnG8qlNmdCNgyE6Q';

    // reddit username
    $username = 'as_easy';

    // subreddit name (no spaces)
    $subredditName = 'programming';

    // subreddit display name (can have spaces)
    $subredditDisplayName = 'programming';

    // subreddit post title
    $subredditPostTitle = 'Hoooooooooooooooooooo !!!';

    //subreddit post url
    $subredditUrl = 'www.twitter.com/aaasasdasd';

    // api call endpoint
    $apiCallEndpoint = 'https://oauth.reddit.com/api/submit';

    // connection params
    $params = array(
        'grant_type' => 'password',
        'username' => $username,
        'password' => $password
    );

// post data: posting a link to a subreddit
  $postData = array(
        'url' => $subredditUrl,
        'title' => $subredditPostTitle,
        'sr' => $subredditName,
        'kind' => 'link'
    );

    // curl settings and call to reddit
    $ch = curl_init('https://www.reddit.com/api/v1/access_token');
    curl_setopt($ch, CURLOPT_USERPWD, $clientId . ':' . $clientSecret);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // curl response from reddit
    $response_raw = curl_exec($ch);
    $response = json_decode($response_raw);
    curl_close($ch);

    print_r($response);

    // Access Token
    $accessToken = $response->access_token;

    //Token Type
    $accessTokenType = $response->token_type;

    $ch = curl_init( $apiCallEndpoint );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_USERAGENT, $subredditDisplayName . ' by /u/' . $username . ' (Phapper 1.0)' );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "Authorization: " . $accessTokenType . " " . $accessToken ) );
    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $postData );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );

		// curl response from our post call
    $response_raw = curl_exec( $ch );
    $response = json_decode( $response_raw );
    curl_close( $ch );

    print_r($response);

    ?>
