var billboard_current_image;
var billboard_total_images = 0;
var preBoard = 'caroussel--billboard_';
var space_between = 10;
var board_to_display = 3;


$(document).ready(
    function() {
        makeBillboard($('#' + preBoard));
    });

$(window).resize(
    function() {
        $('.' + preBoard + ' .slide').css('height', $('.' + preBoard + ' .slider').height() + 'px');
        $('.' + preBoard + ' .slide').css('width', ($('.' + preBoard + ' .slider').width() / board_to_display) - 2 * space_between + 'px');
    });



function makeBillboard(elem) {
    // Créer le slider (contenant)


    elem.before('<div class="' + preBoard + ' row"></div>');

    // Ajout des boutons de nav

    $('.' + preBoard).append('<nav class="nav_LR row"></nav>');

    $('.' + preBoard + ' .nav_LR').append('<button onclick="prevBoard();resetIntervalBillboard()" class="btn btn--prev"></button>');

    $('.' + preBoard + ' .nav_LR').append('<div class="slider row"></div>');

    $('.' + preBoard + ' .nav_LR').append('<button onclick="nextBoard();resetIntervalBillboard()" class="btn btn--next"></button>');

    // Créer le container de slides
    var billboard_slides_container = $('<div class="slides-container row" />');

    elem.children('img').each(function() {
        var src = $(this).attr('src');
        var slide = $('<img class="slide">').attr('src', src);
        slide.css('height', $('.' + preBoard + ' .slider').height() + 'px');
        slide.css('margin', space_between);
        slide.css('width', ($('.' + preBoard + ' .slider').width() / board_to_display) - 2 * space_between + 'px');
        billboard_slides_container.append(slide);

        // ajout au nombre totla d'images
        billboard_total_images++;
        console.log("totale image: " + billboard_total_images);
    })

    // Ajouter le slide-container au slider
    $('.' + preBoard + ' .slider').append(billboard_slides_container);

    // Supprimer l'élément cible
    elem.remove();


    //ajouter un bouton de détail
    // $('.' + preBoard + ' .slider').append('<button class="button draw">Details</button>');
    // $('.' + preBoard + ' .slider .draw').css({ 'left': 0, 'position': 'absolute', 'bottom': 0 });

    //ajouter une navigation secondaire
    $('.' + preBoard + ' .slider ').append('<nav class="nav_slider row"> <ol></ol></nav>');
    $('.' + preBoard + ' .nav_slider').css('bottom', 0);

    var billboard_index_image = 0;
    //console.log(billboard_index_image);

    for (i = 0; i < billboard_total_images; i++) {
        //console.log(index_image);
        $('.' + preBoard + ' .nav_slider ol').append('<li> <a class="puce_nav puce_nav--unselected" name="' + billboard_index_image + '" onclick="slideToboard(this.name) "> </a> </li>');
        billboard_index_image++;
    }

    // Attribution de la valeur 0 à l'index de l'image en cours

    billboard_current_image = 0;
    select_puce_billboard(billboard_current_image);

}

function nextBoard() {
    unselect_puce_billboard(billboard_current_image);
    billboard_current_image++;
    console.log('nextBoard current image: ' + billboard_current_image)
    slideBoard();
}

function prevBoard() {

    if (billboard_current_image == 0) {
        disabled_prev();
    } else {
        unselect_puce_billboard(billboard_current_image);
        billboard_current_image--;
        slideBoard();
    }

}

function slideBoard() {

    disableNavBillboard();
    // cas où on depasse la derniere image
    if (billboard_current_image == billboard_total_images) {

        console.log('nextBoard current image: ' + billboard_current_image + 'billboard_total_images: ' + billboard_total_images);
        var billboard_slide_temp = $($('.' + preBoard + ' .slide')[0]).clone();

        billboard_slide_temp.attr('id', 'temp');
        $('.' + preBoard + ' .slides-container').append(billboard_slide_temp);

        // Ecouter la fin de la transition
        $('.' + preBoard + ' .slides-container').on('transitionend', function() {

            // Supprimer l'écouteur d'événement
            $('.' + preBoard + ' .slides-container').off();

            // remmettre les slides en position d'origine
            $('.' + preBoard + ' .slides-container').css('transition', 'none');
            $('.' + preBoard + ' .slides-container').css('left', 0);

            // une fois le slider remis en position initiale, remettre la transition
            // Timeout de 10 ms avant de remettre la transition
            setTimeout(function() {
                $('.' + preBoard + ' .slides-container').css('transition', 'all 1s');
                // rétablir la nav
                enableNavBillboard();
            }, 10);

            billboard_current_image = 0;
            billboard_slide_temp.remove();
        })

    }

    // Cas ou on précède la premiere image
    if (billboard_current_image <= -1) {
        console.log(billboard_current_image);

        var billboard_slide_temp = $($('.' + preBoard + ' .slide')[$('.' + preBoard + ' .slide').length + billboard_current_image - 1]).clone();

        billboard_slide_temp.css({
            "position": "absolute",
            "top": "0",
            "left": $('.' + preBoard + ' .slider').width() * (-1) + "px"
        })

        // alert('prepend');
        $('.' + preBoard + ' .slides-container').prepend(billboard_slide_temp);

        if (current_image = -board_to_display) {

            // Ecouter la fin de la transition
            $('.' + preBoard + ' .slides-container').on('transitionend', function() {

                // Supprimer l'écouteur d'événement
                $('.' + preBoard + ' .slides-container').off();

                // supprimer la transition
                $('.' + preBoard + ' .slides-container').css('transition', 'none');
                // remmettre les slides en position de fin (sur la dernière slide);
                $('.' + preBoard + ' .slides-container').css('left', ((billboard_total_images - 1) * $('.' + preBoard + ' .slider').width()) * (-1) + 'px');

                // Timeout de 10 ms avant de remettre la transition
                setTimeout(function() {
                    $('.' + preBoard + ' .slides-container').css('transition', 'all 1s');
                    // rétablir la nav
                    enableNavBillboard();
                }, 10);



                billboard_slide_temp.remove();
                billboard_current_image = billboard_total_images - 1;

            });

        }
    }

    var billboard_offset = billboard_current_image * ($('.' + preBoard + ' .slide').width() + 2 * space_between);
    $('.' + preBoard + ' .slides-container').css('left', (-1 * billboard_offset) + 'px');
    $('.' + preBoard + ' .slides-container').on('transitionend', function() {
        $('.' + preBoard + ' .slides-container').off();
        enableNavBillboard();
    })

    console.log("current image: " + billboard_current_image);
    select_puce_billboard(billboard_current_image);

}

function disableNavBillboard() {
    $('.' + preBoard + ' .nav_LR').addClass('disabled');
}

function enableNavBillboard() {
    $('.' + preBoard + ' .nav_LR').removeClass('disabled');
}

// Lecture automatique
var billboardInterval = setInterval(
    function() {
        nextBoard();
    }, 3000);

function resetIntervalBillboard() {
    clearInterval(billboardInterval);
    billboardInterval = setInterval(function() {
        nextBoard();
    }, 3000);
}

function slideToboard(move_to_image) {


    // remmettre les slides en position d'origine
    $('.' + preBoard + ' .slides-container').css('transition', 'none');


    unselect_puce_billboard(billboard_current_image);
    billboard_current_image = move_to_image;
    select_puce_billboard(billboard_current_image);


    // une fois le slider remis en position initiale, remettre la transition
    // Timeout de 10 ms avant de remettre la transition
    setTimeout(function() {
        $('.' + preBoard + ' .slides-container').css('transition', 'all 1s');
        // rétablir la nav
        enableNavBillboard();
    }, 10);



    $('.' + preBoard + ' .slides-container').css('transition', 'none');

    billboard_offset = move_to_image * ($('.' + preBoard + ' .slide').width() + 2 * space_between);

    $('.' + preBoard + ' .slides-container').css('left', (-1 * billboard_offset) + 'px');
    $('.' + preBoard + ' .slides-container').on('transitionend', function() {
        $('.' + preBoard + ' .slides-container').off();
    })


    setTimeout(function() {
        $('.' + preBoard + ' .slides-container').css('transition', 'all 1s');
        // rétablir la nav
    }, 10);



    resetIntervalBillboard();
}

function select_puce_billboard(slide) {
    billboard_current_image_to = parseInt(slide) + 1;
    // // console.log('select: ' + billboard_current_image);
    // console.log('select: ' + billboard_current_image_to);
    $('.' + preBoard + ' .nav_slider ol li:nth-child(' + billboard_current_image_to + ') a').removeClass('puce_nav--unselected');
    $('.' + preBoard + ' .nav_slider ol li:nth-child(' + billboard_current_image_to + ') a').addClass('puce_nav--selected');

}

function unselect_puce_billboard(slide) {
    billboard_current_image_to = parseInt(slide) + 1;
    // // console.log('unselect: ' + billboard_current_image);
    // console.log('unselect: ' + billboard_current_image_to);
    $('.' + preBoard + ' .nav_slider ol li:nth-child(' + billboard_current_image_to + ') a').removeClass('puce_nav--selected');
    $('.' + preBoard + ' .nav_slider ol li:nth-child(' + billboard_current_image_to + ') a').addClass('puce_nav--unselected');

}

function disablePrev() {
    $('.' + preBoard + ' .btn--prev').addClass('disabled');
}

function enablePrev() {
    $('.' + preBoard + ' .btn--prev').removeClass('disabled');
}