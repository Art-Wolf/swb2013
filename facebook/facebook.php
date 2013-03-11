<?php
require 'facebook-php-sdk/src/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '',
  'secret' => '',
));

    $access_token = $facebook->getAccessToken();
    echo($access_token);
    $me = null; 

   if ($facebook->getUser() === 0 ) {
   	header("Location:{$facebook->getLoginUrl(array('req_perms' => 'email,offline_access'))}"); 
	}
    try 
    { 
        $uid = $facebook->getUser(); 
        echo "UID: " . $uid;
        $me = $facebook->api('/'.$uid); 
        echo "Welcome User: " . $me['name'] . "<br />"; 
        //access permission
        $permissions_needed = array('publish_stream', 'read_stream', 'offline_access', 'manage_pages');
        
        // I need to examine this logic, it was causing a looping chain of requests for permission..
        
       // foreach($permissions_needed as $perm) 
       // {  
       //     if( !isset($permissions_list['data'][0][$perm]) || $permissions_list['data'][0][$perm] != 1 )
       //     {    
       //     $login_url_params = array(
       //         'scope' => 'publish_stream,read_stream,offline_access,manage_pages',         
       //         'fbconnect' =>  1,         
       //         'display'   =>  "page",         
       //         'next' => 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']      
       //         );    
       //     $login_url = $facebook->getLoginUrl($login_url_params);   
       //     header("Location: {$login_url}");
       //     exit(); 
       //     }
       // }
        //Access permission

        $post_id = $facebook->api("/$uid/feed", "post", array("message"=>"Hello World!")); 
        if(isset($post_id)) 
        {
            echo "A new post to your wall has been posted with id: $post_id"; 
        }
    } 
    catch (FacebookApiException $e) 
    { 
        echo($e); 
    } 
?>
