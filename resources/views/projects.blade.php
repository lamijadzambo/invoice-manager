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
                                <label for="project" class="col-md-4 col-form-label text-md-right">{{ __('Shop:') }}</label>
                                <div class="col-md-6">
                                    <select name="projects" id="project" class="form-control" onchange="doUrl(event) " required>
                                        <option id="value" value="" selected hidden>Choose shop</option>
                                        @foreach($projects as $project)
                                            <option id="value" value="{{ $project->id }} ">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="next" class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button><a id="linkNext" href="">Next</a></button>
                                </div>
                            </div>
                            <label id="result"></label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function doUrl(e){
        $('#linkNext').attr('href','/index/'+e.target.value);
    }
</script>













