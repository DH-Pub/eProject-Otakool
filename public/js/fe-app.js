$(function () {
    // prevent scroll on input number
    $('form').on('focus', 'input[type=number]', function (e) {
        $(this).on('wheel.disableScroll', function (e) {
            e.preventDefault()
        })
    })
    $('form').on('blur', 'input[type=number]', function (e) {
        $(this).off('wheel.disableScroll')
    })

    // Navbar scroll
    const headerSpace = $('#header-title').height();
    $(window).scroll(function () {
        if ($(window).scrollTop() > headerSpace) {
            $('#navbar-scroll').css({
                'position': 'fixed',
            });
            $('#navbar-scroll').addClass('navbar-fixed');
        } else {
            $('#navbar-scroll').css({
                'position': 'absolute',
            });
            $('#navbar-scroll').removeClass('navbar-fixed');
        }
    })
    // When click on href="#id"
    const navbarSpace = $('#navbar-scroll').height();
    $('html').get(0).style.setProperty(
        '--scroll-padding', navbarSpace + 10 + 'px'
    );

    //feedback
    $("#feedback-tab").click(function () {
        $("#feedback-form").toggle("slide");
    });
    $("#feedback-form form").on('submit', function () {
        // alert("Thank you for your feedback!");
        $("#feedback-form").toggle("slide");
    });

    // Product display
    var divthumb = $('.product-thumbnail');
    divthumb.height(divthumb.width());
    // Cart display
    var divcart = $('.cart-img');
    divcart.height(divcart.width());
    // Nav padding
    var navPadding = $('#nav-padding');
    navPadding.height($('#navbar-scroll').height());
    // Responsive
    $(window).resize(function () {
        var divthumb = $('.product-thumbnail');
        divthumb.height(divthumb.width());
        var divcart = $('.cart-img');
        divcart.height(divcart.width());
        var navPadding = $('#nav-padding');
        navPadding.height($('#navbar-scroll').height());
    })

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 500);
        return false;
    });
});
