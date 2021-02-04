<?php

namespace Fixit\Http\Controllers;

use Illuminate\Http\Request;
use Fixit\Http\Requests\IssueFormRequest;
use Fixit\Issue;

class IssueController extends Controller
{
    public function index($view = '', Request $request)
    {
        if (!empty($request->search)) {
            $search = $request->search;
            $issues = $this->search($search, $view);

        } else {
            switch ($view) {
                case 'fixed':
                    $issues = Issue::where([
                        ['fixed', '=', 1],
                        ['user_id', '=', Auth::user()->id]
                    ])->get();
                    break;
                
                case 'not-fixed':
                    $issues = Issue::where([
                        ['fixed', '=', 0],
                        ['user_id', '=', Auth::user()->id]
                    ])->get();
                    break;

                default:
                    $issues = Issue::where('user_id', Sentry::getUser()->id)->get();
            }
        }

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
    		'summary' => ucfirst($request->summary),
    		'fix' => $request->fix,
    		'fixed' => $request->fixed ? 1 : 0,
    		'slug' => $slug,
    	]);

    	$issue->save();

        $link = "<a href=\"".action("IssueController@view", $slug)."\">$slug</a>";
    	return redirect('/open-issue')->with('status', "Your issue $link has been registered !");
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

    protected function search($keyword, $view = '')
    {
        switch ($view) {
            case 'fixed':
                $issues = Issue::where("title", "like", "%$keyword%")->where('fixed', 1)->get();
                break;
            
            case 'not-fixed':
                $issues = Issue::where("title", "like", "%$keyword%")->where('fixed', 0)->get();
                break;

            default:
            $issues = Issue::orwhere([
                ["title", "like", "%$keyword%"],
                ["description", "like", "%$keyword%"],
            ])->get();
        }

        return $issues;
    }

    public function delete($slug)
    {
        $issue = Issue::whereSlug($slug);

        if ($issue) {
            $issue->delete();

            return redirect("/issues")->with('status', "Issue <b>$slug</b> has been deleted");
        } else {
            return redirect("/issues")->with('status', 'No issue exists');
        }
    }
}