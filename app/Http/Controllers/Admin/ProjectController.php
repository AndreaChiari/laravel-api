<?php


namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::all();
        $technologies = Technology::select('id', 'label')->orderBy('id')->get();
        return view('admin.projects.create', compact('project', 'technologies', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate(
            [
                'name' => 'required|string|min:3|max:50',
                'description' => 'required|string',
                'linkedin' => 'required|string',
                'github' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,jpg,png',
                'technologies' => 'nullable|exists:technologies,id'
            ],
            [
                'name.required' => 'la voce name deve essere obbligatoria',
                'name.unique' => "esiste gia un progetto dal nome $request->name.",
                'image.image' => 'L\'immagine deve eddere fil di tipo immagine',
                'technologies' => 'le tecnologie selezionate non sono valide'
            ]
        );


        $project = new Project();
        if (array_key_exists('image', $data)) {
            $image_url = Storage::put('projects', $data['image']);
            $data['image'] = $image_url;
        }

        $project->fill($data);
        $project->save();
        $project->technologies()->attach($data['technologies']);
        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::select('id', 'label')->orderBy('id')->get();
        return view('admin.projects.edit', compact('project', 'technologies', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->all();

        if (array_key_exists('image', $data)) {
            if ($project->image) Storage::delete($project->image);
            $image_url = Storage::put('projects', $data['image']);
            $data['image'] = $image_url;
        }
        $data['type_id'] = intval($data['type_id']);
        $project->update($data);

        $project->technologies()->sync($data['technologies']);
        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Project::destroy($id);

        return to_route('admin.projects.index')->with('delete', 'tool eliminato con successo');
    }
}
