jQuery( document ).ready( function( $ ) {
    var $wrapper = $('.wrapper');
    var $terms = $('<ul></ul>')
        .addClass('terms');
    var $posts = $('.posts');

    function populateTerms() {

    }

    function init() {
        $wrapper.prepend($terms)
    }

    init();

    var $masonryWrapper = $('.posts');

});