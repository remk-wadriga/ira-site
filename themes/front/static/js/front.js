Front = {

    eventFilterBtnID: '.event-filter-btn',
    toggleElementID: '.toggle-element',

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
    }

    // END Event handlers


    // Event handlers

    // END Event handlers


    // Public functions

    // END Public functions


    // Private functions

    // END Private functions
};