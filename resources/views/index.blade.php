@extends('welcome')
@section('content')

<div class="card mt-5">
    <div class="card-header">
        <a href="{{ route('files.create') }}" class="btn btn-outline-dark btn-loader">Upload</a>
    </div>
    <div class="card-body">
        @if(Session::has('success_message'))
            <div class="alert alert-block alert-success">
                <button type="button" class="close close-sm" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                <p> {{ Session::get('success_message') }} </p>
            </div>
        @endif
        <h5 class="card-title">Files</h5>
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col" width="150px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $file)
                <tr>
                    <th scope="row">{{ $file->id }}</th>
                    <td>{{ $file->name }}</td>
                    <td><a href="{{ route('files.show', $file->id) }}" class="btn btn-primary btn-loader">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>


@endsection