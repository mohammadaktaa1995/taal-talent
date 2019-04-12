@extends('layouts.master')

@section('content')
    <div class="main-content container">
        <br><br>
        <div class="col-sm-12" {{--style="margin: 0 auto;"--}}>
            <div class="row mb-5">
                <div class="col-lg-6">
                    <h3><b>{{$exam->text}}</b></h3>
                </div>
                <div class="col-lg-6 d-flex">
                    <h5 class="mr-2"><b>Total Mark:</b> {{$exam->total_points}} | </h5>
                    <h5><b>Total Time:</b> <span class="countdown"
                                                 data-time="{{$exam->converted_total_time}}">{{$exam->converted_total_time}}</span>
                    </h5>
                </div>
            </div>
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    @foreach($questions as $question)
                        <a class="nav-item nav-link {{$loop->first?'active':''}}" id="nav-{{$question->id}}-tab"
                           data-toggle="tab"
                           href="#nav-{{$question->id}}" role="tab" aria-controls="nav-{{$question->id}}"
                           aria-selected="true">Q{{$loop->iteration}}</a>
                    @endforeach
                </div>
            </nav>
            <form action="{{route('test.answer')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="exam_id" value="{{$exam->id}}">
                <div class="tab-content" id="nav-tabContent">
                    @foreach($questions as $question)
                        <div class="tab-pane fade {{$loop->first?'show active':''}}" id="nav-{{$question->id}}"
                             role="tabpanel"
                             aria-labelledby="nav-{{$question->id}}-tab">
                            <div class="text-right">
                               <b>Time:</b> <span class="countdown question-time" data-time="{{$question->converted_time}}"> {{$question->converted_time}}</span>
                            </div>
                            <div class="question">
                                <h5><span class="badge badge-warning" id="qid">{{$loop->iteration}}</span>
                                    <span id="question" class="text-white">{{$question->full_text}}</span>
                                </h5>
                            </div>
                            @if($question->type->code=="MULT")
                                <ul class="choices-list">
                                    @foreach($question->choices()->get() as $choice)
                                        <li>
                                            <label class="radio">
                                                {{$choice->text}}
                                                <input type="radio" name="question_answer[{{$question->id}}]"
                                                       value="{{$choice->text}}">
                                                <span class="check-round"></span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="m-2">
                                    <label>Enter your answer...</label>
                                    <input type="text" class="form-control"
                                           name="question_answer[{{$question->id}}]" value="">
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>
                {{--                <div class="hint">--}}
                {{--                    <button id="show-hint-button" disabled>Show Hint</button><br><br>--}}
                {{--                    <span class="hidden show-hint">--}}
                {{--                        <p>Comment for single line //<br>--}}
                {{--                        comment for multi line !--ok--<p>--}}
                {{--                    </span>--}}
                {{--                </div>--}}
                {{--                <div class="text-muted">--}}
                {{--                    <span id="answer"></span>--}}
                {{--                </div>--}}
                <div class="row pull-right mb-4">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div id="result-of-question" style="display: none;">
                    <span id="totalCorrect" class="pull-right"></span>
                    <table class="table table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>Question No.</th>
                            <th>Our answer</th>
                            <th>Your answer</th>
                            <th>Result</th>
                        </tr>
                        </thead>
                        <tbody id="quizResult"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@push('styles')
    <style>

        #chartdiv {
            width: 100%;
            min-height: 405px;
            height: auto;
        }

        .center-block {
            width: 100%;
        }

        h2 {
            color: #AAAAAA;
            font-weight: normal;
        }

        .bg-for-submit-name {
            background: url('https://lh4.ggpht.com/GLT1kYMvi4oiguL9FOc1eM5q7sW0AvVJNWyBZ26iMq-BSm3Kpi9CPDR2UGoVlYrVwA=h900') fixed;
            background-size: cover;
            padding: 0;
            margin: 0;
        }

        .margin-top {
            margin-top: 270px;
        }


        p.form-title {
            font-family: 'Open Sans', sans-serif;
            font-size: 20px;
            font-weight: 600;
            text-align: center;
            color: #FFFFFF;
            margin-top: 5%;
            text-transform: uppercase;
            letter-spacing: 4px;
        }


        .btn-success {
            color: #fff;
            background-color: #674D93;
            border-color: #674D93;
            width: 100%;
            /* font-weight: 600 !important; */
            padding: 7px 10px;
            font-size: 15px !important;
            border-radius: 0px;
            word-spacing: 4px;
            letter-spacing: 1px;

        }

        .btn-success:hover {
            color: #fff !important;
            background-color: #2FC0AE !important;
            border-color: #2FC0AE !important;
        }

        .pr-wrap {
            width: 100%;
            height: 100%;
            min-height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 999;
            display: none;
        }

        .show-pass-reset {
            display: block !important;
        }

        .pass-reset {
            margin: 0 auto;
            width: 250px;
            position: relative;
            margin-top: 22%;
            z-index: 999;
            background: #FFFFFF;
            padding: 20px 15px;
        }

        .pass-reset label {
            font-size: 12px;
            font-weight: 400;
            margin-bottom: 15px;
        }

        .pass-reset input[type="email"] {
            width: 100%;
            margin: 5px 0 0 0;
            padding: 5px 10px;
            background: 0;
            border: 0;
            border-bottom: 1px solid #000000;
            outline: 0;
            font-style: italic;
            font-size: 12px;
            font-weight: 400;
            letter-spacing: 1px;
            margin-bottom: 5px;
            color: #000000;
            outline: 0;
        }

        .pass-reset input[type="submit"] {
            width: 100%;
            border: 0;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 500;
            margin-top: 10px;
            outline: 0;
            cursor: pointer;
            letter-spacing: 1px;
        }

        /*----------quiz.css---------------*/
        #show-hint-button {
            background-color: #674D93;
            color: #fff;
            padding: 6px 15px;
            border: 1px solid #674D93;
            outline: none;
            border-top-left-radius: 15px;
            border-bottom-right-radius: 15px;
            margin-top: 20px;
        }

        .show-hint p {
            color: #aaaaaa;
            font-size: 15px;
            padding-left: 80px;
        }

        .loanParamsLoader {
            top: 143px;
            margin: auto;
            position: absolute;
            right: 17%;
            width: 135%;
        }

        .question {
            background: #674D93;
            padding: 10px;
            color: #fff;
            border-bottom-right-radius: 55px;
            border-top-left-radius: 55px;
        }

        #qid {
            margin-left: 25px;
            background-color: #ffffff;
            color: #aaaaaa;
        }

        .container ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }


        ul.choices-list li {
            color: #265397;
            display: block;
            position: relative;
            float: left;
            width: 100%;
            border-bottom: 1px solid #111111;
        }

        ul.choices-list li:last-child {
            border-bottom: none;
        }

        ul.choices-list li input[type=radio] {
            position: absolute;
            visibility: hidden;
        }

        ul.choices-list li label {
            display: block;
            position: relative;
            font-weight: 400;
            font-size: 1em;
            padding: 5px 5px 5px 30px;
            margin: 5px auto;
            height: 35px;
            z-index: 9;
            cursor: pointer;
            -webkit-transition: all 0.25s linear;
            color: #727272;
        }

        ul.choices-list li:hover label {
            color: #265397;
        }

        ul.choices-list li .check {
            display: block;
            position: absolute;
            border: 2px solid #265397;
            border-radius: 50%;
            height: 15px;
            width: 15px;
            top: 15px;
            left: 5px;
            padding: 0;
            z-index: 5;
            transition: border .25s linear;
            -webkit-transition: border .25s linear;
        }

        ul.choices-list li:hover .check {
            border: 2px solid #265397;
        }

        ul.choices-list li .check::before {
            display: block;
            position: absolute;
            content: '';
            border-radius: 100%;
            height: 7px;
            width: 7px;
            top: 2px;
            left: 2px;
            margin: auto;
            transition: background 0.25s linear;
            -webkit-transition: background 0.25s linear;
        }

        input[type=radio]:checked ~ .check {
            border: 2px solid #00FF00;
        }

        input[type=radio]:checked ~ .check::before {
            background: #00FF00; /*attr('data-background');*/
        }

        input[type=radio]:checked ~ label {
            color: #00FF00;
        }

        .cross:checked ~ .check {
            border: 2px solid #FF0000 !important;
        }

        .cross:checked ~ .check::before {
            background: #FF0000 !important;
        }

        .cross:checked ~ label {
            color: #FF0000 !important;
        }

        #result-of-question th {
            text-align: center;
            background: #674D93;
            color: #fff;
            padding: 18px;
            font-size: 18px;
            border: none;
        }

        #result-of-question td {
            text-align: center;
            color: #222;
            background-color: #fff;
            padding: 18px;
            font-size: 15px;
            font-weight: 600;
            border: 1px solid #674D93;
        }

        #totalCorrect {
            color: #fff;
            background: #674D93;
            padding: 22px 20px;
            border-radius: 1px;
            font-stretch: expanded;
            font-size: 28px;
            font-weight: bold;
            border-top-right-radius: 25px;
            border-top-left-radius: 25px;
        }

        #alert {
            /* Position fixed */
            position: fixed;
            /* Center it! */
            top: 50%;
            left: 50%;
            margin-top: -50px;
            margin-left: -100px;
        }

    </style>
@endpush
@push('scripts')
    <script>
        (function () {

            setTimeout(() => {
                $('form').submit()
            }, '{{$exam->total_time*1000}}');

                    {{--            var total_time = "{{$exam->converted_total_time}}";--}}
            var total_time = $('.countdown');

            total_time.each(function () {

                let convert_time = $(this).attr('data-time');
                let $this=this;
                var interval = setInterval(function () {

                    var timer = convert_time.split(':');

                    var minutes = parseInt(timer[0], 10);
                    var seconds = parseInt(timer[1], 10);
                    --seconds;
                    minutes = (seconds < 0) ? --minutes : minutes;
                    if (minutes < 0) clearInterval(interval);
                    seconds = (seconds < 0) ? 59 : seconds;
                    seconds = (seconds < 10) ? '0' + seconds : seconds;
                    //minutes = (minutes < 10) ?  minutes : minutes;
                    $($this).html(minutes + ':' + seconds);
                    convert_time = minutes + ':' + seconds;
                }, 1000);
            })
        })($)
    </script>
@endpush
