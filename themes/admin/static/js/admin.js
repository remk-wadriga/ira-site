Admin = {
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

    },


    // Auto functions

    // END Auto functions


    // Event handlers

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
            /*$(Main.checkBoxSwitchID).each(function (index, input) {
                input = $(input);
                if (input.attr('id') != item.attr('id')) {
                    input.bootstrapSwitch('state', false);
                }
            });*/
        };

        Api.ajx(item.data('url'), {isActive: checked}, success, 'GET');
    }

    // END Public functions


    // Private functions

    // END Private functions
};