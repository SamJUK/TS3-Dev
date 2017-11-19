@push('content')
    <div class="panel panel-default list-channels">
        <div class="panel-heading">
            <div class="pull-left">
                List Channels
            </div>
            <div class="pull-right">
                <a class="refresh">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="561px" height="561px" viewBox="0 0 561 561" style="enable-background:new 0 0 561 561;" xml:space="preserve"><g><g id="loop"><path d="M280.5,76.5V0l-102,102l102,102v-76.5c84.15,0,153,68.85,153,153c0,25.5-7.65,51-17.85,71.4l38.25,38.25 C471.75,357,484.5,321.3,484.5,280.5C484.5,168.3,392.7,76.5,280.5,76.5z M280.5,433.5c-84.15,0-153-68.85-153-153 c0-25.5,7.65-51,17.85-71.4l-38.25-38.25C89.25,204,76.5,239.7,76.5,280.5c0,112.2,91.8,204,204,204V561l102-102l-102-102V433.5z"/></g></g></svg>
                    <span>Refresh</span>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <div class="loading loading_spinner">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="561px" height="561px" viewBox="0 0 561 561" style="enable-background:new 0 0 561 561;" xml:space="preserve"><g><g id="loop"><path d="M280.5,76.5V0l-102,102l102,102v-76.5c84.15,0,153,68.85,153,153c0,25.5-7.65,51-17.85,71.4l38.25,38.25 C471.75,357,484.5,321.3,484.5,280.5C484.5,168.3,392.7,76.5,280.5,76.5z M280.5,433.5c-84.15,0-153-68.85-153-153 c0-25.5,7.65-51,17.85-71.4l-38.25-38.25C89.25,204,76.5,239.7,76.5,280.5c0,112.2,91.8,204,204,204V561l102-102l-102-102V433.5z"/></g></g></svg>
                <span>Loading...</span>
            </div>
            <div class="table-container">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">CID</th>
                        <th scope="col">PID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Clients</th>
                        <th scope="col">Order</th>
                        <th scope="col">Sub Power</th>
                    </tr>
                    </thead>
                    <tbody class="channelsList">
                    @foreach($channels['data'] as $channel)
                        <tr class='channel' title="View Channel">
                            <td class="cid">{{ $channel['cid'] }}</td>
                            <td class="pid">{{ $channel['pid'] }}</td>
                            <td class="channel_name">{{ $channel['channel_name'] }}</td>
                            <td class="total_clients">{{ $channel['total_clients'] }}</td>
                            <td class="channel_order">{{ $channel['channel_order'] }}</td>
                            <td class="channel_needed_subscribe_power">{{ $channel['channel_needed_subscribe_power'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="actionChannelModel" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Channel Name</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="actionUsername">Channel</label>
                                <input type="text" class="form-control" id="channelName" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="actionUsername">Description</label>
                                <input type="text" class="form-control" id="description" value="" disabled>
                            </div>
                            <div class="form-group">
                                <div class="pull-left">
                                    <input type="checkbox" id="passwordCB" disabled/>
                                    <label for="passwordCB">Password</label>
                                </div>
                                <div class="pull-right">
                                    <input type="checkbox" id="showPasswordCB"/>
                                    <label for="showPasswordCB">Show Password</label>
                                </div>
                                <input type="password" class="form-control" id="password" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="actionUsername">Max Clients</label>
                                <input type="number" class="form-control" id="max_clients" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="actionUsername">Needed Talk Power</label>
                                <input type="number" class="form-control" id="needed_talkpower" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="actionUsername">Order</label>
                                <input type="number" class="form-control" id="order" value="" disabled>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning cta-btn-edit" data-mode="view">Edit Channel</button>
                        <button type="button" class="btn btn-danger cta-btn" data-dismiss="modal">Delete Channel</button>
                        <button type="button" class="btn btn-success cta-btn-save" data-dismiss="modal" style="display: none">Save Channel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endpush
@push('js')
    <script>
        function showModal(data){
            var modal = $('#actionChannelModel');
            var name = data['data']['channel_name'];
            var desc = data['data']['channel_description'];
            var pwd = data['data']['channel_password'];
            var haspwd = data['data']['channel_flag_password'];
            var maxClients = data['data']['channel_maxclients'];
            var order = data['data']['channel_order'];
            var neededTP = data['data']['channel_needed_talk_power'];
            var maxClientsString = maxClients;

            if(maxClients === '-1'){
                $('#max_clients').attr('type', 'text');
                maxClientsString = 'Unlimited';
            }else{
                $('#max_clients').attr('type', 'number');
                maxClientsString = maxClients;
            }

            $('#showPasswordCB').prop('checked', false);
            $('#password').attr('type','password');


            modal.find('.modal-title').text(name).attr('data-default', name);
            modal.find('#channelName').val(name).attr('data-default', name);
            modal.find('#description').val(desc).attr('data-default', desc);
            modal.find('#password').val(pwd).attr('data-default', pwd);
            modal.find('#passwordCB').prop('checked', parseInt(haspwd)).attr('data-default', haspwd);
            modal.find('#max_clients').val(maxClientsString).attr('data-default', maxClientsString);
            modal.find('#order').val(order).attr('data-default', order);
            modal.find('#needed_talkpower').val(neededTP).attr('data-default', neededTP);

            modal.modal();
        }
        function editModal(bool){
            var fields = [
                "channelName",
                "description",
                "password",
                "passwordCB",
                "max_clients",
                "needed_talkpower",
                "order"
            ];

            for(var i=0;i<fields.length;i++){
             $('#' + fields[i]).prop('disabled', bool);
            }
        }
        function startEdit(elm){
            editModal(false);
            elm.attr('data-mode', 'edit');
            elm.text('Cancel Edit');
            $('.cta-btn').hide();
            $('.cta-btn-save').show();
        }
        function cancelEdit(elm){
            editModal(true);
            elm.attr('data-mode', 'view');
            elm.text('Edit Channel');
            $('.cta-btn').show();
            $('.cta-btn-save').hide();
        }
        function saveEdit(){
            var params = {};
            var cid = $('#actionChannelModel').find('.modal-footer').attr('data-cid');
            var fields = [
                "channelName",
                "description",
                "password",
                "max_clients",
                "needed_talkpower",
                "order"
            ];

            for(var i=0;i<fields.length;i++){
                var field = $('#'+fields[i]);
                if(field.val() !== field.attr('data-default')){
                    params[fields[i]] = field.val();
                }
            }

            $.ajax('/api/updateChannel/' + cid,{
                success: function(data){
                    alerts.createAlert('success', 'Channel successfully edited! 🐶', true, 5);
                    refreshChannels();
                    console.log(data);
                },
                error: function(){
                    alerts.createAlert('danger', 'Error editing channel! 😱', true, 5);
                    console.error('😲 An Error Has Occurred!');
                },
                data: {
                    'params' : params
                }
            });

        }
        function setupChannelEventHandlers(){
            $('.channel').click(function () {
                // Make Ajax Request for detail Info
                var id = $(this).find('.cid').text();
                $('.modal-footer').attr('data-cid', id);
                $.ajax('/api/getChannelInfo/' + id, {
                    success: function(data){
                        showModal(data);
                    },
                    error: function(data){
                        alerts.createAlert('danger', 'Error occurred getting channel data');
                        console.error('An Error Has Arrived 😯');
                    }
                });

            });
        }
        function refreshChannels(){
            jQuery.ajax('/api/listChannelsHTML', {
                success: function(data){
                    // Update Table
                    jQuery('.channelsList').html(data);

                    setupChannelEventHandlers();
                },
                error: function(data){
                    console.error('😲 An Error Has Occured!');
                    console.log(data);
                }
            });
        }

        $(document).ready(function() {
            setupChannelEventHandlers();

            $('#showPasswordCB').change(function(){
                if($(this).prop('checked'))
                    $('#password').attr('type','text');
                else
                    $('#password').attr('type','password');
            })
            $('.cta-btn-edit').click(function(){
                if($(this).attr('data-mode') === 'view'){
                    startEdit($(this));
                }else{
                    cancelEdit($(this));
                }
            });

            $('.cta-btn').click(function(){
                $.ajax('/api/deleteChannel/' + $(this).parent().attr('data-cid'),{
                    success: function(){
                        alerts.createAlert('success', 'Channel successfully deleted! 😇', true, 5);
                        refreshChannels();
                    },
                    error: function(){
                        alerts.createAlert('danger', 'Error deleting channel!', true, 5)
                        console.error('An error has encroached upon us! 💩');
                    }
                })
            });
            $('.cta-btn-save').click(function(){
                saveEdit();
            });
        });
    </script>
@endpush