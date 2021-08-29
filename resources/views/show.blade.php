@extends('welcome')
@section('content')

<div class="mt-5">
    <div class="ml-3">
        <a href="{{ route('files.index') }}" class="btn btn-outline-dark">Back</a>
    </div>
    <div class="card-body">
        <h5 class="card-title">{{$file->name}}</h5>
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <!-- <th scope="col">#</th> -->
                    @foreach($file->headings AS $heading)
                    <th scope="col">{{$heading->name}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($list as $row)
                <tr>
                    <!-- <th scope="row">{{ $row->id }}</th> -->
                    @foreach($row->rowsData AS $data)
                        <td>{{ $data->value }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>

        <nav aria-label="...">
            <ul class="pagination pagination-lg">
                <?php 
                    $currentPage = $list->currentPage();
                    $perPage = $list->perPage();
                    $lastPage = $list->lastPage();
                ?>
                @for($i=1; $i<=$lastPage; $i++)
                    <li class="page-item {{$i==$currentPage?'disabled':''}}"><a  tabindex="{{$i==$currentPage?'-1':''}}" class="page-link" href="{{route('files.show', $file->id . '?page=' . $i )}}">{{$i}}</a></li>
                @endfor
            </ul>
        </nav>

    </div>
</section>
@endsection