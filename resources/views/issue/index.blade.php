@extends('layouts.app')
@section('title', 'Fixit | Issues')

@section('content')
<div class="container">
    <div class="row">
            
        <div class="searchbox-wrapper col-md-12">
            <form role="search">
                <div class="input-group add-on">
                    <input class="form-control" placeholder="Search for issues . . ." name="srch-term" id="srch-term" type="text">
                      
                    <div class="input-group-btn">
                        <button class="btn btn-default" id="search" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            <div class="panel panel-default">
                <div class="panel-heading">All Issues ({{ count($issues) }} Found)</div>

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

                                    <span class="created_at badge badge-primary pull-right">{{ $issue->projectname }}</span>
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
