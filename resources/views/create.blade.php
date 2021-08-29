@extends('welcome')
@section('content')

<div class="card mt-5">
    <div class="card-header">
        <a type="button" href="{{ route('files.index') }}" class="btn btn-outline-dark">Back</a>
    </div>
    <div class="card-body">
        <h5 class="card-title">Upload File</h5>
        <? if ( $errors->count() > 0 ){ ?>
            <div role="alert" class="alert alert-block alert-danger">
                <button type="button" class="close close-sm" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                <? foreach( $errors->messages() as $message ){ ?>
                    <p> <?=$message[0]?> </p>
                <? break; } ?>
            </div>
        <? } ?>	

        <form action="{{route('files.store')}}" method="post" id="file-form" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleFormControlFile1"></label>
                <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
            </div>
            <button type="submit" class="btn btn-primary btn-loader" id="load2" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing Order">Upload</button>
        </form>
    </div>
</div>

@endsection