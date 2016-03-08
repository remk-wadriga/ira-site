Main = {

    checkBoxSwitchID: '.checkbox-switch',
    toggleElementID: '.toggle-element',

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
        Main.initCheckboxSwitch();
    },

    setHandlers: function () {
        Main.clickToggleElement();
    },


    // Auto functions

    initCheckboxSwitch: function () {
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

    // END Auto functions


    // Event handlers

    clickToggleElement: function () {
        $(Main.toggleElementID).on('click', function () {
            var item = $(this);
            $(item.data('target')).toggleClass('hide');
            if (item.attr('href') != undefined) {
                return false;
            }
        });
    }

    // END Event handlers


    // Event handlers

    // END Event handlers


    // Public functions

    // END Public functions


    // Private functions

    // END Private functions
};