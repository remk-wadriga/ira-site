Api = {
    ajx: function(url, data, success, type, dataType, headers, error){
        success = success || function(){};
        error = error || function(json){return true};
        type = type || 'POST';
        headers = headers || {};
        dataType = dataType || 'json';

        $.ajax({
            type: type,
            url: url,
            data: data,
            headers: headers,
            dataType: dataType,
            beforeSend: function(){},
            success: function(json){
                //success(json);
            },
            complete: function(json){
                success(json);
            },
            error: function(json){
                error(json);
            }
        });
    },
};