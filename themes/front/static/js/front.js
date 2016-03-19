Front = {

    eventFilterBtnID: '.event-filter-btn',
    toggleElementID: '.toggle-element',
    commentFormTmplID: '#comment_form_tmpl',
    commentFormContainerID: '.comment-form-container',
    leaveCommentBtnID: '.leave-comment-btn',

    init: function (data) {
        if (data !== undefined) {
            $.each(data, function (index, value) {
                if (Front[index] !== undefined) {
                    Front[index] = value;
                }
            });
        }

        Front.setAutoFunctions();
        Front.setHandlers();
    },

    setAutoFunctions: function () {

    },

    setHandlers: function () {
        Front.clickToggleElement();
        Front.clickEventFilterBtn();
    },


    // Auto functions

    // END Auto functions


    // Event handlers

    clickToggleElement: function () {
        $(Front.toggleElementID).on('click', function () {
            var item = $(this);
            $(item.data('target')).toggleClass('hide');
            if (item.attr('href') != undefined) {
                return false;
            }
        });
    },

    clickEventFilterBtn: function () {
        $(Front.eventFilterBtnID).on('click', function () {
            var item = $(this);
            var formID = item.data('form');

            $(formID + ' input:text').val(item.data('filter'));
            $(formID).submit();

            return false;
        });
    },

    // END Event handlers


    // Event handlers

    // END Event handlers


    // Public functions

    getCommentForm: function (item, params) {
        var container = item.next(Front.commentFormContainerID);
        $(Front.commentFormTmplID).tmpl(params).appendTo(container);
        item.addClass('hide');

        $('form', container).on('submit', function () {
            var form = $(this);

            if (!$('textarea', form).val()) {
                return false;
            }

            var success = function (json) {
                if (typeof json.responseText) {
                    $(item.data('comments-block')).append(json.responseText);
                    item.removeClass('hide');
                    container.html('');
                }
            };

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                dataType: 'json',
                complete: function(json){
                    success(json);
                }
            });
            return false;
        });

        return false;
    },

    cancelCommentForm: function (item) {
        $(Front.leaveCommentBtnID, item.closest('.col-lg-9')).removeClass('hide');
        $(Front.leaveCommentBtnID, item.closest('.wrapper')).removeClass('hide');
        item.closest(Front.commentFormContainerID).html('');

        return false;
    },

    // END Public functions


    // Private functions

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
                success(json);
            },
            complete: function(json){
                //success(json);
            },
            error: function(json){
                error(json);
            }
        });
    }

    // END Private functions
};