@push('content')
    <div class="panel panel-default create-channel">
        <div class="panel-heading">Create Channel</div>

        <div class="panel-body">

            <form action="/createChannel" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="channelname">Channel Name</label>
                    <input name="channel_name" type="text" class="form-control" id="channelname" placeholder="Desired Channel Name">
                </div>
                <div class="form-group">
                    <label for="channel_flag">Channel Type</label>
                    <select id="channel_flag" name="channel_flag" class="form-control">
                        <option value="CHANNEL_FLAG_PERMANENT">Permanent</option>
                        <option value="CHANNEL_FLAG_SEMI_PERMANENT">Semi Permanent</option>
                        <option value="CHANNEL_FLAG_TEMPORARY">Tempory</option>
                    </select>
                </div>
                <div class="form-group">
                    <input id='passwordCheckbox' type="checkbox" class="form-check-input" checked>
                    <label for="pw">Password</label>
                    <input type="password" class="form-control" id="pw" name="pw" placeholder="Password" disabled>
                </div>
                <div class="form-group">
                    <input id='talk_power_checkbox' type="checkbox" class="form-check-input" checked>
                    <label for="talk_power">Needed Talkpower</label>
                    <input type="number" min="0" class="form-control" id="talk_power" name="talk_power" placeholder="0" disabled>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endpush
@push('js')
    <script>
        $(document).ready(function(){
            $('#passwordCheckbox').click(function(){
                $oldState = $('#pw').prop('disabled');
                $('#pw').prop('disabled', !$oldState);
            });
            $('#talk_power_checkbox').click(function(){
                $oldState = $('#talk_power').prop('disabled');
                $('#talk_power').prop('disabled', !$oldState);
            });
        });
    </script>
@endpush