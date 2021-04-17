@extends('layouts.app')
@section('title', "Fixit | $issue->title")

@section('content')

<?php use Fixit\Helpers\Markdown; ?>

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

                            <?php 
                                $summary = Markdown::link($issue->summary);
                                $summary = Markdown::highlight($summary);
                            ?>

                            <p><strong>Summary:</strong> {!! Markdown::bold($summary) !!}</p>
                        </div>
                    @endif

                    <h3 class="issue-title">{{ $issue->title }}</h3>

                    <?php 
                        $description = Markdown::link($issue->description);
                        $description = Markdown::bold($description);
                    ?>

                    <div class="issue-desc">{!! nl2br($description) !!}</div>
                    <div class="fix">
                        <h4>Fix: </h4>

                        @if (empty($issue->fix) || $issue->fix == null)
                            <p>No Fix Yet</p>
                        @else
                            <pre><code class="php">{{ $issue->fix }}</code></pre>
                        @endif
                    </div>
                    <div class="side-info">
                        <span class="created_at badge badge-secondary">{{ time_elapsed_string($issue->created_at) }}</span>

                        <span class="badge badge-{{ $issue->fixed ? 'success' : 'warning'}}">{{ $issue->fixed ? 'Fixed' : 'Not Fixed'}}</span>
                        <span class="created_at badge badge-primary">{{ $issue->visibility ? "Public" : "Private" }}</span>

                        @if ($issue->owner)
                            <a href="{{ action('IssueController@edit', $issue->slug) }}" class="goto-edit">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>

                            <a href="{{ action('IssueController@delete', $issue->slug) }}" class="delete-issue">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        @endif
                        
                        <span class="created_at badge badge-primary pull-right">{{ $issue->projectname }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
