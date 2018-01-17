@extends('layouts.app')
@section('title', 'Fixit | Issues')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">All Issues</div>

                <div class="panel-body">
                    @if(count($issues))
                        @foreach($issues as $issue)
                            <a class="issue-tag-link" href="{{ action('IssueController@view', $issue->slug) }}">
                                <h3 class="issue-title">{{ $issue->title }}</h3>
                                <div class="issue-desc">{{ ucfirst($issue->description) }}</div>
                                <div class="side-info">
                                    <span class="created_at badge badge-secondary">{{ toDate($issue->created_at) }}</span>

                                    @if ($issue->fixed)
                                        <span class="badge badge-success">Fixed</span>
                                    @else
                                        <span class="badge badge-warning">Not Fixed</span>
                                    @endif

                                </div>
                            </a>
                        @endforeach
                    @else
                        <div>
                            <p>No issues right now</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
