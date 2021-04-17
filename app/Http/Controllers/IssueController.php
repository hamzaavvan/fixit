<?php

namespace Fixit\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Fixit\Http\Requests\IssueFormRequest;
use Fixit\Issue;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    public function index($view = '', Request $request)
    {
        DB::enableQueryLog();
        $id = Auth::id() ?? null;

        if (!empty($request->search)) {
            $search = $request->search;
            $issues = $this->search($search, $view, $id);
        } else {
            switch ($view) {
                case 'fixed':
                    $type = 1;
                    break;
                
                case 'not-fixed':
                    $type = 0;
                    break;

                default:
                    $type = null;
            }
            
            $issues = Issue::where('visibility', 1);
            $userIssues = Issue::where("user_id", $id);

            if ($type!==null) {
                $issues = $issues->where('fixed', $type);

                $userIssues = $userIssues->where("fixed", $type);
            }
            
            $issues->orWhereIn('id', $userIssues->get(['id']))
                    ->orderBy("created_at", "DESC");
            
            $issues = $issues->get();
        }

        return view('issue.index', compact('issues'));
    }

    public function create()
    {
        return view('issue.open');
    }

    public function view($slug)
    {
        $id = Auth::id() ?? null;
        $issue = Issue::whereSlug($slug)->firstOrFail();
        $issue->owner = $issue->user_id==$id ? 1 : 0;
    
        return view('issue.view', compact('issue'));
    }

    public function edit($slug)
    {
        $id = Auth::id() ?? null;
        $issue = Issue::whereSlug($slug)->where("user_id", $id)->firstOrFail();

        if (!$issue) return redirect(action("IssueController@view", $issue->slug))->with('status', 'You don\'t have required permissions!');
    
        return view('issue.edit', compact('issue'));
    }

    public function store(IssueFormRequest $request)
    {
    	$slug = uniqid();
        $id = Auth::id() ?? null;
    	$issue = new Issue([
            'projectname' => $request->projectname,
    		'title' => ucwords($request->title),
            'description' => $request->description,
    		'summary' => ucfirst($request->summary),
    		'fix' => $request->fix,
            'user_id' => $id,
    		'fixed' => $request->fixed ? 1 : 0,
    		'visibility' => $request->public=="on" ? 1 : 0,
    		'slug' => $slug,
    	]);

    	$issue->save();

        $link = "<a href=\"".action("IssueController@view", $slug)."\">$slug</a>";
    	return redirect('/open-issue')->with('status', "Your issue $link has been registered !");
    }

    public function update($slug, IssueFormRequest $request)
    {
        $id = Auth::id() ?? null;
        $issue = Issue::whereSlug($slug)->where("user_id", $id)->firstOrFail();

        if (!$issue) return redirect(action("IssueController@view", $issue->slug))->with('status', 'You don\'t have required permissions!');
        $issue->projectname = $request->projectname;

        $issue->title = ucwords($request->title);
        $issue->description = $request->description;
        $issue->summary = ucfirst($request->summary);
        $issue->fix = $request->fix;
        $issue->visibility = $request->public=="on" ? 1 : 0;
        $issue->fixed = $request->fixed == "on" ? 1 : 0;
        $issue->user_id = $issue->user_id;

        $issue->save();

        return redirect(action("IssueController@view", $issue->slug))->with('status', 'Your issue has been updated !');
    }

    protected function search($keyword, $view = '', $id = null)
    {        
        switch ($view) {
            case 'fixed':
                $type = 1;
                break;
            
            case 'not-fixed':
                $type = 0;
                break;

            default:
            $type = null;
        }

        $issues = Issue::where('visibility', 1)
                        ->where("title", "like", "%$keyword%");

        $userIssues = Issue::where("title", "like", "%$keyword%")
                            ->where("user_id", $id);

        
        if ($type!=null) $issues = $issues->where('fixed', $type);
        $issues->orWhereIn('id', $userIssues->get(['id']));

        $issues = $issues->get();
        return $issues;
    }

    public function delete($slug)
    {
        $id = Auth::id() ?? null;
        $issue = Issue::whereSlug($slug)
                            ->where("user_id", $id)->firstOrFail();

        if ($issue) {
            $issue->delete();

            return redirect("/issues")->with('status', "Issue <b>$slug</b> has been deleted");
        } else {
            return redirect("/issues")->with('status', 'No issue exists or permissions required!');
        }
    }
}