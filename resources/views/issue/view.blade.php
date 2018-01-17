@extends('layouts.app')
@section('title', "Fixit | $issue->title")

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="panel panel-default view-issue">
                <div class="panel-heading">
                    <a class="back" href="{{ url('/issues') }}">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Issue #{{ $issue->id }}
                    </a>
                </div>

                <div class="panel-body">
                    @if ($issue->fixed)
                        <div class="summary-wrapper alert alert-success">
                            <p><strong>Summary:</strong> {{ $issue->summary }}</p>
                        </div>
                    @endif

                    <h3 class="issue-title">{{ $issue->title }}</h3>
                    <div class="issue-desc">{{ $issue->description }}</div>
                    <div class="fix">
                        <h4>Fix: </h4>

                        @if (empty($issue->fix) || $issue->fix == null)
                            <p>No Fix Yet</p>
                        @else
                            <pre><code class="php">{{ $issue->fix }}</code></pre>
                        @endif
                    </div>
                    <div class="side-info">
                        <span class="created_at badge badge-secondary">{{ toDate($issue->created_at) }}</span>

                        @if ($issue->fixed)
                            <span class="badge badge-success">Fixed</span>
                        @else
                            <span class="badge badge-warning">Not Fixed</span>
                        @endif

                        <a href="{{ action("IssueController@edit", $issue->slug) }}" class="goto-edit">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        
                        <span class="created_at badge badge-primary pull-right">{{ $issue->projectname }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
