@extends('layouts.master')
@section('content')

    <div class="main-content container ">
        <div class="card  shadow-3">
            <div class="card-title fs-18 fw-400">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="text-left">
                            Exams
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#addModal">
                                Add Exam
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover" cellspacing="0" data-ordering="false" data-provide="datatables">
                    <thead>
                    <tr class="bg-light fw-500">
                        <th><b>#</b></th>
                        <th><b>Text</b></th>
                        <th><b>Description</b></th>
                        <th><b>Date</b></th>
                        <th><b>Page Type</b></th>
                        <th class="text-center"><b>Questions</b></th>
                        <th class="text-center"><b>Actions</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exams as $exam)
                        <tr data-data="{{$exam}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$exam->text}}</td>
                            <td>{{$exam->description}}</td>
                            <td>{{$exam->date}}</td>
                            <td>{{$pageType[$exam->page_type]}}</td>
                            <td class="text-center"><a href="{{route('exams.show',[$exam->id])}}"> <span class="fa fa-list"></span></a></td>
                            <td class="text-center">
                                <a class="delete-exam mr-2" data-toggle="tooltip" title="Delete" data-exam="{{$exam->id}}"
                                   href="{{route('delete-exam',[$exam->id])}}"><span
                                            class="fa fa-trash-o"></span></a>
                                <a class="edit-exam mr-2" data-toggle="tooltip" title="Edit" href="javascript:void(0)"
                                   data-href="{{route('edit-exam',[$exam->id])}}"><span class="fa fa-edit"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('add-exam')}}" method="post" enctype="multipart/form-data" class="add-exam-form">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Exam</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Exam Name <span class="text-danger">*</span></label>
                            <input type="text" name="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Exam Description</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Exam Date <span class="text-danger">*</span></label>
                            <input type="text" name="date" class="form-control date-picker" required>
                        </div>
                        <div class="form-group">
                            <label>Exam Page Type <span class="text-danger">*</span></label>
                            <select name="page_type" class="form-control" required>
                                <option value=""></option>
                                @foreach($pageType as $key=>$type)
                                    <option value="{{$key}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Subject <span class="text-danger">*</span></label>
                            <select name="subject_id" class="form-control" required>
                                <option value=""></option>
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->text}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Group <span class="text-danger">*</span></label>
                            <select name="groups" class="form-control" required style="width: 100%">
                                <option value=""></option>
                                @foreach(\App\Group::all() as $group)
                                    <option value="{{$group->id}}">{{$group->text}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Students</label>
                            <select name="students[]" class="form-control select2" multiple style="width: 100%">
                                <option value=""></option>
                                @foreach(\App\User::all() as $user)
                                    <option value="{{$user->id}}">{{$user->firstname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data" class="edit-exam-form">
                    {{csrf_field()}}
                    {{method_field('patch')}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Exam</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Exam Name <span class="text-danger">*</span></label>
                            <input type="text" name="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Exam Description</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Exam Date <span class="text-danger">*</span></label>
                            <input type="text" name="date" class="form-control date-picker" required>
                        </div>
                        <div class="form-group">
                            <label>Exam Page Type <span class="text-danger">*</span></label>
                            <select name="page_type" class="form-control" required>
                                <option value=""></option>
                                @foreach($pageType as $key=>$type)
                                    <option value="{{$key}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Subject <span class="text-danger">*</span></label>
                            <select name="subject_id" class="form-control" required>
                                <option value=""></option>
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->text}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Group <span class="text-danger">*</span></label>
                            <select name="groups" class="form-control" required style="width: 100%">
                                <option value=""></option>
                                @foreach(\App\Group::all() as $group)
                                    <option value="{{$group->id}}">{{$group->text}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Students </label>
                            <select name="students[]" class="form-control select2" multiple style="width: 100%">
                                <option value=""></option>
                                @foreach(\App\User::all() as $user)
                                    <option value="{{$user->id}}">{{$user->firstname}}</option>
                                @endforeach
                            </select>
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
@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    @endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(function () {
            $('.select2').select2();
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
                let url=$(this).attr('data-href');
                $('.edit-exam-form').attr('action',url);
                let data = JSON.parse($tr.attr('data-data'));
                _fill('#editModal', data);
                $('#editModal').modal('show');
            })
        })
    </script>
@endpush
