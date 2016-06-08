$(document).ready(function () {
    'use strict';

    /* autocomplete Author on new Book */
    (function () {
        var options = {
            url_list: $('#url-list').attr('href'),
            url_get: $('#url-get').attr('href'),
            otherOptions: {
                minimumInputLength: 1,
                formatNoMatches: 'No author found.',
                formatSearching: 'Searchin authors...',
                formatInputTooShort: 'Insert at least 1 character'
            }
        };
        $('#book_author').autocompleter(options);
    }());
});
