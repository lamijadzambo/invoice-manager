@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 200px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Choose shop') }}</div>
                    <div class="card-body">
                        <form method="GET" role="form">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <select name="projects" id="project" class="form-control" onchange="doUrl(event)">
                                        <option value="" selected disabled hidden>Choose shop</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }} ">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button><a id="linkNext" href="{{ url('index/'. $project->id) }}">Next</a></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




<script>
    function doUrl(e){
        $('#linkNext').attr('href','/index/'+e.target.value)
    }
</script>
