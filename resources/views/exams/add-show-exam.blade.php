@extends('layouts.master')
@section('content')
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
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Text</th>
                                <th>Time</th>
                                <th>Point</th>
                                <th>Question Type</th>
                                <th>After Answer</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exam->questions()->get() as $question)
                                <tr data-data="{{$question}}">
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="javascript:void(0)" class="show-more"><span class="fa fa-list"></span></a>
                                    </td>
                                    <td>{{$question->text}}</td>
                                    <td>{{$question->time}}s</td>
                                    <td>{{$question->point}}</td>
                                    <td>{{$question->type->name}}</td>
                                    <td>{{$question->after_answer?$question->after_answer:'-'}}</td>
                                    <td class="text-center">
                                        <a class="delete-question mr-2" data-exam="{{$exam->id}}"
                                           href="{{route('delete-question',[$question->id])}}"><span
                                                    class="fa fa-trash-o"></span></a>
                                        <a class="edit-question mr-2" href="javascript:void(0)"
                                           data-href="{{route('edit-question',[$question->id])}}"><span
                                                    class="fa fa-edit"></span></a>
                                    </td>
                                </tr>
                                @if($question->choices()->get()->count() > 0)
                                    <tr class="detail">
                                        <td colspan="8">
                                            <div>
                                                @if($question->type->code=="SING" ||$question->type->code=="BETW")
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
                                                                        class="fa fa-{{$choice->pivot->is_correct?'check text-success':'close text-danger'}}"></span>
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
                                        <input type="number" name="time" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Question Point <span class="text-danger">*</span></label>
                                        <input type="number" name="point" class="form-control" required>
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
                            <div class="row answer-between-words hidden">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Answer </label>
                                        <input type="text" name="between_choice_text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">After Answer </label>
                                        <input type="text" name="after_answer" class="form-control">
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
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" class="update-questions-form" method="post"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('patch')}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Question</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-details-tab" data-toggle="tab"
                                   href="#nav-details" role="tab" aria-controls="nav-details"
                                   aria-selected="true">Question Details</a>
                                <a class="nav-item nav-link" id="nav-answers-tab" data-toggle="tab" href="#nav-answers"
                                   role="tab"
                                   aria-controls="nav-answers" aria-selected="false">Question Choices and correct
                                    answer</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent1">
                            <div class="tab-pane fade show active" id="nav-details" role="tabpanel"
                                 aria-labelledby="nav-details-tab">
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
                                            <input type="number" name="time" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Question Point <span class="text-danger">*</span></label>
                                            <input type="number" name="point" class="form-control" required>
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
                                <div class="row answer-between-words hidden">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Answer </label>
                                            <input type="text" name="between_choice_text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">After Answer </label>
                                            <input type="text" name="after_answer" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-answers" role="tabpanel"
                                 aria-labelledby="nav-answers-tab">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var token = '{{csrf_token()}}';
        var $choices = '';
        var $update_choices = '';
        var $count = 0;
        var $update_count = 0;
        var $last = '';
        var $checked = false;
        $(function () {

            $('.questions-type').on('change', function () {
                if ($last)
                    $('.' + $last).toggleClass('hidden');
                let $class = $(this).find('option:selected').attr('data-value');
                let $cont=$('.' + $class);
                $('.' + $class).toggleClass('hidden');
                $('.' + $class).find('input').val('');
                $last = $class;
            });
            $('#nav-details .questions-type').on('change', function () {
                if ($last)
                    $('.' + $last).toggleClass('hidden');
                let $class = $(this).find('option:selected').attr('data-value');
                let $cont = $('#nav-details .' + $class);
                $('#nav-answers ').html('');
                $cont.toggleClass('hidden');
                $cont.find('input').val('');
                $last = $class;
                addAnswerEvent("#nav-details")
            });

            $("#nav-details input[name='choice_text'],#nav-details input[name='between_choice_text']").on('input', function () {
                $("#nav-details input[name='valid_answer_text']").val($(this).val());
            });

            $("input[name='choice_text'],input[name='between_choice_text']").on('input', function () {
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
            });

            $('.update-questions-form').on('submit', function (e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let data = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data + '&choices=' + $update_choices,
                    success: function (data) {
                        // window.location = data.url
                    }
                })
            });

            $('a.show-more').click(function (e) {
                e.preventDefault();
                var target_row = $(this).closest('tr').next('.detail');
                target_row.show().find('div').slideToggle('slow', function () {
                    if (!$(this).is(':visible')) {
                        target_row.hide();
                    }
                });
            });

            $('.delete-question').on('click', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                let exam_id = $(this).attr('data-exam');
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover it!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {_token: token, exam: exam_id},
                                success: function (data) {
                                    window.location = data.url;
                                }
                            });
                            swal("Poof! Your Question has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            // swal("Your Question is safe!");
                        }
                    });

            });

            addAnswerEvent('.add-questions-form');

            $('.edit-question').on('click', function (e) {
                e.preventDefault();
                let $tr = $(this).closest('tr');
                let data = JSON.parse($tr.attr('data-data'));
                let url = $(this).attr('data-href');
                $('.update-questions-form').attr('action', url);
                _fill('#updateModal', data);
                $("input[name='exam_id']").val('{{$exam->id}}');
                $('#updateModal').modal('show');
                let $content = '';
                if (data.type.code === "MULT") {
                    let $choices_scoped = data.choices;
                    let $choices_html = '';
                    for (let i = 0; i < $choices_scoped.length; i++) {
                        $update_count++;
                        $update_choices += $count >= 5 ? $choices_scoped[i].text : $choices_scoped[i].text + ',';
                        let $checked = $choices_scoped[i].pivot.is_correct === 1 ? 'checked' : '';
                        if ($checked)
                            $("input[name='valid_answer_text']").val($choices_scoped[i].text)
                        $choices_html += '<div style="display: flex;align-items: center;position: relative;"><label class="radio">' + $choices_scoped[i].text + '' +
                            '  <input type="radio"' + $checked + ' required name="choices_text[]" value=' + $choices_scoped[i].text + '>\n' +
                            '  <span class="check-round"></span>\n' +
                            '</label>' +
                            '  <span style="top: 10px;text-align: right;float: right;position: absolute;right: 40px;cursor: pointer;" class="fa fa-minus-circle text-danger delete-choice"></span>\n' +
                            '</div>'
                    }
                    $content = "       <div class=\"row multiple-choice\">\n" +
                        "                                <div class=\"col-lg-6\">\n" +
                        "                                    <div class=\"form-group\">\n" +
                        "                                        <label for=\"\">Choice Text<span class=\"text-danger\">*</span></label>\n" +
                        "                                        <div class=\"input-group\">\n" +
                        "                                            <input type=\"text\" class=\"form-control choice-text\"\n" +
                        "                                                   aria-describedby=\"basic-addon1\">\n" +
                        "                                            <span class=\"input-group-addon add-answers\" id=\"basic-addon1\">+</span>\n" +
                        "                                        </div>\n" +
                        "                                    </div>\n" +
                        "                                </div>\n" +
                        "                                <div class=\"col-lg-6\">\n" +
                        "                                    <div class=\"form-group\">\n" +
                        "                                        <label for=\"\">Choices <span class=\"fa fa-info-circle\" data-toggle=\"tooltip\"\n" +
                        "                                                                    title=\"Click on one choice to choose correct answer\"></span></label>\n" +
                        "                                        <ol type=\"a\" class=\"choices-list\">\n" +
                        "                                        " + $choices_html + "\n" +
                        "                                        </ol>\n" +
                        "                                    </div>\n" +
                        "                                </div>\n" +
                        "                            </div>";
                    $('#nav-answers').html($content);
                    addAnswerEvent('#nav-answers');

                } else if (data.type.code === "SING") {
                    let $answer = data.choices[0];
                    $content = "       <div class=\"row free-text\">\n" +
                        "                                <div class=\"col-lg-6\">\n" +
                        "                                    <div class=\"form-group\">\n" +
                        "                                        <label for=\"\">Answer </label>\n" +
                        "                                        <input type=\"text\" name=\"choice_text\" value='" + $answer.text + "' class=\"form-control\">\n" +
                        "                                    </div>\n" +
                        "                                </div>\n" +
                        "                            </div>";
                    $('#nav-answers').html($content);
                } else {
                    let $answer = data.choices[0];
                    let $after_answer = data.after_answer;
                    $content = "       <div class=\"row free-text\">\n" +
                        "                                <div class=\"col-lg-6\">\n" +
                        "                                    <div class=\"form-group\">\n" +
                        "                                        <label for=\"\">Answer </label>\n" +
                        "                                        <input type=\"text\" name=\"between_choice_text\" value='" + $answer.text + "' class=\"form-control\">\n" +
                        "                                    </div>\n" +
                        "                                </div>\n" +
                        "                                <div class=\"col-lg-6\">\n" +
                        "                                    <div class=\"form-group\">\n" +
                        "                                        <label for=\"\">After Answer </label>\n" +
                        "                                        <input type=\"text\" name=\"after_answer\" value='" + $after_answer + "' class=\"form-control\">\n" +
                        "                                    </div>\n" +
                        "                                </div>\n" +
                        "                            </div>";
                    $('#nav-answers').html($content);
                }
                $("#nav-answers input[name='choice_text'],#nav-answers input[name='between_choice_text']").on('input', function () {
                    $("#nav-details input[name='valid_answer_text']").val($(this).val())
                });
            })

        });

        function addAnswerEvent($cont) {
            $($cont + ' .add-answers').off('click').on('click', function () {
                let input = $($cont + ' .choice-text');
                console.log(input)
                if ($cont === "#nav-answers" && $update_count >= 5) {
                    toastr.info('You have entered 5 choices.');
                    return;
                } else if ($count >= 5) {
                    toastr.info('You have entered 5 choices.');
                    return;
                }

                let value = input.val();
                if (!value) {
                    toastr.error('Please fill out choice text.');
                    return;
                } else {
                    $($cont + ' .choices-list').append('<div style="display: flex;align-items: center;position: relative;"><label class="radio">' + value + '' +
                        '  <input type="radio" required name="choices_text[]" value=' + value + '>\n' +
                        '  <span class="check-round"></span>\n' +
                        '</label>' +
                        '  <span style="top: 10px;text-align: right;float: right;position: absolute;right: 40px;cursor: pointer;" class="fa fa-minus-circle text-danger delete-choice"></span>\n' +
                        '</div>');
                    input.val('');
                    if ($cont === "#nav-answers" || $cont === "#nav-details") {
                        $update_count++;
                        $update_choices += $count >= 5 ? value : value + ',';
                    } else {
                        $count++;
                        $choices += $count >= 5 ? value : value + ',';
                    }
                    $("#nav-details  input[type='radio'],#nav-answers input[type='radio']," + $cont + " input[type='radio']").on('change', function () {
                        let value = $(this).val();
                        $("#nav-details input[name='valid_answer_text']").val(value)
                    });
                    $($cont + ' .delete-choice').on('click', function () {
                        if ($cont === "#nav-answers") {
                            $update_count--;
                            let string = $(this).parent().find('input').val();
                            $temp = $update_choices;
                            $update_choices = $temp.replace(string.replace(' ', '') + ',', '');
                        } else {
                            $count--;
                            let string = $(this).parent().find('input').val();
                            $temp = $choices;
                            $choices = $temp.replace(string.replace(' ', '') + ',', '');
                        }
                        $(this).parent().remove();
                    })
                }
            });
            $("#nav-details  input[type='radio'],#nav-answers input[type='radio']," + $cont + " input[type='radio']").on('change', function () {
                let value = $(this).val();
                $("#nav-details input[name='valid_answer_text']").val(value)
            });
            $($cont + ' .delete-choice').on('click', function () {
                if ($cont === "#nav-answers") {
                    $update_count--;
                    let string = $(this).parent().find('input').val();
                    $temp = $update_choices;
                    $update_choices = $temp.replace(string.replace(' ', '') + ',', '');
                } else {
                    $count--;
                    let string = $(this).parent().find('input').val();
                    $temp = $choices;
                    $choices = $temp.replace(string.replace(' ', '') + ',', '');
                }
                $(this).parent().remove();
            })
        }

    </script>
@endpush

