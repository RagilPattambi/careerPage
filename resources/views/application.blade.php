@extends('layout')
@section('content')

<section>
    <div class="row">
        @foreach($applications as $application)
        <div class="col-md-4 my-3">
            <div class="card job">
                <div class="card-body">
                    <p>Name : {{$application['name']}}</p>
                    <p>Designation : {{$application['designation']}}</p>
                    <p>Experience : {{$application['experience']}}year(s)</p>
                </div>
                <div class="card-footer">
                    <div>
                        <form action="/apply" method="POST" enctype="multipart/form-data">
                            @csrf
                            <a href="/application/download/{{$application['id']}}" class="btn btn-danger">Download Resume</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

    </div>
</section>
@endsection