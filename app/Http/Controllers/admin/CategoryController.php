<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('position','ASC')->get();
        return view('admin.category.category_view',compact('category'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'category_id' => 'required|numeric',
            'category_name' => 'required|string',
            'position' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 2,
                'message' => 'Error Occured',
                'errors' => $validator->errors()
            ]);
        }

        $category = Category::find($request->category_id);

        $category->category_name = $request->category_name;
        $category->note = $request->note;
        $category->position = $request->position;
        

        if($category->save()){
            return response()->json(['status' => 1 , 'data' => $category]);
        }else{
            return response()->json(['status' => 0]);
        }
        
    }

    public function status_update(Request $request)
    {
        $category_status = Category::where('id',$request->id)->update([
            'status' => $request->update
        ]);

        if($category_status){
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }


    public function delete(Request $request)
    {
        $category_delete = Category::where('id',$request->id)->delete();

        if($category_delete){
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }

    public function category_add()
    {
        return view('admin.category.category_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'position' => 'required|numeric',
        ]);
        
        $category_add = Category::create([
            'category_name' => $request->category_name,
            'position' => $request->position,
            'note' =>  $request->note
        ]);

        if($category_add){
            return redirect('category')->with('success','New category added successfully');
        }else{
            return redirect()->back()->with('error','Some error occured');
        }
    }
}
