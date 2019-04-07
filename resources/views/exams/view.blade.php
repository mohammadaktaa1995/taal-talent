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
    <link href="http://taal-talent.nl/ona/temp/assets/vendor/datatables/css/dataTables.bootstrap4.min.css"
          rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>

<body>
<!-- Topbar -->
@include("layouts.header")
<!-- END Topbar -->

<!-- Main container -->
<main class="main-container">

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
                        <th width="100px"><b>Date</b></th>
                        <th width="100px"><b>Page Type</b></th>
                        <th width="70px"><b>Questions</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exams as $exam)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$exam->text}}</td>
                            <td>{{$exam->description}}</td>
                            <td>{{$exam->date}}</td>
                            <td>{{$pageType[$exam->page_type]}}</td>
                            <td><a href="{{url('exam/'.$exam->id)}}"> <span class="fa fa-list"></span></a></td>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
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
<script src="http://taal-talent.nl/ona/temp/assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="http://taal-talent.nl/ona/temp/assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="https://taal-talent.nl/ona/temp/assets/js/app.min.js"></script>
<script src="https://taal-talent.nl/ona/temp/assets/js/script.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    $(function () {
        $(".date-picker").flatpickr({
            dateFormat: "Y-m-d",
            minDate:new Date()
        });
        $('.add-exam-form').on('submit',function (e) {
            e.preventDefault();
            let url=$(this).attr('action');
            let data=$(this).serialize();
            $.ajax({
                type:'POST',
                url:url,
                data:data,
                success:function (data) {
                    window.location=data.url;
                }
            })
        })
    })
</script>

</body>
</html>
