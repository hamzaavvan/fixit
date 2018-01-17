<?php

namespace Fixit\Http\Controllers;

use Illuminate\Http\Request;
use Fixit\Http\Requests\IssueFormRequest;
use Fixit\Issue;

class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::all();

    	return view('issue.index', compact('issues'));
    }

    public function create()
    {
        return view('issue.open');
    }

    public function view($slug)
    {
        $issue = Issue::whereSlug($slug)->firstOrFail();

        return view('issue.view', compact('issue'));
    }

    public function edit($slug)
    {
        $issue = Issue::whereSlug($slug)->firstOrFail();

        return view('issue.edit', compact('issue'));
    }

    public function store(IssueFormRequest $request)
    {
    	$slug = uniqid();
    	$issue = new Issue([
            'projectname' => $request->projectname,
    		'title' => ucwords($request->title),
            'description' => $request->description,
    		'summary' => $request->summary,
    		'fix' => $request->fix,
    		'fixed' => $request->fixed ? 1 : 0,
    		'slug' => $slug,
    	]);

    	$issue->save();

    	return redirect('/open-issue')->with('status', 'Your issue has been registered !');
    }

    public function update($slug, IssueFormRequest $request)
    {
        $issue = Issue::whereSlug($slug)->firstOrFail();
        $issue->projectname = $request->projectname;
        $issue->title = ucwords($request->title);
        $issue->description = $request->description;
        $issue->summary = ucfirst($request->summary);
        $issue->fix = $request->fix;
        $issue->fixed = $request->fixed == "on" ? 1 : 0;

        $issue->save();

        return redirect(action("IssueController@view", $issue->slug))->with('status', 'Your issue has been updated !');
    }
}
