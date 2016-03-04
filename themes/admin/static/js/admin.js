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