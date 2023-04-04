@extends('admin.layouts.main')

@section('content')

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Index Training</h2>
                

            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('trainings.create') }}"> Create Training</a>
            </div>
        </div>
    </div>

    <div class="float-right">
        <form action="" method="">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" value="{{ request()->get('keyword')}}"/>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>

    @if(session()->has('alert'))
        <div class="alert {{session()->get('alert-type') }}" role="alert">
            {{session()->get('alert') }}
        </div>
    @endif        

    <table class="table table-bordered">
        <thead>
            <tr>
                {{-- table punya tajuk kecik (selalu terbalik) --}}
                <th>ID</th>
                <th>Name</th>
                <th>Course</th>
                <th>Attachment</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            {{--ni akan buat table punya data--}}
            @forelse ($trainings as $training)
                <tr>
                    <td>{{ $training->id }}</td>
                    <td>{{ $training->name }}</td>
                    <td>{{ $training->course ? $training->course : 'No data' }}</td>
                    <td>{{ $training->attachment }}</td>
                    <td>
                        <form action="{{ route('trainings.destroy', $training->id) }}" method="POST">
                            <a class="btn btn-success" href="{{ route('trainings.show', $training->id)}}">Show</a>
                            <a class="btn btn-primary" href="{{ route('trainings.edit', $training->id)}}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    {{-- <title>{{ $training->name }}</title> --}}
                </tr>
            @empty
                <td>No data</td>
                <td>No data</td>
                <td>No data</td>
                <td>No data</td>
            @endforelse
        </tbody>
    </table>
</div>
{{-- {{ $trainings->links() }} --}}
{{ $trainings->appends(['keyword' => request()->get('keyword')])->links() }}
@endsection
