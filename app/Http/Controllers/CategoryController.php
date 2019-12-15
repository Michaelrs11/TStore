<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
use Storage;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->Category = new Category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data['categoriesData'] = $this->Category->get();

        return view('category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules = $request->validate([
            'name' =>['required','string','min:5'],
            'image' =>['mimes:png,jpg,jpeg','image']
        ]);

        if($request->hasFile('image')){
            $request->file('image')->storeAs('public/img',$request->image->getClientOriginalName());

            $rules['image'] = $request->image->getClientOriginalName();
        }
        $this->Category->create($rules);
        return redirect()->route('category.index')->with('success','successfully create Categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        
        $data['editData'] = $this->Category->findOrFail($id);

        return view('category.update',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $Category = $this->Category->findOrFail($id);

        $rules = $request->validate([
            'name' => ['required','string','min:5'],
            'image' => ['mimes:png,jpg,jpeg']
        ]);

        if($request->hasFile('image')){
            $request->file('image')->storeAs('public/img',$request->image->getClientOriginalName());

            $rules['image'] = $request->image->getClientOriginalName();
        }
        //update
        $Category->update($rules);

        return redirect()->route('category.index')->with('success','successfully update Categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //hapus
        $category = Category::find($id);
        $category->delete($id);
        return redirect()->route('category.index')->with('success','successfully delete Categories');
    }
}
