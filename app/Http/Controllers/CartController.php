<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fashion;
use App\Category;
use App\Store;
use App\Cart;
use Auth;
use Storage;


class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        
        $this->Cart = new Cart();
        $this->Fashion = new Fashion();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //nyari data
        $data['cartData'] =$this->Cart->with('fashion')->where('user_id',auth()->user()->id)->get();
        
        return view('cart.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $request->validate([
            'fashion_id' => 'required',
            'quantity' => 'required'
        ]);

        $rules['user_id'] = auth()->user()->id;

        //create
        $this->Cart->create($rules);

        return redirect()->route('cart.index');

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus
        $this->Cart->destroy($id);

        return redirect()->route('cart.index');
    }
}
