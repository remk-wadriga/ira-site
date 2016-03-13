Admin = {

    changeEventStatusDropdownID: '#change_event_status_dropdown',
    modalWindowID: '#modal_window',
    modalWindowTitleID: '#modal_window .modal-header',
    modalWindowContentID: '#modal_window .modal-body',

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
    },


    // Auto functions

    // END Auto functions


    // Event handlers

    changeEventStatusDropdownSwich: function () {
        $(Admin.changeEventStatusDropdownID).on('change', function () {
            var item = $(this);

            var success = function () {

            };

            Api.ajx(item.data('url'), {status: item.val()}, success, 'GET');
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
    },

    registerUserByEventRecord: function (item) {
        var success = function (json) {
            if (json.status == 'OK') {
                Admin.openModal(json.content, json.title);

                $(item.data('form')).on('submit', function () {
                    var form = $(this);

                    var formSuccess = function (json) {
                        if (json.status == 'OK') {
                            Admin.closeModal();
                            var remove = item.data('remove');
                            if (remove != undefined) {
                                $(remove).remove();
                            }
                            var addBlock = item.data('add');
                            if (addBlock != undefined) {
                                $(addBlock).append(json.content);
                            }
                        } else {
                            Admin.setModalContent(json.content);
                        }
                    };

                    Api.ajx(item.attr('href'), form.serialize(), formSuccess, 'POST');
                    return false;
                });
            }
            var afterLoad = item.data('after-load');
            if (afterLoad != undefined) {
                eval(afterLoad);
            }
        };

        Api.ajx(item.attr('href'), {}, success, 'GET');
        return false;
    },

    setUserEventRecordStatus: function (item) {
        var success = function (json) {};
        Api.ajx(item.data('url'), {status: item.prop('checked')}, success, 'GET');
    },

    openModal: function (content, title) {
        var modalWindow = $(Admin.modalWindowID);
        Admin.setModalTitle(title);
        Admin.setModalContent(content);
        modalWindow.modal('show');
    },

    setModalTitle: function (title) {
        if (title != undefined) {
            title = '<h3 class="modal-title">' + title + '</h3>';
            var modalTitle = $(Admin.modalWindowTitleID);
            var html = modalTitle.html().toString().replace(title, '');
            modalTitle.html(html + title);
        }
    },

    setModalContent: function (content) {
        $(Admin.modalWindowContentID).html(content);
    },

    closeModal: function () {
        $(Admin.modalWindowID + ' .close').click();
    }

    // END Public functions


    // Private functions

    // END Private functions
};