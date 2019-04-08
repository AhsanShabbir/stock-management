@extends('layouts.app')

@section('header')
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
                        <li><a href="{{ url('/clients') }}">
                                <small>Orders</small>
                            </a></li>
                        <li class="active">
                            <small>Add</small>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <input id="stat" type="text" style="display: none" />

        <div class="row">
            <div class="col-lg-6">
                <div class="card" style="width:100%">
                    <div class="card-header">
                            New Order
                    </div>
                    <div class="card-body">
                        <!-- Credit Card -->
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div style="text-align: center">
                                    <h3>Make Sale</h3>
                                </div>
                                <div>
                                    <p id="errors"></p>
                                </div>
                                <br>
                                {{ Form::open(['url' => url('/orders/add'), 'method' => 'post', 'id'=>'orderForm']) }}
                                    <input type="hidden" id="total" name="total" value="">
                                    @include('admin.orders.form')
                                    <input type="submit" style="display: none">

                                {{ Form::close() }}


                                <div class="pull-right">
                                    <button type="submit" class="btn btn-sm btn-info " id="button" >
                                        Calculate Total Amount
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-info " id="addOne" >
                                        Add more Items
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-info "  id="check" >
                                        Check quantity
                                    </button>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div>
                            

                            <div>
                                <button id="submitform" class="amount btn btn-lg btn-primary btn-block" >
                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                    <span id="payment-button-amount ">Save </span>
                                </button>
                            </div>

                            

                        </div>
                    </div>
                </div> <!-- .card -->

            </div>
        </div>

    </div>




@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script>
        $(document).ready(function(){

            $("#button").click(function(){
                let count = $('input').length - 5;
                let price = 0;
                let stock = 0;
                let quantity = [];
                let goods = [];

                $("input[name='quantity[]']").each(function() {
                    quantity.push($(this).val());
                });
                $("select[name='stock[]']").each(function() {
                    goods.push($(this).val());
                });

                for (let i = 0; i < count; i++) {

                    $.get("{{ url('/orders/price/') }}/"+goods[i], function(response){
                        price += response.selling_price * quantity[i];
                        let icon = '<i class="fa fa-lock fa-lg"></i>&nbsp;\n';
                        $('.amount').html(icon+" Total "+price+" PKR");
                        $("#total").val(price);
                    });
                }

            });

            $("#check").click(function () {
               
                let stock = 0;
                let quantity = [];
                let goods = [];
                let count = $('input').length - 5;
                let status = 0;
                let errors = 0

                console.log($('input').length);

                $("select[name='stock[]']").each(function() {
                    goods.push($(this).val());
                });
                $("input[name='quantity[]']").each(function() {
                    quantity.push($(this).val());
                });
                for (let i = 0; i < count; i++){
                    $.get("{{ url('/orders/price/') }}/"+goods[i], function(response){
                        if (quantity[i] > response.quantity ){
                            let error = '<strong id="oldError" style="color: red">**There is not enough  '+response.goods_name+' in the stock'+ '\n Available quantity is:'+response.quantity+'</strong>'
                            $("#errors").html(error);
                            status = 1;
                            errors = 1;
                        }else {
                            let final = count - i;
                            if (final == 1 & status == 0 & quantity[i] != '' & quantity[i] != 0 ){
                                $("#errors").html('<strong id="oldError" style="color: blue">All Items available!</strong>')
                            }else if(final == 1 & status == 0 & quantity[i] == '' | quantity[i] == 0){
                                $("#errors").html('<strong id="oldError" style="color: red">**Invalid quantity</strong>')
                                errors = 1;
                            }
                        }

                    });

                }
            });

            $("#submitform").click(function(){
                
                $( "#orderForm" ).submit();
            
            });




            $("#addOne").click(function () {
                let form = '    <div class="col-12">' +
                    '<div class="row">' +
                    '    <div class="col-6">' +
                    '        <div class="form-group">' +
                    '            <label for="cc-payment" class="control-label mb-1">Goods</label>' +
                    '            {!! Form::select('stock[]', goods(), null, ['class' => 'form-control', 'id' => 'stock']) !!}' +
                    '        </div>' +
                    '    </div>' +
                    '    <div class="col-6">' +
                    '        <label for="cc-payment" class="control-label mb-1">Quantity</label>' +
                    '        {!! Form::text('quantity[]', null, ['class' => 'form-control', 'id' => 'quantity']) !!}' +
                    '    </div>' +
                    '</div>'+
                        '    </div>'
                ;

                $("#add").append(form);
            })


        });
    </script>


@endsection