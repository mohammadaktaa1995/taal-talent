@extends('layouts.master')

@section('content')
    <div class="main-content container">
        <div class="row"><br><br>
            <div class="col-sm-6" style="margin: 0 auto;">
                <div class="loader">
                    <div class="col-xs-3 col-xs-offset-5">
                        <div id="loadbar" style="display: none;">
                            <img src="http://schoolsearch.co.ke/systems/img/loader.gif_large.gif" alt="Loading" class="center-block loanParamsLoader" style="">
                        </div>
                    </div>

                    <br>
                    <br>
                    <div id="quiz">

                        <div class="question">
                            <h5><span class="badge badge-warning" id="qid">1</span>
                                <span id="question" class="text-white"> </span>
                            </h5>
                        </div>
                        <ul class="choices-list">
                            <li>
                                <input type="radio" class="inputoption" id="f-option" name="selector" value="1">
                                <label for="f-option" class="element-animation"></label>
                                <div class="check"></div>
                            </li>

                            <li>
                                <input type="radio" class="inputoption" id="s-option" name="selector" value="2">
                                <label for="s-option" class="element-animation"></label>
                                <div class="check"><div class="inside"></div></div>
                            </li>

                            <li>
                                <input type="radio" class="inputoption" id="t-option" name="selector" value="3">
                                <label for="t-option" class="element-animation"></label>
                                <div class="check"><div class="inside"></div></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="hint">
                    <button id="show-hint-button" disabled>Show Hint</button><br><br>
                    <span class="hidden show-hint">
                        <p>Comment for single line //<br>
                        comment for multi line !--ok--<p>
                    </span>
                </div>
                <div class="text-muted">
                    <span id="answer"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div id="result-of-question" style="display: none;">
                    <span id="totalCorrect" class="pull-right"></span>
                    <table class="table table-hover table-responsive" >
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
            width   : 100%;
            min-height  : 405px;
            height: auto;
        }
        .center-block{
            width: 100%;
        }
        h2 {
            color: #AAAAAA;
            font-weight: normal;
        }
        .bg-for-submit-name
        {
            background: url('https://lh4.ggpht.com/GLT1kYMvi4oiguL9FOc1eM5q7sW0AvVJNWyBZ26iMq-BSm3Kpi9CPDR2UGoVlYrVwA=h900') fixed;
            background-size: cover;
            padding: 0;
            margin: 0;
        }
        .margin-top{
            margin-top: 270px;
        }



        p.form-title
        {
            font-family: 'Open Sans' , sans-serif;
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

        .pr-wrap
        {
            width: 100%;
            height: 100%;
            min-height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 999;
            display: none;
        }

        .show-pass-reset
        {
            display: block !important;
        }

        .pass-reset
        {
            margin: 0 auto;
            width: 250px;
            position: relative;
            margin-top: 22%;
            z-index: 999;
            background: #FFFFFF;
            padding: 20px 15px;
        }

        .pass-reset label
        {
            font-size: 12px;
            font-weight: 400;
            margin-bottom: 15px;
        }

        .pass-reset input[type="email"]
        {
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

        .pass-reset input[type="submit"]
        {
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
        #show-hint-button{
            background-color: #674D93;
            color: #fff;
            padding: 6px 15px;
            border: 1px solid #674D93;
            outline: none;
            border-top-left-radius: 15px;
            border-bottom-right-radius: 15px;
            margin-top: 20px;
        }
        .show-hint p{
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
        .question{
            background: #674D93;
            padding: 10px;
            color: #fff;
            border-bottom-right-radius: 55px;
            border-top-left-radius: 55px;
        }

        #qid{
            margin-left: 25px;
            background-color: #ffffff;
            color: #aaaaaa;
        }
        .container ul{
            list-style: none;
            margin: 0;
            padding: 0;
        }


        ul.choices-list li{
            color: #265397;
            display: block;
            position: relative;
            float: left;
            width: 100%;
            border-bottom: 1px solid #111111;
        }

        ul.choices-list li input[type=radio]{
            position: absolute;
            visibility: hidden;
        }

        ul.choices-list li label{
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

        ul.choices-list li:hover label{
            color: #265397;
        }

        ul.choices-list li .check{
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

        input[type=radio]:checked ~ .check::before{
            background: #00FF00;/*attr('data-background');*/
        }

        input[type=radio]:checked ~ label{
            color: #00FF00;
        }

        .cross:checked ~ .check {
            border: 2px solid #FF0000 !important;
        }
        .cross:checked ~ .check::before{
            background: #FF0000 !important;
        }
        .cross:checked ~ label{
            color: #FF0000 !important;
        }

        #result-of-question th{
            text-align: center;
            background: #674D93;
            color: #fff;
            padding: 18px;
            font-size: 18px;
            border: none;
        }
        #result-of-question  td{
            text-align: center;
            color: #222;
            background-color: #fff;
            padding: 18px;
            font-size: 15px;
            font-weight: 600;
            border: 1px solid #674D93;
        }

        #totalCorrect{
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
        #alert{
            /* Position fixed */
            position:fixed;
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
        var q = [
            {'Q':'How do you write "Hello World" in an alert box?', 'A':2,'C':['msg("Hello World");','alert("Hello World");','alertBox("Hello World");'],'H':"Hint 1"},
            {'Q':'How do you create a function in JavaScript?', 'A':3,'C':['function:myFunction()','function = myFunction()','function myFunction()'],'H':"Hint 1"},
            {'Q':'How to write an IF statement in JavaScript?', 'A':1,'C':['if (i == 5)','if i = 5 then','if i == 5 then'],'H':"Hint 1"},
            {'Q':'How does a FOR loop start?', 'A':2,'C':['for (i = 0; i <= 5)','for (i = 0; i <= 5; i++)','for i = 1 to 5'],'H':"Hint 1"},
            {'Q':'What is the correct way to write a JavaScript array?', 'A':3,'C':['var colors = "red", "green", "blue"','var colors = (1:"red", 2:"green", 3:"blue")','var colors = ["red", "green", "blue"]'],'H':"Hint 1"}
        ];


        $(function(){
            var loading = $('#loadbar').hide();
            $(document)
                .ajaxStart(function () {
                    loading.show();
                }).ajaxStop(function () {
                loading.hide();
            });


            var choicecount = 1;
            var allowchoice  = true;
            var questionNo = 0;

            $('#question').html(q[questionNo].Q);
            $($('#f-option').parent().find('label')).html(q[questionNo].C[0]);
            $($('#s-option').parent().find('label')).html(q[questionNo].C[1]);
            $($('#t-option').parent().find('label')).html(q[questionNo].C[2]);


            $(document.body).on('click',"#show-hint-button",function (e) {
                $('.show-hint').removeClass('hidden');
            });

            $(document.body).on('click',"label.element-animation",function (e) {
                var choice = $(this).parent().find('input:radio').val();
                console.log(choice);
                var anscheck =  $(this).checking(questionNo, choice);//$( "#answer" ).html(  );
                var thisel = $(this);
                // q[questionNo].UC = choice;
                // console.log(anscheck);
                if(anscheck){//answer correct
                    // correctCount++;
                    // q[questionNo].result = "Correct";
                    allowchoice = false;
                } else {//answer wrong
                    // q[questionNo].result = "Incorrect";
                    $(this).addClass('cross');
                    $($(this).parent().find('.check')).addClass('cross');
                    $($(this).parent().find('.inputoption')).addClass('cross');
                }
                choicecount++;
                if(choicecount > 2){//crossed limit of choosing option
                    console.log(choicecount+" greater than 2");
                    allowchoice = false;
                }
                if(allowchoice){
                    if(choicecount > 1){
                        $('.show-hint').html(q[questionNo].H);
                        $('#show-hint-button').prop('disabled', false);
                    }
                } else {
                    setTimeout(function(){
                        $('#loadbar').show();
                        $('#quiz').fadeOut();

                        $('.inputoption').removeClass('cross');
                        $('.check').removeClass('cross');
                        $('.inputoption').removeClass('cross');

                        questionNo++;
                        choicecount = 1;
                        allowchoice = true;
                        $('#show-hint-button').prop('disabled', true);
                        $('.show-hint').addClass('hidden');


                        //show answer and go to next question
                        if((questionNo + 1) > q.length){
                            alert("Quiz completed, Now click ok to get your answer");
                            $('label.element-animation').unbind('click');
                            setTimeout(function(){
                                var toAppend = '';
                                $.each(q, function(i, a){
                                    toAppend += '<tr>'
                                    toAppend += '<td>'+(i+1)+'</td>';
                                    toAppend += '<td>'+a.A+'</td>';
                                    toAppend += '<td>'+a.UC+'</td>';
                                    toAppend += '<td>'+a.result+'</td>';
                                    toAppend += '</tr>'
                                });
                                $('#quizResult').html(toAppend);
                                $('#totalCorrect').html("Total correct: " + correctCount);
                                $('#quizResult').show();
                                $('#loadbar').fadeOut();
                                $('#result-of-question').show();
                            }, 1000);
                        } else {
                            $('#qid').html(questionNo + 1);
                            $('input:radio').prop('checked', false);
                            setTimeout(function(){
                                $('#quiz').show();
                                $('#loadbar').fadeOut();
                            }, 1000);
                            $('#question').html(q[questionNo].Q);
                            $($('#f-option').parent().find('label')).html(q[questionNo].C[0]);
                            $($('#s-option').parent().find('label')).html(q[questionNo].C[1]);
                            $($('#t-option').parent().find('label')).html(q[questionNo].C[2]);
                        }
                    }, 1000);
                }
            });


            $.fn.checking = function(qstn, ck) {
                var ans = q[questionNo].A;
                console.log(ans);
                if (ck != ans)
                    return false;
                else
                    return true;
            };

        });
    </script>
    @endpush
