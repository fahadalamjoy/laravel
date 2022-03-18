<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class BrandController extends Controller
{
    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

    public function StoreBrand(Request $request){
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
            
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_image.min' => 'Brand Longer then 4 Characters', 
        ]);

        $brand_image =  $request->file('brand_image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);

        // $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        // Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = '/image/brand/'.$name_gen;
 
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);
         
        // $notification = array(
        //     'message' => 'Brand Inserted Successfully',
        //     'alert-type' => 'success'
        // );

        return Redirect()->back()->with('success','Brand Inserted Succesfully');

    }

    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    public function Update(Request $request, $id){
        $validatedData = $request->validate([
            'brand_name' => 'required|min:4',
            
            
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            
        ]);

        $old_image = $request->old_image;

        $brand_image =  $request->file('brand_image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);

        // $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        // Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = '/image/brand/'.$name_gen;
 

        // unlink($old_image);

        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);
         
        // $notification = array(
        //     'message' => 'Brand Inserted Successfully',
        //     'alert-type' => 'success'
        // );

        return Redirect()->back()->with('success','Brand Updated Succesfully');

    }

    public function Delete($id){
         $image = Brand::find($id);
         $old_image = $image->brand_image;
        //  unlink($old_image);

        Brand::find($id)->delete();
        // $notification = array(
        //     'message' => 'Brand Delete Successfully',
        //     'alert-type' => 'error'
        // );   
        return Redirect()->back()->with('success','Brand Updated Succesfully');


     }
}