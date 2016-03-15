TypeaheadScript = {

    formID: '#tag_form',
    tags: [],

    init: function (data) {
        if (data !== undefined) {
            $.each(data, function (index, value) {
                if (TypeaheadScript[index] !== undefined) {
                    TypeaheadScript[index] = value;
                }
            });
        }

        TypeaheadScript.setAutoFunctions();
        TypeaheadScript.setHandlers();
    },

    setAutoFunctions: function () {

    },

    setHandlers: function () {
        TypeaheadScript.submitForm();
    },


    // Auto functions

    // END Auto functions


    // Event handlers

    submitForm: function () {
        console.log(TypeaheadScript.tags);
        $(TypeaheadScript.formID).on('submit', function () {
            TypeaheadScript.addTag({name: $('input:text', this).val()});
            return false;
        });
    },

    // END Event handlers


    // Event handlers

    // END Event handlers


    // Public functions

    addTag: function (tag) {
        var issetTag = false;
        var length = 0;
        $.each(TypeaheadScript.tags, function (index, item) {
            if (item == tag.name) {
                issetTag = true;
            }
            length++;
        });

        if (issetTag) {
            return false;
        }

        TypeaheadScript.tags[length++] = tag.name;

        console.log(TypeaheadScript.tags);
    }

    // END Public functions


    // Private functions

    // END Private functions
};