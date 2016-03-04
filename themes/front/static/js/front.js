Front = {
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