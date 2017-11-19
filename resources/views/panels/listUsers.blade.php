@push('content')
    <div class="panel panel-default list-users">
        <div class="panel-heading">
            <div class="pull-left">
                List Users
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
                        <th scope="col">Client ID</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Client Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="userList">
                    @foreach($clients['data'] as $client)
                        <tr class="client">
                            <th class="clid" scope="row">{{ $client['clid'] }}</th>
                            <td class="name">{{ $client['client_nickname'] }}</td>
                            <td class="type">{{ $client['client_type'] }}</td>
                            <td class="actions" data-username="{{ $client['client_nickname'] }}" data-clid="{{ $client['clid'] }}">
                                <a href="#" class="minus kick_user" title="Kick User">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 295.82 295.82" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 295.82 295.82"><g><g><path d="M147.91,0C66.124,0,0,66.124,0,147.91s66.124,147.91,147.91,147.91s147.91-66.124,147.91-147.91S229.696,0,147.91,0z     M147.91,278.419c-71.345,0-130.509-59.164-130.509-130.509S76.565,17.401,147.91,17.401S278.419,76.565,278.419,147.91    S219.255,278.419,147.91,278.419z"/><path d="m191.413,139.21h-87.006c-5.22,0-8.701,3.48-8.701,8.701 0,5.22 3.48,8.701 8.701,8.701h87.006c5.22,0 8.701-3.48 8.701-8.701 0-5.221-3.481-8.701-8.701-8.701z"/></g></g> </svg>
                                </a>
                                <a href="#" class="cross ban_user" title="Ban User">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><g><path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256S397.385,0,256,0z M256,480 C132.288,480,32,379.712,32,256S132.288,32,256,32s224,100.288,224,224S379.712,480,256,480z"/><polygon points="356.64,132.64 256,233.44 155.36,132.64 132.64,155.36 233.44,256 132.64,356.64 155.36,379.36 256,278.56 356.64,379.36 379.36,356.64 278.56,256 379.36,155.36 			"/></g></g></g></svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Kick User Modal -->
        <div id="actionUserModel" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Kick ${Username}</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="actionUsername">Kick</label>
                                <input type="text" class="form-control" id="actionUsername" value="" disabled>
                            </div>
                            <div class="form-group kick-only">
                                <label for="actionSelect">From</label>
                                <select id="actionSelect" class="form-control" required>
                                    <option>Server</option>
                                    <option disabled>Channel</option>
                                </select>
                            </div>
                            <div class="form-group ban-only">
                                <label for="actionSelect">Duration</label>
                                <select id="banDuration" class="form-control" required>
                                    <option value="perm">Indefinitely / Permanent</option>
                                    <option value="temp">Temporary</option>
                                </select>
                            </div>
                            <div class="form-group ban-only temp-ban">
                                <div class="btn-group" role="group" aria-label="...">
                                    <button type="button" data-type='for' class="btn btn-default temp-ban-btn active">For</button>
                                    <button type="button" data-type='until' class="btn btn-default temp-ban-btn ">Until</button>
                                </div>
                                <div class="input-group pull-right group-for">
                                    <input type="number" min="0" class="form-control for-length" aria-label="..." value="1"/>
                                    <input type="hidden" name="timescale" value="86400"/>
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle timescale-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Days <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right timescales">
                                            <li><a href="#" data-timescale="29030400">Years</a></li>
                                            <li><a href="#" data-timescale="2419200">Months</a></li>
                                            <li><a href="#" data-timescale="604800">Weeks</a></li>
                                            <li><a href="#" data-timescale="86400">Days</a></li>
                                            <li><a href="#" data-timescale="3600">Hours</a></li>
                                            <li><a href="#" data-timescale="60">Minutes</a></li>
                                            <li><a href="#" data-timescale="1">Seconds</a></li>
                                        </ul>
                                    </div><!-- /btn-group -->
                                </div>
                                <div class='input-group date pull-right group-until' id='datetimePicker'>
                                    <input type='text' class="form-control text-field" id="DateInput"/>
                                    <span class="input-group-addon calenderIcon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Reason</label>
                                <textarea id="reason" class="form-control" placeholder="Kick Reason" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger cta-btn" data-dismiss="modal"
                                data-type="Kick" data-kick-url="/api/kickUser/" data-ban-url="/api/banUser/">Kick User</button>
                    </div>
                </div>

            </div>
        </div>
        <div id="clientModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Username</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="actionUsername">Name</label>
                                <input type="text" class="form-control" id="clientName" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="actionUsername">Platform</label>
                                <input type="text" class="form-control" id="clientPlatform" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="actionUsername">IP Address</label>
                                <input type="text" class="form-control" id="clientIP" value="" disabled>
                            </div>
                            <div class="form-group sl">
                                <div class="third">
                                    <label for="actionUsername">Away</label>
                                    <input type="text" class="form-control" id="clientAway" value="" disabled>
                                </div>
                                <div class="third">
                                    <label for="actionUsername">Connection Time</label>
                                    <input type="text" class="form-control" id="clientConnectionTime" value="" disabled>
                                </div>
                                <div class="third">
                                    <label for="actionUsername">Total Connections</label>
                                    <input type="text" class="form-control" id="clientTotalConnections" value="" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="actionUsername">Created</label>
                                <input type="text" class="form-control" id="clientCreated" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="actionUsername">Last Connection</label>
                                <input type="text" class="form-control" id="clientLastConnect" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="actionUsername">Idletime</label>
                                <input type="text" class="form-control" id="clientIdletime" value="" disabled>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endpush

@push('js')
    <script>
        function secondsToHms(d) {
            d = Number(d);

            var h = Math.floor(d / 3600);
            var m = Math.floor(d % 3600 / 60);
            var s = Math.floor(d % 3600 % 60);

            return ('0' + h).slice(-2) + ":" + ('0' + m).slice(-2) + ":" + ('0' + s).slice(-2);
        }
        function setupUserActions() {
            $('.client').click(function(){
                showClientModal($(this));
            });
            $('.kick_user, .ban_user').click(function () {
                var username = $(this).parent().attr('data-username');
                var type = ($(this).hasClass('kick_user')) ? 'Kick' : 'Ban';
                var clid = $(this).parent().attr('data-clid');

                // Set Model Stuff
                var model = $('#actionUserModel');
                model.removeClass('kick');
                model.removeClass('ban');
                model.addClass(type.toLowerCase());
                model.find('.modal-title').text(type + ' ' + username);
                model.find('textarea').attr('placeholder', type + ' Reason...');
                model.find('#actionUsername').val(username);
                model.find('.cta-btn').text(type + ' User');
                model.find('.cta-btn').attr('data-type', type);
                model.find('.cta-btn').attr('data-clid', clid);

                // Show Model
                model.modal()
            });
        }
        function refreshUserList(){
            jQuery.ajax('/api/listUsersHTML', {
                success: function(data){
                    // Update Table
                    jQuery('.userList').html(data);

                    setupUserActions();

                    // Remove Spinner
                    $('.loading_spinner').removeClass('show');
                    setTimeout(function(){
                        $('.list-users-table').removeClass('no');
                    }, 750);

                },
                error: function(data){
                    console.error('😲 An Error Has Occured!');
                    console.log(data);
                }
            });
        }
        function showClientModal(row){
            var clid = row.find('.clid').text();

            $.ajax('/api/getUserInfo/' + clid, {
               success: function(data){
                   populateClientModal(data);
               },
               error: function(){
                   alerts.createAlert('danger', 'Error editing channel! 😱', true, 5);
                   console.error('😲 An Error Has Occurred!');
               }
            });
        }
        function populateClientModal(data){
            var modal = $('#clientModal');
            var name = data['data']['client_nickname'];
            var platform = data['data']['client_platform'];
            var ip = data['data']['connection_client_ip'];
            var idletime = data['data']['client_idle_time'];
            var connectionTime = data['data']['connection_connected_time'];
            var away = data['data']['client_away'];
            var totalConnections = data['data']['client_totalconnections'];
            var created = data['data']['client_created'];
            var lastConnected = data['data']['client_lastconnected'];

            modal.find('#clientName').val(name);
            modal.find('#clientPlatform').val(platform);
            modal.find('#clientIP').val(ip);
            modal.find('#clientAway').val(away);
            modal.find('#clientConnectionTime').val(secondsToHms(connectionTime / 1000));
            modal.find('#clientTotalConnections').val(totalConnections);
            modal.find('#clientCreated').val(new Date(parseInt(created)));
            modal.find('#clientLastConnect').val(new Date(parseInt(lastConnected)));
            modal.find('#clientIdletime').val(secondsToHms(idletime / 1000));


            modal.modal();
        }

        $(document).ready(function(){
            // Fill modal info
            setupUserActions();

            $('.cta-btn').click(function(){
                var url = $(this).attr('data-kick-url');

                // Ban Stuff
                if($(this).attr('data-type').toLowerCase() === 'ban'){
                    url = $(this).attr('data-ban-url');
                    var length = 0;

                    if($('#banDuration').val() === 'temp'){
                        if($('.temp-ban-btn.active').attr('data-type') === 'for'){
                            // For
                            var t = $('.for-length').val();
                            var ts = $('input[name=timescale]').val();
                            length = t * ts;
                        }else{
                            // Until
                            var currentDT = new Date();
                            var targetDT = new Date($('#DateInput').val());

                            length = (targetDT - currentDT) * 1000;
                        }
                    }

                    jQuery.ajax(url, {
                        success: function(data){
                            alerts.createAlert('success', 'User Successfully Banned!', true, 5);
                            refreshUserList();
                            console.log('👻 ' + data);
                        },
                        error: function(data){
                            alerts.createAlert('danger', 'Error Banning User!', true, 5);
                            console.error('😲 An Error Has Occured!');
                            console.log(data);
                        },
                        data: {
                            "id"     : $(this).attr('data-clid'),
                            "length" : length,
                            "reason" : $('#reason').val()
                        }
                    });
                    return;
                }

                // Kick AJAX
                jQuery.ajax(url, {
                    success: function(data){
                        alerts.createAlert('success', 'User Successfully Kicked!', true, 5);
                        refreshUserList();
                        console.log('👻 ' + data);
                    },
                    error: function(data){
                        alerts.createAlert('danger', 'Error Kicking User!', true, 5);
                        console.error('😲 An Error Has Occured!');
                        console.log(data);
                    },
                    data: {
                        "id"     : $(this).attr('data-clid'),
                        "mode"   : $('#actionSelect').val().toLowerCase(),
                        "reason" : $('#reason').val()
                    }
                });

            });

            $('.refresh').click(function(){
                refreshUserList();
            });

            $('.temp-ban-btn').click(function(){
                $('.temp-ban-btn').removeClass('active');
                $(this).addClass('active');

                if($(this).attr('data-type') === 'for'){
                    $('.input-group.group-for').show();
                    $('.input-group.group-until').hide();
                }else{
                    $('.input-group.group-for').hide();
                    $('.input-group.group-until').show();
                }
            });

            $('#banDuration').change(function(){
                if($(this).val() === 'temp'){
                    $('.temp-ban').show();
                }else{
                    $('.temp-ban').hide();
                }
            });

            $('.timescales').find('a').click(function(){
               $('.timescale-btn').text($(this).text());
               $('input[name=timescale]').val($(this).attr('data-timescale'));
            });

            // Setup Date Time Picker
            $(function () {
                $('#datetimePicker').datetimepicker();
            });
        });
    </script>
@endpush