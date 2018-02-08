@extends('layouts.app')
@section('title', 'Open Issue')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (!empty(session('status')))
                <div class="alert alert-success">
                    {!! session('status') !!}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Open Issue</div>

                <div class="panel-body">
                    <form class="form-horizontal issue-form" method="POST" action="{{ route('open-issue') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="projectname" class="col-md-1 control-label">Project</label>

                            <div class="col-md-12">
                                <input id="projectname" type="projectname" class="form-control" name="projectname" value="{{ old('projectname') }}" required autofocus>

                                @if ($errors->has('projectname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('projectname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Case Title</label>

                            <div class="col-md-12">
                                <input id="title" type="title" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-2 control-label">Description</label>

                            <div class="col-md-12">
                                <textarea id="description" type="description" class="form-control" name="description" required></textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fix') ? ' has-error' : '' }}">
                            <label for="fix" class="col-md-1 control-label">Fix</label>

                            <div class="col-md-12">
                                <textarea id="fix" rows="6" class="form-control" name="fix"></textarea>

                                @if ($errors->has('fix'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fix') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('summary') ? ' has-error' : '' }}">
                            <label for="summary" class="col-md-1 control-label">Summary</label>

                            <div class="col-md-12">
                                <textarea id="summary" class="form-control" name="summary"></textarea>

                                @if ($errors->has('summary'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('summary') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check col-md-5">
                                <input class="form-check-input" type="checkbox" id="fixed" name="fixed">
                                
                                <label class="form-check-label" for="fixed">
                                    Fixed <span class="label label-primary">Optional</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
