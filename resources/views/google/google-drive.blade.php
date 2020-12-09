@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <form action="/upload" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control" name="thing">
                    <input type="submit" class="btn btn-sm btn-block btn-danger" value="upload">
                </form>
            </div>
        </div>
    </div>
@endsection
