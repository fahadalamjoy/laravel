<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function AllCat(){
        $category = Category::latest()->paginate(5); //eloquent ORM
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        
        // // $category = DB::table('categories')->latest()->get(); Query Builder
        // // $category = DB::table('categories')
        //              ->join('users','categories.user_id','users.id')
        //              ->select('categories.*','users.name')
        //              ->latest()->paginate(5);

        return view('admin.category.index',compact('category','trashCat'));
    }
    public function AddCat(Request $request){
        $validated = $request->validate([
        'category_name' => 'required|unique:categories|max:255',
        
    ],
    [
        'category_name.required' => 'please Input Category Name',
    ]);

    Category::insert([
        'category_name' => $request->category_name,
        'user_id' => Auth::user()->id,
        'created_at'=> Carbon::now()
    ]);

    return Redirect()->back()->with('success','Category Inserted Succesfully');


    }

    public function Edit($id){
        $categories = Category::find($id);
        return view('admin.category.edit',compact('categories'));
    }

    
    public function Update(Request $request, $id){
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,

        ]);
        return Redirect()->route('all_category')->with('success','Category Updated Succesfully');
    }

    public function SoftDelete( $id){
        $update = Category::find($id)->delete();
        return Redirect()->back()->with('soft','Category SoftDelete Succesfully');
    }
    
    public function Restore( $id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('soft','Restore Succesfully');
    }

    public function Pdelete( $id){
        $pdelete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('soft','PDelete Succesfully');
    }

}