@extends('admin.layouts.main')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Detail Training</h2>
            </div>
            <div class="pull-right ">
                <a class="btn btn-primary" href="{{ route('trainings.index') }}"
enctype="multipart/form-data">
                    Back</a>
            </div>
        </div>
    </div>
    <form action="{{ route('trainings.update', $training->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-mid-12">
                <div class="form-group">
                    <strong>Book Title:</strong>
                    <input type="text" name="name" value="{{ $training->name }}"
class="form-control"
                        placeholder="Book Title" readonly>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-mid-12">
                <div class="form-group">
                    <strong>Book Description:</strong>
                    <textarea name="course" class="form-control" placeholder="Book Description" readonly>{{ $training->course }}</textarea>
                </div>
            </div>

            @if ($training->attachment)
                <div class="form-group">
                    <label>Attachment: (if any)</label>
                    <a
                        target="_blank"
                        href="{{ asset('storage/'.$training->attachment) }}"
                        class="btn btn-warning">

                        Open this attachment: {{ $training->attachment }}
                    </a>
                </div>
            @endif

        </div>
    </form>
</div>
@endsection
