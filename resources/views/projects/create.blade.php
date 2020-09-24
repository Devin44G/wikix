@extends('layouts.app')

@section('content')
  <h1>Create New Project</h1>
  <form class="form" action="{{ route('projects.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="proj_name">Project Name *</label>
      <input type="text" class="form-control" id="proj_name" name="project_name">
    </div>
    <div class="form-group">
      <label for="proj_desc">Project Description</label>
      <input type="text" class="form-control" id="proj_desc" name="project_description">
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>

@endsection
