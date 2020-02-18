$(document).ready(
    function() {
        makeSlider($('#' + prefix));
    });

var current_image;
var total_images = 0;
var prefix = 'caroussel--full--arrow_';


function makeSlider(elem) {
    // Créer le slider (contenant)
    elem.before('<div class="' + prefix + 'slider row"></div>');


    // Créer le container de slides
    var slides_container = $('<div class="' + prefix + 'slides-container row" />');
    elem.children('img').each(function() {
        var src = $(this).attr('src');
        var slide = $('<img class="' + prefix + 'slide">').attr('src', src);
        slide.css('height', $('.' + prefix + 'slider').height() + 'px');
        slide.css('width', $('.' + prefix + 'slider').width() + 'px');
        slides_container.append(slide);

        // ajout au nombre totla d'images
        total_images++;
    })

    // Ajouter le slide-container au slider
    $('.' + prefix + 'slider').append(slides_container);

    // Supprimer l'élément cible
    elem.remove();

    // Ajout des boutons de nav
    $('.' + prefix + 'slider').append('<nav></nav>');

    $('.' + prefix + 'slider nav').append('<button onclick="prev();resetInterval()" class="btn btn--prev"></button>');
    $('.' + prefix + 'slider nav').append('<button onclick="next();resetInterval()" class="btn btn--next"></button>');

    //ajouter un bouton de détail
    $('.' + prefix + 'slider').append('<button class="button draw">Details</button>');
    $('.' + prefix + 'slider .draw').css({ 'left': 0, 'position': 'absolute', 'bottom': 0 });

    //ajouter une navigation secondaire
    $('.' + prefix + 'slider nav').append('<nav class="' + prefix + 'nav_slider row"> <ol></ol></nav>');
    $('.' + prefix + 'nav_slider').css('bottom', 0);

    var index_image = 0;
    $('.' + prefix + 'slides-container .' + prefix + 'slide').each(function() {
        $('.' + prefix + 'nav_slider ol').append('<li> <a class="puce_nav puce_nav--unselected" name="' + index_image + '" onclick="slideTo(this.name) "> </a> </li>');
        index_image++;
    })

    // Attribution de la valeur 0 à l'index de l'image en cours
    current_image = 0;
    select_puce(current_image);
}

function next() {
    unselect_puce(current_image);
    current_image++;
    slide();
}

function prev() {
    unselect_puce(current_image);
    current_image--;
    slide();
}

function slide() {
    disableNav();
    // cas où on depasse la derniere image
    if (current_image == total_images) {
        var slide_temp = $($('.' + prefix + 'slide')[0]).clone();
        slide_temp.attr('id', 'temp');
        $('.' + prefix + 'slides-container').append(slide_temp);
        // Ecouter la fin de la transition
        $('.' + prefix + 'slides-container').on('transitionend', function() {

            // Supprimer l'écouteur d'événement
            $('.' + prefix + 'slides-container').off();

            // remmettre les slides en position d'origine
            $('.' + prefix + 'slides-container').css('transition', 'none');
            $('.' + prefix + 'slides-container').css('left', 0);

            // une fois le slider remis en position initiale, remettre la transition
            // Timeout de 10 ms avant de remettre la transition
            setTimeout(function() {
                $('.' + prefix + 'slides-container').css('transition', 'all 1s');
                // rétablir la nav
                enableNav();
            }, 10);

            current_image = 0;
            slide_temp.remove();
        })
    }

    // Cas ou on précède la premiere image
    if (current_image == -1) {
        var slide_temp = $($('.' + prefix + 'slide')[$('.' + prefix + 'slide').length - 1]).clone();

        slide_temp.css({
            "position": "absolute",
            "top": "0",
            "left": $('.' + prefix + 'slider').width() * (-1) + "px"
        })

        $('.' + prefix + 'slides-container').prepend(slide_temp);
        // Ecouter la fin de la transition
        $('.' + prefix + 'slides-container').on('transitionend', function() {

            // Supprimer l'écouteur d'événement
            $('.' + prefix + 'slides-container').off();

            // supprimer la transition
            $('.' + prefix + 'slides-container').css('transition', 'none');
            // remmettre les slides en position de fin (sur la dernière slide);
            $('.' + prefix + 'slides-container').css('left', ((total_images - 1) * $('.' + prefix + 'slider').width()) * (-1) + 'px');

            // Timeout de 10 ms avant de remettre la transition
            setTimeout(function() {
                $('.' + prefix + 'slides-container').css('transition', 'all 1s');
                // rétablir la nav
                enableNav();
            }, 10);

            current_image = total_images - 1;
            slide_temp.remove();
        });
    }

    var offset = current_image * $('.' + prefix + 'slider').width();
    $('.' + prefix + 'slides-container').css('left', (-1 * offset) + 'px');
    $('.' + prefix + 'slides-container').on('transitionend', function() {
        $('.' + prefix + 'slides-container').off();
        enableNav();
    })

    select_puce(current_image);

}

function disableNav() {
    $('.' + prefix + 'slider>nav').addClass('disabled');
}

function enableNav() {
    $('.' + prefix + 'slider>nav').removeClass('disabled');
}

// Lecture automatique
var interval = setInterval(
    function() {
        next();
    }, 3000);

function resetInterval() {
    clearInterval(interval);
    interval = setInterval(function() {
        next();
    }, 3000);
}

function slideTo(move_to_image) {

    //alert(move_to_image);

    //console.log(move_to_image);
    unselect_puce(current_image);

    select_puce(move_to_image);

    $('.' + prefix + 'slides-container').css('transition', 'none');
    // $(this).addClass('selected');
    // $(this).css('background-color','#000');
    //$('.nav_slider ol a').css('background-color', '#000');

    //$('.ol:nth-child(' + move_to_image + ') a').addClass('selected');
    // $('ol:nth-child(' + move_to_image + 'n)').children('a').css('background-color', '#000');
    var offset = move_to_image * $('.' + prefix + 'slider').width();
    $('.' + prefix + 'slides-container').css('left', (-1 * offset) + 'px');
    $('.' + prefix + 'slides-container').on('transitionend', function() {
        $('.' + prefix + 'slides-container').off();
    })


    setTimeout(function() {
        $('.' + prefix + 'slides-container').css('transition', 'all 1s');
        // rétablir la nav
    }, 10);

    current_image = move_to_image;

    resetInterval();
}

function select_puce(slide) {

    current_slide = parseInt(slide) + 1;
    $('.' + prefix + 'nav_slider ol li:nth-child(' + current_slide + ') a').removeClass('puce_nav--unselected');
    $('.' + prefix + 'nav_slider ol li:nth-child(' + current_slide + ') a').addClass('puce_nav--selected');

}

function unselect_puce(slide) {
    current_slide = parseInt(slide) + 1;
    $('.' + prefix + 'nav_slider ol li:nth-child(' + current_slide + ') a').removeClass('puce_nav--selected');
    $('.' + prefix + 'nav_slider ol li:nth-child(' + current_slide + ') a').addClass('puce_nav--unselected');

}