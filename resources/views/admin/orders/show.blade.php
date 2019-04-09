@extends('layouts.app')

@section('header')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="{{ url('/') }}">
                                <small>Dashboard</small>
                            </a></li>
                        <li><a href="{{ url('/stock') }}">
                                <small>Stock</small>
                            </a></li>
                        <li class="active">
                            <small>edit</small>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content" style="background-color: white">
        

        <section class="invoice" style="margin: 20px">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-04">
                    <h2 class="page-header" >
                        <i class="fa fa-globe"></i> Fatima Collections
                    </h2>

                    
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">

                        <br>
                        <a href="{{ url('/order/shipping/'.$order->id) }}" target="_blank" ><button type="button" class="btn btn-primary" style="margin-right: 5px;">
                      
                            <i class="fa fa-print"></i> Shipping Badge
                        </button></a>
                    {{-- <address>
                        <strong>Fatima Collections</strong><br>
                    </address> --}}
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col pull-right">
                    <br>
                    <b>Order #:</b> {{ $order->id }}<br>
                    <b>Shipping Consignment #:</b> {{ $order->shipping_number }}<br>
                    <b>Date:</b> {{ date_format($order->created_at, "d/m/y")  }}<br>
                    <b>Client:</b> {{ clients()[$order->client_id] }}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="clearfix">
                <br>
            </div>
            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr style="height: 30px;">
                            <th>##</th>
                            <th>quantity</th>
                            <th>item</th>
                            <th>unit price</th>
                            <th>total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $detail)
                            <tr style="height: 5px">
                                <th>{{ $detail->orders_id}}</th>
                                <td style="">{{ $detail->quantity }}</td>
                                <td>{{ goods()[$detail->stock_id] }}</td>
                                <td>{{ number_format($detail->amount / $detail->quantity )}} PKR</td>
                                <td>{{ number_format($detail->amount) }} PKR</td>
                            </tr>

                        @endforeach
                        </tbody>
                        <tfoot>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>{{ number_format($order->total) }} PKR</th>
                        </tfoot>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="clearfix">
                <br>
                <br>
            </div>
            {{-- <div class="row">
                <!-- accepted payments column -->

                <!-- /.col -->
                <div class="col-xs-6" style="margin-left: 33%">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Montant Brut:</th>
                                <td>$250.30</td>
                            </tr>
                            <tr>
                                <th>TVA (9.3%)</th>
                                <td>$10.34</td>
                            </tr>
                            <tr>
                                <th>Montant à payer:</th>
                                <td>$265.24</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div> --}}
            <!-- /.row -->
            <br>
            <br>
{{-- 
            <div class="pull-right" style="margin-right: 20px">
                <small>Merci pour votre confiance</small>
            </div> --}}
            <br>
            <br>

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <a href="{{ url('/order/bill/'.$order->id) }}" target="_blank" ><button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                            <i class="fa fa-print"></i> Print
                        </button></a>
                         {{-- <a href="{{ url('order/delete/'.$order->id) }}" onclick="confirm('Are you sure you want to delete this order?');"><button type="button" class="btn btn-warning pull-left"><i class="fa fa-credit-card" onclick="con"></i>Delete Order
                        </button></a> --}}

                </div>
            </div>
        </section>

    </div>








@endsection