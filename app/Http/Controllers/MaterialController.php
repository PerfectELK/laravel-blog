<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use App\Comment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MaterialController extends Controller
{
    public function viewMaterial($id)
    {
        $material = Material::find($id);
        return view('material', compact('material'));
    }
    protected function create()
    {
        if($_POST['title'] == '' || $_POST['description'] == ''){
            echo "<strong style=\"color:red\">Введите все значения</strong>";
        } else {
            DB::table('materials')->insert([
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'status' => $_POST['status'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            echo "<strong style=\"color:green\">Успешно добавлено</strong>";
        }
    }
    protected function delete($id)
    {
        Material::destroy($id);
        Comment::where('parent_id', $id)->delete();
        $materials = Material::all();
        return(view('admin.home', compact('materials')));
    }
    protected function change($id)
    {
        $material = Material::find($id);
        return view('admin.change', compact('material'));
    }
}
