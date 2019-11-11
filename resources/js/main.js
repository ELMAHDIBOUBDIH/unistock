function btnDelete(selector, formSelector, url) {
    $(selector).click(function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        $(formSelector + " form").attr("action", url + id);

        $(formSelector).modal('show');
    });
}
function btnActivate() {
    $(".btn_activate").click(function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajax({//create an ajax request to load_page.php
            type: "GET",
            url: "/admin/socialmedias/activate/" + id,
            dataType: "json", //expect html to be returned
            success: function (response) {
                $("#activation-" + id).html(response.html);
                btnDeactivate();
            }
        });
    });
}
function btnDeactivate() {
    $(".btn_deactivate").click(function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajax({//create an ajax request to load_page.php
            type: "GET",
            url: "/admin/socialmedias/deactivate/" + id,
            dataType: "json", //expect html to be returned
            success: function (response) {
                $("#activation-" + id).html(response.html);
                btnActivate();
            }
        });
    });
}
function btnSticky() {
    $(".btn_sticky").click(function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajax({//create an ajax request to load_page.php
            type: "GET",
            url: "/admin/socialmedias/sticky/" + id,
            dataType: "json", //expect html to be returned
            success: function (response) {
                $("#sticky-" + id).html(response.html);
                btnDesticky();
            }
        });
    });
}
function btnDesticky() {
    $(".btn_desticky").click(function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajax({//create an ajax request to load_page.php
            type: "GET",
            url: "/admin/socialmedias/desticky/" + id,
            dataType: "json", //expect html to be returned
            success: function (response) {
                $("#sticky-" + id).html(response.html);
                btnSticky();
            }
        });
    });
}
function btnPromote() {
    $(".btn_promote").click(function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajax({//create an ajax request to load_page.php
            type: "GET",
            url: "/admin/socialmedias/promote/" + id,
            dataType: "json", //expect html to be returned
            success: function (response) {
                $("#promote-" + id).html(response.html);
                btnDepromote();
            }
        });
    });
}
function btnDepromote() {
    $(".btn_depromote").click(function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajax({//create an ajax request to load_page.php
            type: "GET",
            url: "/admin/socialmedias/depromote/" + id,
            dataType: "json", //expect html to be returned
            success: function (response) {
                $("#promote-" + id).html(response.html);
                btnPromote();
            }
        });
    });
}