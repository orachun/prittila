var page_access_token = -1;
var page_id = -1;
var album_id = -1;

function fb_get_page_access_token(callback)
{
    if (page_access_token == -1)
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
                                page_id = response.data[i].id;
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
    fb_get_page_access_token(function() {
        _fb_post_photo(urls, msg, 0, finish_callback, error_callback);
    });
}

function _fb_post_photo(urls, msg, index, finish_callback, error_callback)
{
    if (index < urls.length)
    {
        fb_get_page_access_token(function() {
            _fb_get_album_id(function(album_id){
                FB.api(
                    "/"+album_id+"/photos",
                    "POST",
                    {
                        url: urls[index],
                        message: msg,
                        access_token: page_access_token
                    },
                function(response) {
                    if (response && !response.error) {
                        _fb_post_photo(urls, msg, index + 1, finish_callback, error_callback);
                    }
                    else
                    {
                        error_callback();
                    }
                }
                );
            }, error_callback);
        });
    }
    else
    {
        finish_callback();
    }
}


function _fb_get_album_id(finish_callback, error_callback)
{
    if(album_id != -1)
    {
        return finish_callback(album_id);
    }
    var album_name = _fb_get_album_name();
    fb_get_page_access_token(function() {
        FB.api(
            "/" + page_id + "/albums?fields=name",
            "GET",
            function(response) {
                if (response && !response.error) {
                    for (var i = 0; i < response.data.length; i++)
                    {
                        if (response.data[i].name == album_name)
                        {
                            album_id = response.data[i].id;
                            finish_callback(album_id);
                            break;
                        }
                    }
                    if (album_id == -1)
                    {
                        FB.api(
                                "/" + page_id + "/albums",
                                "POST",
                                {
                                    "name": album_name,
                                    "message": album_name,
                                    "privacy": 'EVERYONE',
                                },
                                function(response) {
                                    if (response && !response.error) {
                                        album_id = response.id;
                                        finish_callback(album_id);
                                    }
                                    else
                                    {
                                        error_callback();
                                    }
                                }
                        );
                    }
                }
                else
                {
                    error_callback();
                }
            }
        );
    });
}

var mths = ['', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
function _fb_get_album_name()
{
    var name = "สินค้าประจำเดือน ";
    var date = new Date();
    name += mths[date.getMonth()] + " " + (date.getFullYear() + 543);
    return name;
}