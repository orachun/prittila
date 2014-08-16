function create_upload_form(container_selector, callback)
{
    var form = 
        '<form action="'+base_url+'index.php/others/upload" method="post" enctype="multipart/form-data">'
            + '<input type="file" name="file"><br>'
            + '<input type="submit" value="Upload">'
            + '<div class="progress">'
                + '<div class="bar"></div >'
                + '<div class="percent">0%</div >'
            + '</div>'
        + '</form>';

    $(container_selector).append(form);
    
    var bar = $(container_selector+' .bar');
    var percent = $(container_selector+' .percent');

    $(container_selector+' form').ajaxForm({
        beforeSend: function() {
            var percentVal = '0%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        success: function() {
            var percentVal = '100%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        complete: function(xhr) {
            callback(xhr.responseText);
        }
    }); 
}