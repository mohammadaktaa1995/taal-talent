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
    </style>
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
                <form action="{{route('add-question')}}" class="add-questions-form" method="post"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Question Text <span class="text-danger">*</span></label>
                                <input type="text" name="questions.text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Question Type <span class="text-danger">*</span></label>
                                <select name="questions.question_type_id" class="form-control questions-type">
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
                                <textarea name="questions.description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row correct-answer">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Correct Answer <span class="text-danger">*</span></label>
                                <input type="text" name="valid_answer.text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row multiple-choice hidden">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Answer Text<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control answer-text"
                                           aria-describedby="basic-addon1">
                                    <span class="input-group-addon add-answers" id="basic-addon1">+</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Answers </label>
                                <ol type="a" class="answers-list">
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row free-text hidden">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Answer </label>
                                <input type="text" name="answers.text" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
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
<script>
    $(function () {
        var $last = '';
        $('.questions-type').on('change', function () {
            if ($last)
                $('.' + $last).toggleClass('hidden');
            let $class = $(this).find('option:selected').attr('data-value');
            $('.' + $class).toggleClass('hidden');
            $last = $class;
        });
        $('.add-answers').on('click', function () {
            let input = $('.answer-text');
            let value = input.val();
            if (!value)
                alert("Please fill out answer text")
            else {
                $('.add-questions-form').append("<input name='answers.text[]' hidden value='" + value + "'/>");
                $('.answers-list').append("<li>" + value + "</li>");
                input.val('');
            }
        })
    })
</script>

</body>
</html>
