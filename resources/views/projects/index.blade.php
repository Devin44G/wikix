@extends('layouts.app')

@section('content')
  <h1>Projects Go Here</h1>
  @if (count($projects) > 0)
    @foreach ($projects as $project)
      <div class="container">
        <h2>{{$project->project_name}}</h2>
      </div>
    @endforeach
  @endif
@endsection
