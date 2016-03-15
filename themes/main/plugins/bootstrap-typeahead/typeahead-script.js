TypeaheadScript = {

    blockID: '',
    tagsBlockID: '.tags-block',
    formID: '#tag_form',
    removeTabBtnID: '.tab-btn .glyphicon-remove',
    tags: [],
    addUrl: '',
    removeUrl: '',

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
        TypeaheadScript.clickRemoveTabBtn();
    },


    // Auto functions

    clickRemoveTabBtn: function () {
        $(TypeaheadScript.blockID).on('click', TypeaheadScript.removeTabBtnID, function () {
            var item = $(this).closest('a');
            var tag = item.data('tag');

            var success = function (json) {
                if (json.status == 'OK') {
                    var index = TypeaheadScript.tags.indexOf(tag);
                    if (index > -1) {
                        TypeaheadScript.tags.splice(index);
                    }
                    item.remove();
                }
            };

            $.ajax({
                type: 'POST',
                url: TypeaheadScript.removeUrl,
                data: {tag: tag},
                dataType: 'json',
                beforeSend: function(){},
                success: function(json){
                    success(json);
                }
            });

            return false;
        });
    },

    // END Auto functions


    // Event handlers

    submitForm: function () {
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

        var success = function (json) {
            if (json.status == 'OK') {
                var item = '<a href="#" class="btn btn-primary tab-btn"';
                    item += 'data-tag="' + tag.name + '">';
                    item += tag.name;
                    item += ' <i class="glyphicon glyphicon-remove"></i>';
                    item += '</a>';

                var tagBlock = $(TypeaheadScript.blockID + ' ' + TypeaheadScript.tagsBlockID);
                tagBlock.append('&nbsp;');
                tagBlock.append(item);
            }
        };

        $.ajax({
            type: 'POST',
            url: TypeaheadScript.addUrl,
            data: {tag: tag.name},
            dataType: 'json',
            beforeSend: function(){},
            success: function(json){
                success(json);
            }
        });
    }

    // END Public functions


    // Private functions

    // END Private functions
};