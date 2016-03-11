Admin = {

    changeEventStatusDropdownID: '#change_event_status_dropdown',
    eventLoadFilesCheckBoxID: '#event_load_files_checkbox',

    init: function (data) {
        if (data !== undefined) {
            $.each(data, function (index, value) {
                if (Admin[index] !== undefined) {
                    Admin[index] = value;
                }
            });
        }

        Admin.setAutoFunctions();
        Admin.setHandlers();
    },

    setAutoFunctions: function () {

    },

    setHandlers: function () {
        Admin.changeEventStatusDropdownSwich();
        Admin.clickEventLoadFieldsCheckbox();
    },


    // Auto functions

    // END Auto functions


    // Event handlers

    changeEventStatusDropdownSwich: function () {
        $(Admin.changeEventStatusDropdownID).on('change', function () {
            var item = $(this);

            var success = function () {
                if (!checked) {
                    return false;
                }
            };

            Api.ajx(item.data('url'), {status: item.val()}, success, 'GET');
        });
    },

    clickEventLoadFieldsCheckbox: function () {
        $(Admin.eventLoadFilesCheckBoxID).on('change', function () {
            var item = $(this);
            var isChecked = item.prop('checked');
            var target = $(item.data('target'));
            if (isChecked) {
                var success = function (json) {
                    target.html(json.responseText);
                };
                Api.ajx(item.data('url'), {}, success, 'GET');
            } else {
                target.html(' ');
            }
        });
    },

    // END Event handlers


    // Event handlers

    // END Event handlers


    // Public functions

    changeSlideStatus: function (item) {
        var checked = item.prop('checked');

        var success = function () {
            if (!checked) {
                return false;
            }
        };

        Api.ajx(item.data('url'), {isActive: checked}, success, 'GET');
    }

    // END Public functions


    // Private functions

    // END Private functions
};