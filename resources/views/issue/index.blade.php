@extends('layouts.app')
@section('title', 'Fixit | Issues')

@section('content')
<div class="container">
    <div class="row">
            
        <div class="searchbox-wrapper col-md-12">
            <form method="GET" role="search">
                <div class="input-group add-on">
                    <input class="form-control" placeholder="Search for issues . . ." name="search" id="srch-term" type="text" value="{{ request("search") }}" autocomplete="off">
                      
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
                    {!! session('status') !!}
                </div>
            @endif

            <div class="issuebtn">
                <a href="{{ action('IssueController@index') }}" class="badge badgeadge-primary">All</a>
                <a href="{{ action('IssueController@index', 'fixed') }}" class="badge badge-success">Fixed</a>
                <a href="{{ action('IssueController@index', 'not-fixed') }}" class="badge badge-warning">Not Fixed</a>
            </div>
            
            <div class="panel panel-default">
                @if (request('search'))
                    <div class="panel-heading">
                        <a class="back" href="{{ url('/issues') }}">
                            <i class="glyphicon glyphicon-chevron-left"></i>
                             {{ !empty(request('slug')) ? request('slug') : "All Issues" }} 
                             ({{ count($issues) }} Found)
                        </a>
                    </div>
                @else
                    <div class="panel-heading">
                        {{ !empty(request('slug')) ? ucwords(str_replace('-', ' ', request('slug'))) : "All Issues" }} 
                        ({{ count($issues) }} Found)
                    </div>
                @endif

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
