@extends('layouts/header')

@section('contents')
    <div id="iframe_box" class="Hui-article">
        <div class="show_iframe">
            <div style="display:none" class="loading"></div>
            <iframe scrolling="yes" frameborder="0" src="{{ url('welcome') }}"></iframe>
        </div>
    </div>
    @stop