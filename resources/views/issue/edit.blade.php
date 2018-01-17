@extends('layouts.app')
@section('title', "Fixit | Edit $issue->title")

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="back" href="{{ action("IssueController@view", $issue->slug) }}">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Edit Issue #{{ $issue->id }}
                    </a>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal issue-form" method="POST" action="{{ action('IssueController@update', $issue->slug) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('projectname') ? ' has-error' : '' }}">
                            <label for="projectname" class="col-md-1 control-label">Project</label>

                            <div class="col-md-12">
                                <input id="projectname" type="projectname" class="form-control" name="projectname" value="{{ $issue->projectname }}" required>

                                @if ($errors->has('projectname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('projectname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Case Title</label>

                            <div class="col-md-12">
                                <input id="title" type="title" class="form-control" name="title" value="{{ $issue->title }}" required autofocus>

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
                                <textarea id="description" type="description" class="form-control" name="description" required>{{ $issue->description }}</textarea>

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
                                <textarea id="fix" type="fix" class="form-control" name="fix">{{ $issue->fix }}</textarea>

                                @if ($errors->has('fix'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fix') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check col-md-5">
                                <input class="form-check-input" type="checkbox" id="fixed" name="fixed" {{ $issue->fixed ? "checked" : "" }}>
                                
                                <label class="form-check-label" for="fixed">
                                    Fixed <span class="label label-primary">Optional</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
