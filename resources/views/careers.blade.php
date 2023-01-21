@extends('layout')
@section('content')
@if($errors->any())
<div class="bg-danger text-white p-2">{{ implode('', $errors->all(':message')) }}</div>
@endif
<div class="modal fade" id="createJob" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/career/store" method="POST" enctype="multipart/form-data" id="jobForm">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="designation" class="form-control-label">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation">
                    </div>
                    <div class="form-group">
                        <label for="experience" class="form-control-label">Experience</label>
                        <input type="text" class="form-control" id="experience" name="experience">
                    </div>
                    <div class="form-group">
                        <label for="expiry_date" class="form-control-label">End date</label>
                        <input type="date" class="form-control" id="expiry_date" name="expiry_date">
                    </div>
                    <div class="form-group">
                        <label for="experience" class="form-control-label">Job Description</label>
                        <textarea class="form-control" id="job_description" name="job_description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<section>
    <div class="row">
        @foreach($careers as $career)
        <div class="col-md-4 my-3">
            <div class="card job">
                <div class="card-head p-3">
                    <h5>{{$career['designation']}}</h5>

                </div>
                <div class="card-body">
                    <p>Experience - {{$career['experience']}} years</p>
                    <p>End Date - {{date('d/m/Y', strtotime($career['expiry_date']))}}</p>
                    <p>Job Description : <br>{{$career['job_description']}}</p>

                </div>
                <div class="card-footer">
                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apply Job</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" enctype="multipart/form-data" id="applicationForm">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-control-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="designation" class="form-control-label">Designation</label>
                                <input type="text" class="form-control" id="designation" name="designation">
                            </div>
                            <div class="form-group">
                                <label for="experience" class="form-control-label">Experience</label>
                                <input type="text" class="form-control" id="experience" name="experience">
                            </div>
                            <div class="form-group">
                                <label for="resume" class="form-control-label">Upload Resume</label>
                                <input type="file" class="form-control" id="resume" name="resume">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="submit" type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <script>
        if ($("#applicationForm").length > 0) {
            $("#applicationForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 50
                    },
                    designation: {
                        required: true,
                        maxlength: 50,
                    },
                    experience: {
                        required: true,
                        number: true
                    },
                    resume: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Please enter name",
                        maxlength: "Your name maxlength should be 50 characters long."
                    },
                    designation: {
                        required: "Please enter designation",
                        maxlength: "The designation name should less than or equal to 50 characters",
                    },
                    experience: {
                        required: "Please enter experience",
                        number: "The experience should be digit."
                    },
                    resume: {
                        required: "Please select a file to upload"
                    }
                },
                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#submit').html('Please Wait...');
                    $("#submit").attr("disabled", true);
                    $.ajax({
                        url: "/apply",
                        type: "POST",
                        data: $('#applicationForm').serialize(),
                        success: function(response) {
                            $('#submit').html('Submit');
                            $("#submit").attr("disabled", false);
                            Swal.fire('Application submitted successfully').then(function() {
                                window.location.href = "/";
                            });;
                            document.getElementById("applicationForm").reset();
                        }
                    });
                }
            })
        }

        if ($("#jobForm").length > 0) {
            $("#jobForm").validate({
                rules: {
                    job_description: {
                        required: true,
                        maxlength: 255
                    },
                    designation: {
                        required: true,
                        maxlength: 50,
                    },
                    experience: {
                        required: true,
                        number:true
                    },
                    expiry_date: {
                        required: true,
                    }
                },
                messages: {
                    job_description: {
                        required: "Please enter job description",
                        maxlength: "The description maxlength should be 255 characters long."
                    },
                    designation: {
                        required: "Please enter designation",
                        maxlength: "The designation name should less than or equal to 50 characters",
                    },
                    experience: {
                        required: "Please enter experience",
                        number: "The experience should be digit."
                    },
                    expiry_date: {
                        required: "Please select a expiry date"
                    }
                },
                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#submit').html('Please Wait...');
                    $("#submit").attr("disabled", true);
                    $.ajax({
                        url: "/career/store",
                        type: "POST",
                        data: $('#jobForm').serialize(),
                        success: function(response) {
                            $('#submit').html('Submit');
                            $("#submit").attr("disabled", false);
                            Swal.fire('Job created successfully').then(function() {
                                window.location.href = "/";
                            });
                            document.getElementById("jobForm").reset();
                        }
                    });
                }
            })
        }
    </script>
    @endsection