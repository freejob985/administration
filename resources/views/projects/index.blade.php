@foreach ($projects as $project)
<div class="col-md-4" id="project-{{ $project->id }}">
    @include('projects.show', ['project' => $project])
</div>
@endforeach
