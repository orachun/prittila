
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