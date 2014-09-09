var page_access_token = -1;

function fb_get_page_access_token(callback)
{
    if(page_access_token == -1)
    {
        FB.api(
            "/me/accounts",
            "GET",
            function(response) {
                if (response && !response.error) {
                    for (var i = 0; i < response.data.length; i++)
                    {
                        if (response.data[i].name == "Prittila")
                        {
                            page_access_token = response.data[i].access_token;
                            callback();
                            break;
                        }
                    }
                }
            }
        );
    }
    else
    {
        callback();
    }
}

function fb_post_photos(urls, msg, finish_callback, error_callback)
{
    fb_get_page_access_token(function(){
        _fb_post_photo(urls, msg, 0, finish_callback, error_callback);
    });
}

function _fb_post_photo(urls, msg, index, finish_callback, error_callback)
{
    if(index < urls.length)
    {
        fb_get_page_access_token(function(){
            FB.api(
                "/241399496020032/photos",
                "POST",
                {
                    url:urls[index],
                    message:msg,
                    access_token:page_access_token
                },
                function(response) {
                    if (response && !response.error) {
                        _fb_post_photo(urls, msg, index+1, finish_callback, error_callback);
                    }
                    else
                    {
                        error_callback();
                    }
                }
            );
        });
    }
    else
    {
        finish_callback();
    }
}
