@push('content')
    <div class="panel panel-default mass-message">
        <div class="panel-heading">🦌 Mass Message</div>
        <div class="panel-body">
            <input type="text" class="form-control" id="mass_message_input"/>
            <a id='mass_message_btn' href="#" class="btn btn-default btn-success">Send</a>
        </div>
    </div>
@endpush

@push('js')
    <script>
        jQuery(document).ready(function(){
            jQuery('#mass_message_btn').click(function(){
                var message = jQuery('#mass_message_input').val();
                jQuery.ajax('/api/massMessage/' + message, {
                    success: function(data){
                        // Clear Input Field
                        $('#mass_message_input').val('');

                        // Display Message
                        alerts.createAlert('success', 'Server Message Sent!', true, 5);
                    },
                    error: function(e){
                        console.error('An Error Occured!');
                    }
                });
            });
        });
    </script>
@endpush