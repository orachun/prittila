<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function fb_load_js_sdk($admin = false) {
    ?>
    <div id="fb-root"></div>
    <script>
        var fb_access_token;
        window.fbAsyncInit = function() {
            // init the FB JS SDK
            FB.init({
                appId: '301848219953299', // App ID from the app dashboard
                status: true, // Check Facebook Login status
                xfbml: true   // Look for social plugins on the page
            });

            // Additional initialization code such as adding Event Listeners goes here

            FB.Event.subscribe('xfbml.render',
                    function(href, widget) {
                        $('iframe').removeAttr('title');
                    }
            );

    <?php if ($admin): ?>
                if (FB.getAuthResponse() === undefined)
                {
                    FB.login();
                }

                FB.Event.subscribe('auth.authResponseChange', function(response) {
                    if (response.status === 'connected') {
                        var authResponse = FB.getAuthResponse();
                        fb_access_token = (authResponse.accessToken);
                    } else if (response.status === 'not_authorized') {
                        FB.login({scope: 'manage_pages'});
                    } else {
                        FB.login();
                    }
                });
    <?php endif; ?>

        };

        // Load the SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js";
            fjs.parentNode.insertBefore(js, fjs);

        }(document, 'script', 'facebook-jssdk'));

    </script>
    <?php
}

function post_to_fb($img_path, $desc) {
    require_once ___config('base_path') . 'libs/facebook-sdk/facebook.php';
    $app_id = '301848219953299';
    $app_secret = 'acde5c7f10f1975973122d9d375644b1';
    $fanpage = '216408685185780';
    $album_id = '241399496020032';

    $facebook = new Facebook(array(
        'appId' => $app_id,
        'secret' => $app_secret,
        'fileUpload' => true
    ));

  
    $access_token = '';
    if (empty($_POST['access_token'])) {
        if (empty($_GET['access_token'])) {
            return false;
        } else {
            $access_token = $_GET['access_token'];
        }
    } else {
        $access_token = $_POST['access_token'];
    }
    // Get the page access token
    $accounts = $facebook->api('/me/accounts', 'GET', array(
        'access_token' => $access_token
    ));
    foreach ($data as $account) {
        if ($account['id'] == $fanpage || $account['name'] == $fanpage) {
            $fanpage_token = $account['access_token'];
        }
    }
    $facebook->api('/' . $album_id . '/photos', 'POST', array(
        'message' => $desc,
        'source' => '@' . $img_path,
        'access_token' => $fanpage_token // note, we use the page token here
    ));

//    require_once ___config('base_path') . 'libs/Facebook/FacebookSession.php';
//    require_once ___config('base_path') . 'libs/Facebook/FacebookRequest.php';
//    require_once ___config('base_path') . 'libs/Facebook/GraphObject.php';
//    require_once ___config('base_path') . 'libs/Facebook/FacebookRequestException.php';

    //FacebookSession::setDefaultApplication($app_id, $app_secret);
//    $session = new FacebookSession($access_token);
//    if ($session) {
//
////        try {
//
//            $request = new FacebookRequest(
//                    $session, 'GET', '/orachun/accounts', array(
//                'access_token' => $access_token
//                    )
//            );
//            $accounts = $request->execute()->getGraphObject();
//
//            print_r($accounts);
//
//            $data = $accounts['data'];
//            foreach ($data as $account) {
//                if ($account['id'] == $fanpage || $account['name'] == $fanpage) {
//                    $fanpage_token = $account['access_token'];
//                }
//            }
//
//            echo $fanpage_token;
//            
//            $request = new FacebookRequest(
//                    $session, 'POST', '/' . $album_id . '/photos', array(
//                'source' => '@' . $img_path,
//                'message' => $desc,
//                'access_token' => $fanpage_token
//                    )
//            );
//            $response = $request->execute()->getGraphObject();
////        } catch (FacebookRequestException $e) {
////            
////        }
//    }
//    
}

function prepare_fb_desc($desc, $product_info, $link) {
    $color_list = '';
    $size_list = '';
    foreach ($product_info['size'] as $s) {
        if (empty($s))
            continue;
        $size_list .= $s . ', ';
    }
    foreach ($product_info['color'] as $c) {
        if (empty($c))
            continue;
        //$c = explode(':', $c);
        //$color_list .= $c[1] . ', ';
        $color_list .= $c.',';
    }
    $color_list = substr($color_list, 0, strlen($color_list) - 2);
    $size_list = substr($size_list, 0, strlen($size_list) - 2);


    $desc = str_replace("{desc}", $product_info['desc'], $desc);
    $desc = str_replace("{name}", $product_info['name'], $desc);
    $desc = str_replace("{unit_price}", $product_info['unit_price'], $desc);
    $desc = str_replace("{link}", $link, $desc);
    $desc = str_replace("{colors}", $color_list, $desc);
    $desc = str_replace("{sizes}", $size_list, $desc);

    $desc .= ' #prittila_'.str_replace(" ", "_", $product_info['cat_name']);
    $desc .= ' #prittila';
    
    return $desc;
}

function fb_desc_placeholder_list() {
    return '{desc}, {name}, {unit_price}, {link}, {colors}, {sizes}';
}

function fb_default_desc() {
    return "{name}: {unit_price} บาท
สี: {colors} ไซส์: {sizes}
{desc}
ดูเต็มๆที่ {link}
";
}

function like_btn($url, $return = false) {
    //$url = 'http://www.google.com/?a='.rand(0, 10);

    $btn = '<div class="fb-like" data-href="' . $url . '" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>';
    if ($return) {
        return $btn;
    } else {
        echo $btn;
    }
}

function fb_comments($url, $return = false) {
    //$url = 'http://www.google.com/?a='.rand(0, 10);

    $comments = '<div class="center-block" style="width:400px;">'
            . '<div class="fb-comments" data-href="' . $url . '" data-width="400" data-numposts="5" data-colorscheme="light"></div>'
            . '</div>';
    if ($return) {
        return $comments;
    } else {
        echo $comments;
    }
}
