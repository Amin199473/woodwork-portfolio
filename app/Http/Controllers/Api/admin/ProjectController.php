<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Category;
use App\Models\ImageGallery;
use App\Models\Project;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller
{
    public function getProjectGalleries()
    {
        $galleries = Category::where("model_type", 'پروژه ها')->has("projects")->with(["projects.galleries"])->get();
        return response()->json(["projectGalleries" => $galleries], 200);
    }

    public function getRandProject(){
        $randProject = Project::with(['galleries'])->inRandomOrder()->limit(5)->get();
        return response()->json(["randProject" => $randProject], 200);
    }

    public function getPojectCategories()
    {
        $categories = Category::has('projects')->with(['projects.galleries'])->orderBy('name', 'ASC')->where('model_type', 'پروژه ها')->get();
        return response()->json(["categories" => $categories], 200);
    }

    public function index()
    {
        $projects = Project::orderBy('id', 'DESC')->with(['category', 'galleries'])->paginate(9);
        return response()->json(["projects" => $projects], 200);
    }

    public function store(StoreProjectRequest $request)
    {
        $project = new Project();
        $project->category_id = $request->category_id;
        $project->name = $request->name;
        $project->material = $request->material;
        $project->short_description = $request->short_description;
        $project->status = $request->status;
        $project->description = $request->description;
        $project->save();

        if ($request->files) {

            foreach ($request->files as $image) {
                $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $img = Image::make($image)->resize(800, 600);
                $upload_path = 'upload/project/';
                $image_url = $upload_path . $name;
                $img->save($image_url);

                $imageGallery = new ImageGallery();
                $imageGallery->image = "/" . $image_url;
                $imageGallery->project_id = $project->id;
                $imageGallery->save();
            }
        }

        return response()->json(["message" => ".پروژه با موفقیت ایجاد شد"], 200);
    }

    public function show(Project $project)
    {
        return response()->json(["project" => $project, "galleries" => $project->galleries], 200);
    }

    public function editProject(StoreProjectRequest $request, $id)
    {

        $project = Project::find($id);
        $project->category_id = $request->category_id;
        $project->name = $request->name;
        $project->material = $request->material;
        $project->short_description = $request->short_description;
        $project->status = $request->status;
        $project->description = $request->description;
        $project->save();

        if ($request->files) {
            foreach ($request->files as $image) {
                $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $img = Image::make($image)->resize(800, 600);
                $upload_path = 'upload/project/';
                $image_url = $upload_path . $name;
                $img->save($image_url);

                $imageGallery = new ImageGallery();
                $imageGallery->image = "/" . $image_url;
                $imageGallery->project_id = $project->id;
                $imageGallery->save();
            }
        }

        return response()->json(["message" => ".پروژه با موفقیت ویرایش شد"], 200);
    }

    public function destroy(Project $project)
    {
        foreach ($project->galleries as $gallery) {
            $realPath = ltrim($gallery->image, "/");
            @unlink($realPath);
            $gallery->delete();
        }
        $project->delete();
        return response()->json(["message" => ".پروژه با موفقیت حذف شد"], 200);
    }

    public function DeleteImageGallery($id)
    {

        $imageGallery = ImageGallery::find($id);
        if ($imageGallery) {
            $realPath = ltrim($imageGallery->image, "/");
            @unlink($realPath);
            $imageGallery->delete();
        }
        return response()->json(["message" => "حذف به درستی انجام شد"], 200);
    }

}
