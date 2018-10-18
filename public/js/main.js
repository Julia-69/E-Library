jQuery(document).ready(function ($) {
    $('#saveBook').on('click', function() {
        var $alert = $('#libraryBookModal .alert').addClass('hidden');

        $.post('?route=book.save', $('#bookForm').serialize(), function(data) {
            if (data.success) {
                if ($('#booksList').size()) {
                    $('#libraryBookModal').modal('hide');
                    $('#bookForm')[0].reset();
                    refreshBooks();
                } else {
                    window.location.reload();
                }
            } else {
                if (data.messages) {
                    $alert.html(data.messages.join('<br />'))
                        .removeClass('hidden');
                }
            }
        }, 'json');
    });

    $('#removeBook').on('click', function() {
        $.post('?route=book.remove', {id : $(this).data('id')}, function(data) {
            if (data.success) {
                window.location.href = '/';
            }
        }, 'json');
    });
});

function refreshBooks()
{
    var params = {
        'genre': $('.panel-group.genres .active').data('id'),
        'author': $('.panel-group.authors .active').data('id')
    };

    $.post('?route=book.load', params, function(html) {
        if (html) {
            $('#booksList').html(html);
        }
    });
}
