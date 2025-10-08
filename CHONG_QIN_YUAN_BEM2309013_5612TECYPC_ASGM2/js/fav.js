$(document).ready(function () {
    $('.love-icon').click(function (e) {
        e.preventDefault();

        const button = $(this);
        const itemId = button.data('item-id');
        const isFavorite = button.hasClass('favorited');

        // Send data to server
        $.ajax({
            url: 'favtest.php',
            method: 'POST',
            data: {
                action: isFavorite ? 'remove' : 'add',
                item_id: itemId
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    if (isFavorite) {
                        // Remove the favorited class and update the icon to white
                        button.removeClass('favorited');
                        button.html('🤍');

                        // If on the favorite page, remove the phone card
                        const phoneCard = $(`#phone-${itemId}`);
                        if (phoneCard.length) {
                            phoneCard.remove();

                            // Check if there are no more favorite phones
                            if ($('.love-icon.favorited').length === 0) {
                                $('.row').html('<div class="alert alert-warning text-center">You have not added any favorite phones yet.</div>');
                            }
                        }
                    } else {
                        // Add the favorited class and update the icon to red
                        button.addClass('favorited');
                        button.html('❤️');
                    }
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function () {
                alert('Server error occurred');
            }
        });
    });
});