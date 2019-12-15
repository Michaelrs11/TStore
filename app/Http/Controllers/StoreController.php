<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Fashion;
use Auth;
use Storage;

class StoreController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

        $this->Store = new Store();
        $this->Fashion = new Fashion();
    }

    public function index(){
        $data['storeData'] =$this->Store->where('user_id',auth()->user()->id)->first();

        if($data['storeData']){
            $data['fashionData'] = $this->Fashion->where('store_id',$data['storeData']->id)->paginate(10);
        }

        return view('store.index',$data);
    }

    public function create(){
        $data['storeData'] = $this->Store->where('user_id',auth()->user()->id)->first();

        //ngecek apakah si user udah punya store.
        if($data['storeData']){
            return redirect('store.index');

        }
        return view('store.create');
    }

    public function edit($id){
        $data['editData'] = $this->Store->findOrFail($id); //cari berdasarkan id
        return view('store.update', $data);
    }

    public function store(Request $request){
        $rules = $request->validate([
            'name'=>['required','min:5','string'],
            'image'=>['image','mimes:jpg,png,jpeg'],
            'address' =>['required','string','min:10'],
            'description'=>['required','string','min:20']
        ]);
        //cek id user yang lagi login
        $rules['user_id'] = auth()->user()->id;
        
        //simpen image di path yg dituju dgn nama originalnya
        if($request->hasFile('image')){
            $request->file('image')->storeAs('public/img',$request->image->getClientOriginalName());

            $rules['image'] = $request->image->getClientOriginalName();
            $this->Store->create($rules);
        }

        $this->Store->create($rules);

        return redirect()->route('store.index')->with('success','successfully create Store');
    }

    public function update(Request $request, $id){
        //nyari dulu Storenya berdasarkan id
        $Store = $this->Store->findOrFail($id);
        $rules = $request->validate([
            'name'=>['required','min:5','string'],
            'image'=>['image','mimes:jpg,png,jpeg'],
            'address' =>['required','string','min:10'],
            'description'=>['required','string','min:20']
        ]);
        //ngesave file image ke pathnya dgn nama original
        if($request->hasFile('image')){
            $request->file('image')->storeAs('public/img',$request->image->getClientOriginalName());

            $rules['image'] = $request->image->getClientOriginalName();
        }
        
        //update store apabila rulesnya terpenuhi semua
        $Store->update($rules);
        return redirect()->route('store.index')->with('success','successfully update Store');
    }

    public function destroy($id){
        $store = Store::find($id);
        $store->delete($id);
        return redirect()->route('store.index')->with('success','successfully delete Store');
    }
}
