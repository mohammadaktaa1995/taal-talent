@extends('layouts.master')
@section('content')

    <div class="main-content container ">
        <div class="card  shadow-3">
            <div class="card-title fs-18 fw-400">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="text-left">
                            Result
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-right">
                            Your Mark is: {{$mark}}/{{$exam_mark}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr class="bg-light fw-500">
                        <th><b>#</b></th>
                        <th><b></b></th>
                        <th><b>Question</b></th>
                        <th><b>Answer</b></th>
                        <th><b>Date</b></th>
                        <th><b>Correct Answer</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($student_answers as $student_answer)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <span class="fa fa-{{$student_answer->is_true?'check text-success':'close text-danger'}}"></span>
                            </td>
                            <td>{{$student_answer->question->text}}</td>
                            <td>{{$student_answer->text}}</td>
                            <td>{{date('Y-m-d',strtotime($student_answer->date_of_answer))}}</td>
                            <td>{{isset($student_answer->correct_answer_text)?$student_answer->correct_answer_text:'-'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $(".date-picker").flatpickr({
                dateFormat: "Y-m-d",
                minDate: new Date()
            });

            $('.add-exam-form').on('submit', function (e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let data = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    success: function (data) {
                        window.location = data.url;
                    }
                })
            });

            $('.delete-exam').on('click', function (e) {
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

            $('.edit-exam').on('click', function (e) {
                e.preventDefault();
                let $tr = $(this).closest('tr');
                let url = $(this).attr('data-href');
                $('.edit-exam-form').attr('action', url);
                let data = JSON.parse($tr.attr('data-data'));
                _fill('#editModal', data);
                $('#editModal').modal('show');
            })
        })
    </script>
@endpush
