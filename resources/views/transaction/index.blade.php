@extends('layouts.app')

@section('content')
<!-- tampilin detail transactionnya -->
<div class="container">
    <div class="row justify-content-center">
     <div class="col-md-12">
            <div class="card">
                <div class="card-header">View Transaction</div>
                <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Pay</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($transactionData as $datas)
                    <tr>
                        <td> <b>{{$datas->fashion->name}}</b></td>
                        <td> <b>Rp. {{number_format($datas->fashion->price,0,'',',')}}</b> </td> 
                        <td> <b>{{$datas->quantity}}</b></td>
                        <th>
                        <b> Rp.  {{number_format($datas->fashion->price * $datas->quantity,0,'','.')}} </b>
                        </th>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection