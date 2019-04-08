<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Taal Talent School</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="https://taal-talent.nl/ona/temp/assets/css/core.min.css" rel="stylesheet">
    <link href="https://taal-talent.nl/ona/temp/assets/css/app.min.css" rel="stylesheet">
    <link href="https://taal-talent.nl/ona/temp/assets/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="shortcut icon" href="https://taal-talent.nl/wp-content/uploads/2018/07/LOGO2.png"/>
    <link rel="apple-touch-icon" href="https://taal-talent.nl/wp-content/uploads/2018/07/LOGO2.png"/>
    <script src="js/script.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .correct-answer {
            display: none;
        }

        .add-answers {
            cursor: pointer;
            font-size: 25px;
        }

        .hidden {
            display: none;
        }

        tr.detail {
            display: none;
            width: 100%;
        }

        tr.detail div {
            display: none;
        }

        .show-more:hover {
            cursor: pointer;
        }

        .radio {

            display: block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 15px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none
        }

        /* Hide the browser's default radio button */
        .radio input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom radio button */
        .check-round {

            position: absolute;
            top: 6px;
            left: 0;
            height: 15px;
            width: 15px;
            background-color: #fff;
            border-color: #735DA1;
            border-style: solid;
            border-width: 2px;
            border-radius: 50%;
        }


        /* When the radio button is checked, add a blue background */
        .radio input:checked ~ .check-round {
            background-color: #fff;
        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .check-round:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the indicator (dot/circle) when checked */
        .radio input:checked ~ .check-round:after {
            display: block;
        }

        /* Style the indicator (dot/circle) */
        .radio .check-round:after {
            left: 2px;
            top: 2px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #735DA1;


        }

        /* The check */
        .check {
            display: block;
            position: relative;
            padding-left: 25px;
            margin-bottom: 12px;
            padding-right: 15px;
            cursor: pointer;
            font-size: 18px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .check input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 3px;
            left: 0;
            height: 18px;
            width: 18px;
            background-color: #fff;
            border-color: #735DA1;
            border-style: solid;
            border-width: 2px;
        }


        /* When the checkbox is checked, add a blue background */
        .check input:checked ~ .checkmark {
            background-color: #fff;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .check input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .check .checkmark:after {
            left: 5px;
            top: 1px;
            width: 5px;
            height: 10px;
            border: solid;
            border-color: #735DA1;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .cust-btn {
            margin-bottom: 10px;
            background-color: #735DA1;
            border-width: 2px;
            border-color: #735DA1;
            color: #fff;
        }

        .cust-btn:hover {

            border-color: #735DA1;
            background-color: #fff;
            color: #735DA1;
            border-radius: 20px;
            transform-style: 2s;

        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body>
<!-- Topbar -->
@include("layouts.header")
<!-- END Topbar -->

<!-- Main container -->
<main class="main-container">

    <div class="main-content container ">
        <div class="card  shadow-3">
            <div class="card-title fs-18 fw-400">Add Questions</div>
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-questions-tab" data-toggle="tab"
                           href="#nav-questions" role="tab" aria-controls="nav-questions"
                           aria-selected="true">Questions</a>
                        <a class="nav-item nav-link" id="nav-add-tab" data-toggle="tab" href="#nav-add" role="tab"
                           aria-controls="nav-add" aria-selected="false">Add Question</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-questions" role="tabpanel"
                         aria-labelledby="nav-questions-tab">
                        <table class="table" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Text</th>
                                <th>Time</th>
                                <th>Point</th>
                                <th>Question Type</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exam->questions()->get() as $question)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$question->text}}</td>
                                    <td>{{$question->time}}s</td>
                                    <td>{{$question->point}}</td>
                                    <td>{{$question->type->name}}</td>
                                    <td><a href="javascript:void(0)" class="show-more">Show More</a></td>
                                </tr>
                                @if($question->choices()->get()->count()>0)
                                    <tr class="detail">
                                        <td colspan="6">
                                            <div>
                                                @if($question->type->name=="Free Text")
                                                    <h5>Answer</h5>
                                                    @foreach($question->choices()->get() as $choice)
                                                        <li>{{$choice->text}}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <h5>Choices and correct answer</h5>
                                                    <ol type="a">
                                                        @foreach($question->choices()->get() as $choice)
                                                            <li><b>{{$choice->text}}</b> <span
                                                                        class="fa fa-{{$choice->is_correct?'check text-success':'close text-danger'}}"></span>
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endif

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">
                        <form action="{{route('add-question')}}" class="add-questions-form" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="exam_id" value="{{$exam->id}}">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Question Text <span class="text-danger">*</span></label>
                                        <input type="text" name="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Question Time<span class="text-danger">*</span></label>
                                        <input type="text" name="time" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Question Point <span class="text-danger">*</span></label>
                                        <input type="text" name="point" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Question Type <span class="text-danger">*</span></label>
                                        <select name="question_type_id" class="form-control questions-type">
                                            <option value=""></option>
                                            @foreach($questionTypes as $type)
                                                <option value="{{$type->id}}"
                                                        data-value="{{strtolower(str_replace(" ","-",$type->name))}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Question Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row correct-answer">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Correct Answer <span class="text-danger">*</span></label>
                                        <input type="text" name="valid_answer_text" class="form-control" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="row multiple-choice hidden">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Choice Text<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control choice-text"
                                                   aria-describedby="basic-addon1">
                                            <span class="input-group-addon add-answers" id="basic-addon1">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Choices <span class="fa fa-info-circle" data-toggle="tooltip"
                                                                    title="Click on one choice to choose correct answer"></span></label>
                                        <ol type="a" class="choices-list">
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="row free-text hidden">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Answer </label>
                                        <input type="text" name="choice_text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-block btn-info">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center text-md-left">©2019 Taal Talent. Alle rechten voorbehouden</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->
</main>
<!-- END Main container -->
<!-- Scripts -->
<script src="https://taal-talent.nl/ona/temp/assets/js/core.min.js"></script>
<script src="https://taal-talent.nl/ona/temp/assets/js/app.min.js"></script>
<script src="https://taal-talent.nl/ona/temp/assets/js/script.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(function () {
        var $choices = '';
        var $last = '';
        var $count = 0;
        var $checked = false;
        $('.questions-type').on('change', function () {
            if ($last)
                $('.' + $last).toggleClass('hidden');
            let $class = $(this).find('option:selected').attr('data-value');
            $('.' + $class).toggleClass('hidden');
            $last = $class;
        });
        $('.add-answers').on('click', function () {
            let input = $('.choice-text');
            if ($count >= 5) {
                toastr.info('You have entered 5 choices.');
                return;
            }
            let value = input.val();
            if (!value) {
                toastr.error('Please fill out choice text.');
                return;
            } else {
                $('.choices-list').append('<label class="radio">' + value + '' +
                    '  <input type="radio" required name="choices_text[]" value=' + value + '>\n' +
                    '  <span class="check-round"></span>\n' +
                    '</label>');
                input.val('');
                $count++;
                $choices += $count >= 5 ? value : value + ',';
                $("input[type='radio']").on('change', function () {
                    let value = $(this).val();
                    $("input[name='valid_answer_text']").val(value)
                });
            }
        });
        $("input[name='choice_text']").on('input', function () {
            $("input[name='valid_answer_text']").val($(this).val())
        });
        $('.add-questions-form').on('submit', function (e) {
            e.preventDefault();
            let url = $(this).attr('action');
            let data = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: url,
                data: data + '&choices=' + $choices,
                success: function (data) {
                    window.location = data.url
                }
            })
        })
        $('a.show-more').click(function (e) {
            e.preventDefault();
            var target_row = $(this).closest('tr').next('.detail');
            target_row.show().find('div').slideToggle('slow', function () {
                if (!$(this).is(':visible')) {
                    target_row.hide();
                }
            });
        });
    })
</script>

</body>
</html>
