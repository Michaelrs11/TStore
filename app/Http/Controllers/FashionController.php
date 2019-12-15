<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Fashion;
use App\Category;
use App\Cart;
use Auth;
use Storage;

class FashionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

        $this->Fashion = new Fashion();
        $this->Store = new Store();
        $this->Category = new Category();
        $this->Cart = new Cart();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data['store'] = $this->Store->where('user_id', auth()->user()->id)->first(); // cari berdasarkan id user 
        
        return view('fashion.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $data['category'] = $this->Category->get();
    	$data['store'] = $this->Store->where('user_id', auth()->user()->id)->first();

        return view('fashion.create', $data);
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
            'category_id' =>['required'],
            'price' => ['required','numeric','min:20000'],
            'stock' => ['required','numeric','min:1'],
            'description' => ['required','string','min:20'],
            'store_id'=>['required'],
            'image' =>['image','mimes:png,jpg,jpeg']
        ]);

        if($request->hasFile('image')){
            $request->file('image')->storeAs('public/img',$request->image->getClientOriginalName());

            $rules['image'] = $request->image->getClientOriginalName();
        }
        $this->Fashion->create($rules);
        return redirect()->route('store.index')->with('success','successfully create Product');
    }

    public function group($name, Request $request){
        if(auth()->user()->role == 'admin'){
            $data['admin'] = true;
        }else{
            $data['admin'] = false;
        }

        $category_id = $this->Category->where('name',$name)->pluck('id')->first();

        if(isset($request->search)){
            $search = $request->search;

            $data['fashionData'] = $this->Fashion->with('store','category')->where([
                ['category_id',$category_id],
                ['name','LIKE',"%{$search}%"],
            ])->orWhereHas('store',function($q) use($search){
                $q->where('name','LIKE',"%{$search}%");
            })->get();
        }else{
            $data['fashionData'] = $this->Fashion->with('store','category')->where('category_id',$category_id)->paginate(10);
        }
        return view('fashion.group',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $data['showData'] = $this->Fashion->where('id',$id)->with('store','category')->first();

        $data['already_add_to_cart'] = $this->Cart->where([['fashion_id',$id],['user_id',auth()->user()->id]])->get()->first();

        return view('fashion.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $data['category'] = $this->Category->get();
        $data['store'] = $this->Store->where('user_id', auth()->user()->id)->first();
        $data['showData'] = $this->Fashion->findOrFail($id); //cari berdasarkan id
        return view('fashion.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $Fashion = $this->Fashion->findOrFail($id);

        $rules = $request->validate([
            'name' =>['required','string','min:5'],
            'category_id' =>['required'],
            'price' => ['required','numeric','min:20000'],
            'stock' => ['required','numeric','min:1'],
            'description' => ['required','string','min:20'],
            'store_id'=>['required'],
            'image' =>['image','mimes:png,jpg,jpeg']
        ]);
        if($request->hasFile('image')){
            $request->file('image')->storeAs('public/img',$request->image->getClientOriginalName());

            $rules['image'] = $request->image->getClientOriginalName();
        }
        $Fashion->update($rules);
        return redirect()->route('store.index')->with('success','successfully update Product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //hapus
        $fashion = Fashion::find($id);
        $fashion->delete($id);
        return redirect()->route('store.index')->with('success','successfully delete Product');
        
    }
}
