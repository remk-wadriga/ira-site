Tags = {

    filterFormID: '#tags_filter_form',
    tags: [],

    init: function (data) {
        if (data !== undefined) {
            $.each(data, function (index, value) {
                if (Tags[index] !== undefined) {
                    Tags[index] = value;
                }
            });
        }

        Tags.setAutoFunctions();
        Tags.setHandlers();
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

    filterByTag: function(item)
    {
        var form = $(Tags.filterFormID);
        var tag = item.data('tag');
        if (Tags.tags == null) {
            Tags.tags = [];
        }

        if (tag != 0) {
            var index = Tags.tags.indexOf(tag);
            if (index > -1) {
                var tmpTags = Tags.tags;
                Tags.tags = [];
                var i = 0;
                $.each(tmpTags, function (index, elem) {
                    if (elem != tag) {
                        Tags.tags[i++] = elem;
                    }
                });
            } else {
                var length = Tags.tags.length;
                Tags.tags[length] = tag;
            }
        } else {
            Tags.tags = [];
        }

        $('input:text', form).val(JSON.stringify(Tags.tags));
        form.submit();

        return false;
    }

    // END Public functions


    // Private functions

    // END Private functions

};