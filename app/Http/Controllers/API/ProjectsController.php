<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Projects\CreateProjectRequest;
use App\Http\Requests\API\Projects\SearchProjectsRequest;
use App\Http\Requests\API\Projects\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends BaseController
{
  protected $project;

  public function __construct(Project $project)
  {
    $this->project = $project;
  }

  public function search(SearchProjectsRequest $request)
  {
    $query = $this->project::query();

    if ($request->input('userId')) {
      $query->where('user_id', $request->input('userId'));
    }

    if ($keyword = $request->input('keyword')) {
      $query->where(function ($query) use ($keyword) {
        $query->where('name', 'like', "%$keyword%")
          ->orWhere('description', 'like', "%$keyword%");
      });
    }

    return $this->returnSuccess(['projects' => $query->paginate(25)]);
  }

  public function create(CreateProjectRequest $request)
  {
    $project = $request->user()->projects()->create($request->all());
    return $this->returnSuccess(compact('project'));
  }

  public function update(UpdateProjectRequest $request, Project $project)
  {
    $user = $request->user();
    if ($user->cannot('update', $project)) {
      return $this->returnError('You can not update this project.', 403);
    }

    $project->update($request->all());

    return $this->returnSuccess(compact('project'));
  }

  public function delete(Project $project)
  {
    $user = auth()->user();
    if ($user->cannot('delete', $project)) {
      return $this->returnError('You can not delete this project.', 403);
    }

    $result = $project->delete();

    return $this->returnSuccess(compact('result'));
  }

  public function get(Project $project)
  {
    $user = auth()->user();
    if ($user->cannot('view', $project)) {
      return $this->returnError('You can not view this project', 403);
    }

    return $this->returnSuccess(compact('project'));
  }
}
