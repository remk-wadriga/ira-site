Helper = {

    // Public functions

    addToUrl: function(url, params, urlEncode){
        if (urlEncode == undefined) {
            urlEncode = false;
        }

        var newParams = '';
        if (typeof params == 'object') {
            for (var name in params) {
                newParams += name + '=' + params[name] + '&';
            }
            if (newParams.length > 0) {
                newParams = newParams.substring(0, newParams.length - 1);
            }
        } else {
            newParams = params.toString();
        }

        if (newParams.length > 0) {
            if (url.indexOf('?') == -1) {
                url += '?';
            } else if (url.indexOf('&') == -1 || url.indexOf('&') + 1 != url.length) {
                url += '&';
            }
        }

        return urlEncode ? url + escape(newParams) : url + newParams;
    }

    // END Public functions


    // Private functions

    // END Private functions

};