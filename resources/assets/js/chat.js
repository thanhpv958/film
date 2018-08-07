var chat = function () {
    this.init = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('body').on('submit', '#form-message', function (event) {
            event.preventDefault();
            var message = $('#message-content').val();
            current.addMessage(message);
        });

    }

    this.addMessage = function(message) {
        $.ajax({
            url: '/messages',
            type: 'POST',
            data: {
                message: message
            },
            dataType: 'JSON',
            success: function(result) {
                location.reload();
            }

        });
    }
}
