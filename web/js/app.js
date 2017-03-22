$(document).ready(function () {
    'use strict';

    /* ajax modal (you need this only for the "add new" feature. See README) */
    $('body').on('click', 'a.ajax-modal', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.get(url, function (data) {
            $(data).modal();
        });
    });

    /* form modal to insert a new Author (you need this onlu for the "add new" feature. See README) */
    var modalForm = function (prefix) {
        $('body').on('submit', '.modal form', function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            var data = $(this).serialize();
            var $modal = $(this).parents('.modal');

            $modal.on('hidden.bs.modal', function () {
                $(this).data('bs.modal', null);
            });

            $.ajax({
                url: url,
                method: method,
                data: data
            }).done(function (res) {    // res can be a JSON object or an HTML string
                if (typeof res === 'object') {
                    // if it'a a JSON, form is valid
                    $modal.modal('hide');
                    var $input = $('#' + prefix + '_' + res.type);
                    $input.val(res.id).trigger('change');
                    // this workaround is needed because we can't set a val() to a non-existant option
                    $('.select2-chosen').each(function () {
                        if ($(this).parents('div').attr('id').indexOf(prefix + '_' + res.type) > -1) {
                            $(this).text(res.name);
                        }
                    });
                } else {
                    // if is HTML, form is invalid (has errors)
                    $modal.modal('hide');
                    $(res).modal();
                }
            });
        });
    };

    /* autocomplete Author on new Book (this is the main feature) */
    (function () {
        var options = {
            url_list: $('#url-list').attr('href'),
            url_get: $('#url-get').attr('href'),
            otherOptions: {
                theme: "bootstrap",
                minimumInputLength: 1,
                formatNoMatches: 'No author found.',
                formatSearching: 'Searching authors...',
                formatInputTooShort: 'Insert at least 1 character.'
            }
        };

        $('#book_author').autocompleter(options);

        var tags = $('#book_tags');

        tags.autocompleter({
            url_list: $('#url-list-tag').attr('href'),
            url_get: $('#url-get-tag').attr('href'),
            otherOptions: {
                theme: "bootstrap",
                minimumInputLength: 1,
                formatNoMatches: 'No tags found.',
                formatSearching: 'Searching tags...',
                formatInputTooShort: 'Insert at least 1 character.'
            }
        });

        // following lines are only for "add new" feature. See README.
        modalForm('book');
        var $addNew = $('<a>')
                .text('insert new')
                .attr('class', 'btn btn-xs btn-success ajax-modal')
                .attr('href', $('#url-new').attr('href'))
            ;
        $('label[for="book_author"]').after($addNew).after(' ');

    }());
});
