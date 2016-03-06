Main = {

    checkBoxSwitchID: '.checkbox-switch',

    init: function (data) {
        if (data !== undefined) {
            $.each(data, function (index, value) {
                if (Main[index] !== undefined) {
                    Main[index] = value;
                }
            });
        }

        Main.setAutoFunctions();
        Main.setHandlers();
    },

    setAutoFunctions: function () {
        $(Main.checkBoxSwitchID).bootstrapSwitch().on('switchChange.bootstrapSwitch', function () {
            var item = $(this);
            var onChangeCallback = item.data('onchange');

            if (onChangeCallback != undefined) {
                var blocked = item.data('blocked');
                if (blocked == undefined) {
                    eval(onChangeCallback.replace('{this}', 'item'));
                }
            }
        });
    },

    setHandlers: function () {

    }


    // Auto functions

    // END Auto functions


    // Event handlers

    // END Event handlers


    // Event handlers

    // END Event handlers


    // Public functions

    // END Public functions


    // Private functions

    // END Private functions
};