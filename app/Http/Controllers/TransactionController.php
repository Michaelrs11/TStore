<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fashion;
use App\Category;
use App\Store;
use App\Cart;
use App\Transaction;
use Auth;
use Storage;
class TransactionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        
        $this->Cart = new Cart();
        $this->Fashion = new Fashion();
        $this->Transaction = new Transaction();
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['transactionData'] =$this->Transaction->get();
        //get ganti ke paginate();
        return view('transaction.index',$data);
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
    public function store()
    {
        $data['transactionData'] = $this->Cart->where('user_id',auth()->user()->id)->get();

        foreach ($data['transactionData'] as $data){
            $insertData['user_id'] = auth()->user()->id;
            $insertData['fashion_id'] = $data->fashion_id;
            $insertData['quantity'] = $data->quantity;
            $this->Transaction->create($insertData);
        }
        $cart['cartData'] = $this->Cart->where('user_id',auth()->user()->id)->get();
        $this->Cart->destroy($cart);
        return redirect('home')->with('success','your order has been proceed');
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
        //
    }
}
