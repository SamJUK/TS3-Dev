@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @stack('content')
            </div>
        </div>
    </div>
@endsection

@push('messages')
    <?php
    if(Session::has('msgs')){
        $msgs = Session::get('msgs');
        foreach ($msgs as $msg): ?>
            <div class="alert alert-dismissible alert-<?php echo $msg['type']; ?>">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php echo $msg['message']; ?>
            </div>
        <?php endforeach;
        Session::forget('msgs');
        Session::save();
    }; ?>
@endpush