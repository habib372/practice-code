<?php

    function generateAgoraToken($appId, $appCertificate, $channelName, $uid, $role, $expirationTimeInSeconds, $api_key, $api_secret) {
        // Construct the URL for token generation
        $url = "https://api.agora.io/v1/token?channelName={$channelName}&uid={$uid}&role={$role}&appId={$appId}&appCertificate={$appCertificate}&expiredTime=" . (time() + $expirationTimeInSeconds);

        // Create a signature using the API key and secret
        $signature = hash_hmac('sha256', $url, $api_secret);

        // Add the signature to the URL
        $url .= "&token={$signature}";

        // Make a request to the Agora API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        // Decode the JSON response
        $tokenData = json_decode($response, true);

        // Extract and return the token
        return $tokenData['rtcToken'];
    }

    // Replace these values with your Agora project details
    $appId = '8f08be250be84624af8a1b4d02521efa';
    $appCertificate = '01d8a477c3f046ba9362c16f7374a757';
    $channelName = 'TSR-EnP';
    $uid = rand(10000000, 99999999); // Replace with your user ID
    $role = 'publisher'; // or 'subscriber'
    $expirationTimeInSeconds = 3600; // Token expiration time in seconds
    $api_key = 'ca1a22e52638422482736ec56f569bff';
    $api_secret = 'b27639dd5e4e4649ad06e5d68a2141f4';

    // Generate the Agora token
    $agoraToken = generateAgoraToken($appId, $appCertificate, $channelName, $uid, $role, $expirationTimeInSeconds, $api_key, $api_secret);

    // Output the token
    echo "Agora Token: $agoraToken";









    function generateAgoraToken($appId, $appCertificate, $channelName, $uid, $role, $expirationTimeInSeconds, $api_key, $api_secret)
    {
        // Construct the URL for token generation
        $url = "https://api.agora.io/dev/v1/project";

        // Build the parameters for the token request
        $params = [
            'app_id' => $appId,
            'channel_name' => $channelName,
            'user_id' => $uid,
            'role' => $role,
            'expire_timestamp' => time() + $expirationTimeInSeconds,
        ];

        // Create a signature using the API key and secret
        $params['token'] = hash_hmac('sha256', http_build_query($params), $api_secret);

        // Make a request to the Agora API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        // Decode the JSON response
        $tokenData = json_decode($response, true);

        // Check if 'rtcToken' is present in the response
        if (isset($tokenData['rtcToken'])) {
            // Return the 'rtcToken'
            return $tokenData['rtcToken'];
        } else {
            // Handle the case where 'rtcToken' is not present
            return null;
        }
    }

    // Replace these values with your Agora project details
    $appId = 'dbeffd56f1864e5098abb2af75236e31';
    $appCertificate = '01d8a477c3f046ba9362c16f7374a757';
    $channelName = 'TSR-EnP';
    $uid = rand(10000000, 99999999); // Replace with your user ID
    $role = 'publisher'; // or 'subscriber'
    $expirationTimeInSeconds = 3600; // Token expiration time in seconds
    $api_key = 'ca1a22e52638422482736ec56f569bff';
    $api_secret = 'b27639dd5e4e4649ad06e5d68a2141f4';

    // Generate the Agora token
    $agoraToken = generateAgoraToken($appId, $appCertificate, $channelName, $uid, $role, $expirationTimeInSeconds, $api_key, $api_secret);

    // Output the token
    echo "Agora Token: $agoraToken";
?>
