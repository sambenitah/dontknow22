$(document).ready(function () {

    var $search = $('.fa-search');

    if ($search.length) {
        var $boxSearch = $('.box-search');

        $search.on('click', function () {

            $boxSearch.addClass('active');
            $('.search-field').focus();

        });

        $('.kd-close').on('click', function () {
            $boxSearch.removeClass('active');
        });

        $(document).on('keydown', function (event) {

            if (event.keyCode === 27) {

                $boxSearch.removeClass('active');
            }
        });

    }

    var $header = $('.header');
    var $btnMenu = $('.menu-mobile');
    var   $hideMenu = $('.hide-menu');

    $btnMenu.on('click', function () {
        $header.toggleClass('active');

        if ($header.hasClass('active')) {
            $hideMenu.addClass('active');
        }
        else {
            $hideMenu.removeClass('active');
        }
    });
    $hideMenu.on('click', function () {
        $header.removeClass('active');
        $hideMenu.removeClass('active');
    });





});
