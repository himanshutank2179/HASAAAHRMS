var ajaxform = {
    
    addFloatForm: function (url, container) {

        var n = $("#" + container + " .document-form").length;

        console.log(container + 'n is - ', n);

        $.ajax({
            type: "GET",
            url: url,
            data: {
                'i': n
            },
            success: function (res) {
                $("#" + container).append(res)
            }
        })
    },
    removeFloatForm: function (aid, url) {
        $.ajax({
            type: 'GET',
            url: url,
            data: {'aid': aid},
            success: function (data) {
                if (data == 1) {
                    $("#" + 'observation_' + aid).remove();
                }
            }
        });
    },

    removeBlankFloatForm: function (id) {
        if (id == '0') {
            alert('You Must have at least one blank product form.');
            return false;
        } else {
            $("#" + id).remove();
        }

    },
};