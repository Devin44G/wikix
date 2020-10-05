<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Ordering projects by most recently created
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // CREATE PROJECT
        $project = new Project;
        $project->project_name = $request->input('project_name');
        $project->project_description = $request->input('project_description');
        $project->user_id = auth()->user()->id;
        $project->save();

        return redirect('/home')->with('success', 'Project Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return view('projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);

        // CHECK FOR CORRECT USER
        if(auth()->user()->id !== $project->user_id) {
          return redirect('/projects')->with('error', 'Unauthorized page');
        }

        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        // CHECK FOR CORRECT USER
        if(auth()->user()->id !== $project->user_id) {
          return redirect('/projects')->with('error', 'Unauthorized page');
        }

        // CREATE PROJECT
        $project->project_name = $request->input('project_name');
        $project->project_description = $request->input('project_description');
        $project->user_id = auth()->user()->id;
        $project->save();

        return redirect('/projects')->with('success', 'Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        // CHECK FOR CORRECT USER
        if(auth()->user()->id !== $project->user_id) {
          return redirect('/projects')->with('error', 'Unauthorized page');
        }

        $project->delete();
        return redirect('/projects')->with('success', 'Project Deleted');
  }
}
