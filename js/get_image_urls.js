javascript:(function() {
    var is_valid_img = function(ele){
        var h = $(ele).height();
        var w = $(ele).width();
        if(h < 250 || w < 250)
        {
            return false;
        }
        
        if(w/h >3 || h/w > 3)
        {
            return false;
        }
        
        return true;
    };
    
    var urls = '';
    $('img').each(function(index, ele) {
        $('img[data-ks-lazyload]').each(function(i,u){
            $(u).attr('src',$(u).attr('data-ks-lazyload'));
        });
        
        if (is_valid_img(ele)) {
            urls += '<a target="_blank" href="' + $(ele).attr('src') + '" >' + $(ele).attr('src') + '</a><br/>';
        }
    });
    $('body').prepend('<div style="margin:auto; width: 90%;">' + urls + '</div><hr/>');
})();