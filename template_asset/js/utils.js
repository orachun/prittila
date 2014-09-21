
$.pnotify.defaults.history = false;
$.pnotify.defaults.delay = 5000;
function notify(type, title, message)
{
    $.pnotify({
        title: title,
        text: message,
        type: type
    });
}


/**
 * Get form data and return the JSON formatted of the form data
 * @param form_selector jQuery selector of the form
 * @returns JSON formatted of the form data
 */
function form_data_to_JSON(form_selector)
{
    var form = $(form_selector);
    var disabled = form.find(':input:disabled').removeAttr('disabled');
    var form_data_array = form.serializeArray();
    disabled.attr('disabled','disabled');
	var form_data = {};
	for (var i = 0; i < form_data_array.length; i++)
	{
        var key = form_data_array[i]['name'];
        var value = form_data_array[i]['value'];
        if(form_data.hasOwnProperty(key))
        {
            if(!is_array(form_data[key]))
            {
                form_data[key] = [form_data[key]];
            }
            form_data[key].push(value); 
        }
        else
        {
            form_data[key] = value;
        }
	}
    return form_data;
}

function is_array(obj)
{
    return obj instanceof Array;
}


function create_upload_form(container_selector, success_callback, error_callback, filename_placeholder)
{
    var form = 
        '<form class="upload-form" action="'+base_url+'index.php/others/upload" method="post" enctype="multipart/form-data">'
            + '<input class="file" type="file" name="file">'
            + '<div class="progress">'
                + '<div class="bar"></div >'
                + '<div class="percent">0%</div >'
            + '</div>'
        + '</form>';

    $(container_selector).append(form);
    var progress = $(container_selector+' .upload-form .progress');
    var bar = $(container_selector+' .upload-form .bar');
    var percent = $(container_selector+' .upload-form .percent');
    progress.hide();

    $(container_selector+' .upload-form .file').change(function(){
        $(container_selector+' .upload-form').submit();
    });
    $(container_selector+' .upload-form').ajaxForm({
        beforeSend: function() {
            var percentVal = '0%';
            progress.show();
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
            var res = xhr.responseText;
            if(res.indexOf('Error:') == 0)
            {
                error_callback(res);
            }
            else
            {
                $(filename_placeholder).val(res);
                success_callback(res);
            }
        }
    }); 
}

function reset_upload_form(container_selector)
{
    $(container_selector+' .upload-form')[0].reset();
    $(container_selector+' .upload-form .progress').hide();
}