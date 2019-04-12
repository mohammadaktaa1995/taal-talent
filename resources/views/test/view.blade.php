@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="inner-container">
            <div class="card inactive-1"></div>
            <div class="card inactive-2"></div>
            <div class="card">
                @foreach($exams as $exam)
                    <div class="content {{$loop->first?'active':''}}">
                        <h1>Exam {{$loop->iteration}}</h1>
                        <p><a href="{{route('test.exam-questions',[$exam->id])}}">{{$exam->text}}</a> {{--<i class="em em-coffee"></i>--}}
                        </p>
                        <a class="button next" href="#">Next &rarr;</a>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

@stop
@push('styles')
    <style>
        @import url("https://fonts.googleapis.com/css?family=Titillium+Web:300,700,900");
        @import url("https://fonts.googleapis.com/css?family=Palanquin:300");
        @import url("https://afeld.github.io/emoji-css/emoji.css");

        body {
            height: 100vh;
            width: 100%;
            margin: 0;
            font-family: 'Palanquin', sans-serif;
            font-size: 21px;
            color: #8f959a;
            line-height: 1.5;
            /*background: linear-gradient(0deg, #6a11cb 0%, #2575fc 100%);*/
        }

        .container {
            margin: 4em auto;
        }

        .inner-container {
            position: relative;
            max-width: 20%;
            min-width: 360px;
            height: 300px;
            width: 100%;
            margin: 0 auto 100px;
        }

        .content {
            position: absolute;
            opacity: 0;
            top: 2em;
            left: 10%;
            width: 80%;
            margin: 0 auto;
        }

        .active {
            display: block !important;
            margin: 0 auto;
            opacity: 1;
            transition: ease-in-out 1s;
        }

        .card {
            position: relative;
            background: #fff;
            border-radius: 5px;
            padding: 2em 0;
            height: 300px;
            box-sizing: border-box;
            transition: .3s ease;
            box-shadow: 0 3px 10px -2px rgba(0, 0, 0, 0.35);
        }

        .card:first-child, .card:nth-child(2) {
            background: #00c4c7;
            height: 8px;
            border-radius: 5px 5px 0 0;
            padding: 0;
            box-shadow: none;
        }

        .card:first-child {
            margin: 0 20px;
            background: #00b0b2;
        }

        .card:nth-child(2) {
            margin: 0 10px;
        }

        .card .progress-container {
            background: rgba(37, 117, 252, 0.2);
            height: 6px;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            border-radius: 0 0 5px 5px;
        }

        .card .progress-container .step {
            background-color: #2575fc;
            height: 6px;
            width: 33%;
            border-radius: 0 0 0 5px;
        }

        h1 {
            font-family: 'Titillium Web', sans-serif;
            font-weight: 700;
            font-size: 3rem;
            color: #00bfc2;
            margin: 0;
        }

        p {
            margin-top: 0;
        }

        a {
            color: #00CED1;
            text-decoration: none;
            position: relative;
        }

        a:before {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            width: 0%;
            border-bottom: 2px solid #00CED1;
            transition: 0.3s;
        }

        a:hover:before {
            width: 80%;
        }

    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {

            var content = $('.content');
            var currentItem = content.filter('.active');
            var steps = $('.card').filter('.steps');
            var inactive1 = $('.inactive-1');
            var inactive2 = $('.inactive-2');

            $('.next').click(function () {
                var nextItem = currentItem.next();
                var lastItem = content.last();
                var contentFirst = content.first();

                currentItem.removeClass('active');

                if (currentItem.is(lastItem)) {
                    currentItem = contentFirst.addClass('active');
                    currentItem.css({'right': '10%', 'opacity': '1'});
                    $('.step').animate({width: '33%'});
                    inactive1.animate({height: '8px', marginLeft: '20px', marginRight: '20px'}, 100);
                    inactive2.animate({height: '8px', marginLeft: '10px', marginRight: '10px'}, 100);

                } else if (currentItem.is(contentFirst)) {
                    currentItem.animate({opacity: 0}, 1000);
                    currentItem = nextItem.addClass('active');
                    $('.step').animate({width: '66%'});
                    inactive2.animate({height: '0', marginLeft: '0px', marginRight: '0px'}, 100);

                } else {
                    currentItem = nextItem.addClass('active');
                    $('.step').animate({width: '100%'});
                    inactive1.animate({height: '0', marginLeft: '0px', marginRight: '0px'}, 100);
                }
            });

        });
    </script>
@endpush