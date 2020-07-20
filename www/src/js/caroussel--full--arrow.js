var current_image;
var total_images = 0;
var preFull = 'caroussel--full--arrow_';

$(document).ready(
    function() {
        makeSlider($('#' + preFull));
    });

$(window).resize(
    function() {
        $('.' + preFull + ' .slide').css('height', $('.' + preFull + ' .slider').height() + 'px');
        $('.' + preFull + ' .slide').css('width', $('.' + preFull + ' .slider').width() + 'px');
    });


function makeSlider(elem) {
    // Créer le slider (contenant)

    elem.before('<div class="' + preFull + ' row"></div>');

    $('.' + preFull).append('<div class="slider row"></div>');


    // Créer le container de slides
    var slides_container = $('<div class="slides-container row" />');
    elem.children('img').each(function() {
        var src = $(this).attr('src');
        var href = $(this).attr('href');
        var slide = $('<img class="slide">').attr({'src':src, 'href':href});
        slide.css('height', $('.' + preFull + ' .slider').height() + 'px');
        slide.css('width', $('.' + preFull + ' .slider').width() + 'px');
        slides_container.append(slide);

        // ajout au nombre totla d'images
        total_images++;
    })

    // Ajouter le slide-container au slider
    $('.' + preFull + ' .slider').append(slides_container);

    // Supprimer l'élément cible
    elem.remove();

    // Ajout des boutons de nav
    $('.' + preFull + ' .slider').append('<nav class="nav_LR"></nav>');

    $('.' + preFull + ' .slider nav').append('<button onclick="prev();resetInterval()" class="btn btn--prev"></button>');
    $('.' + preFull + ' .slider nav').append('<button onclick="next();resetInterval()" class="btn btn--next"></button>');

    //ajouter un bouton de détail
    $('.' + preFull + ' .slider').append('<button class="button draw">Details</button>');
    $('.' + preFull + ' .slider .draw').css({ 'left': 0, 'position': 'absolute', 'bottom': 0 });

    //ajouter une navigation secondaire
    $('.' + preFull + ' .slider .nav_LR').append('<nav class="nav_slider row"> <ol></ol></nav>');
    $('.' + preFull + ' .nav_slider').css('bottom', 0);

    var index_image = 0;
    $('.' + preFull + ' .slides-container .slide').each(function() {
        $('.' + preFull + ' .nav_slider ol').append('<li> <a class="puce_nav puce_nav--unselected" name="' + index_image + '" onclick="slideTo(this.name) "> </a> </li>');
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
        console.log('nextBoard current image: ' + current_image + 'billboard_total_images: ' + total_images);
        var slide_temp = $($('.' + preFull + 'slide')[0]).clone();
        slide_temp.attr('id', 'temp');
        $('.' + preFull + ' .slides-container').append(slide_temp);
        // Ecouter la fin de la transition
        $('.' + preFull + ' .slides-container').on('transitionend', function() {

            // Supprimer l'écouteur d'événement
            $('.' + preFull + ' .slides-container').off();

            // remmettre les slides en position d'origine
            $('.' + preFull + ' .slides-container').css('transition', 'none');
            $('.' + preFull + ' .slides-container').css('left', 0);

            // une fois le slider remis en position initiale, remettre la transition
            // Timeout de 10 ms avant de remettre la transition
            setTimeout(function() {
                $('.' + preFull + ' .slides-container').css('transition', 'all 1s');
                // rétablir la nav
                enableNav();
            }, 10);


            slide_temp.remove();
        })
        current_image = 0;
    }

    // Cas ou on précède la premiere image
    if (current_image == -1) {
        var slide_temp = $($('.' + preFull + ' .slide')[$('.' + preFull + ' .slide').length - 1]).clone();

        slide_temp.css({
            "position": "absolute",
            "top": "0",
            "left": $('.' + preFull + ' .slider').width() * (-1) + "px"
        })

        $('.' + preFull + ' .slides-container').prepend(slide_temp);
        // Ecouter la fin de la transition
        $('.' + preFull + ' .slides-container').on('transitionend', function() {

            // Supprimer l'écouteur d'événement
            $('.' + preFull + ' .slides-container').off();

            // supprimer la transition
            $('.' + preFull + ' .slides-container').css('transition', 'none');
            // remmettre les slides en position de fin (sur la dernière slide);
            $('.' + preFull + ' .slides-container').css('left', ((total_images - 1) * $('.' + preFull + ' .slider').width()) * (-1) + 'px');

            // Timeout de 10 ms avant de remettre la transition
            setTimeout(function() {
                $('.' + preFull + ' .slides-container').css('transition', 'all 1s');
                // rétablir la nav
                enableNav();
            }, 10);

            current_image = total_images - 1;
            slide_temp.remove();
        });
    }

    var offset = current_image * $('.' + preFull + ' .slider').width();
    $('.' + preFull + ' .slides-container').css('left', (-1 * offset) + 'px');
    $('.' + preFull + ' .slides-container').on('transitionend', function() {
        $('.' + preFull + ' .slides-container').off();
        enableNav();
    })

    console.log("current image a: " + current_image);
    select_puce(current_image);
}

function disableNav() {
    $('.' + preFull + ' .slider .nav_LR').addClass('disabled');
}

function enableNav() {
    $('.' + preFull + ' .slider .nav_LR').removeClass('disabled');
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
    current_image = move_to_image;
    select_puce(move_to_image);

    // unselect_puce(current_image);

    // select_puce(move_to_image);

    $('.' + preFull + ' .slides-container').css('transition', 'none');
    // $(this).addClass('selected');
    // $(this).css('background-color','#000');
    //$('.nav_slider ol a').css('background-color', '#000');

    //$('.ol:nth-child(' + move_to_image + ') a').addClass('selected');
    // $('ol:nth-child(' + move_to_image + 'n)').children('a').css('background-color', '#000');
    var offset = move_to_image * $('.' + preFull + 'slider').width();
    $('.' + preFull + ' .slides-container').css('left', (-1 * offset) + 'px');
    $('.' + preFull + ' .slides-container').on('transitionend', function() {
        $('.' + preFull + ' .slides-container').off();
    })


    setTimeout(function() {
        $('.' + preFull + ' .slides-container').css('transition', 'all 1s');
        // rétablir la nav
    }, 10);

    current_image = move_to_image;

    resetInterval();
}

function select_puce(slide) {

    billboard_current_image_to = parseInt(slide) + 1;
    console.log('select: ' + billboard_current_image_to);
    $('.' + preFull + ' .nav_slider ol li:nth-child(' + billboard_current_image_to + ') a').removeClass('puce_nav--unselected');
    $('.' + preFull + ' .nav_slider ol li:nth-child(' + billboard_current_image_to + ') a').addClass('puce_nav--selected');

}

function unselect_puce(slide) {
    billboard_current_image_to = parseInt(slide) + 1;
    console.log('unselect: ' + billboard_current_image_to);
    $('.' + preFull + ' .nav_slider ol li:nth-child(' + billboard_current_image_to + ') a').removeClass('puce_nav--selected');
    $('.' + preFull + ' .nav_slider ol li:nth-child(' + billboard_current_image_to + ') a').addClass('puce_nav--unselected');

}