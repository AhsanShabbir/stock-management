<body>
    <header>
        <title>Test</title>
        {!! Html::style('../admin/assets/css/bootstrap.min.css') !!}
        <style type="text/css" media="print">
            @page {
                size: auto;
                /* auto is the initial value */
                margin: 0mm;
                /* this affects the margin in the printer settings */
            }

            html {
                font-family: Georgia, 'Times New Roman', Times, serif background-color: #FFFFFF;
                margin: 0px;
                /* this affects the margin on the html before sending to printer */
            }

            body {
                font-family: Georgia, 'Times New Roman', Times, serif border: solid 1px;
                margin: 10mm 15mm 10mm 15mm;
                /* margin you want for the content */
            }

            table tr td {
                margin-left: 5px;
                border: solid 1px;
            }

            .left {
                text-align: left;
            }

            .right {
                text-align: right;
            }
        </style>
    </header>

    <body onload="window.print()">
        <div class="content" style="background-color: white; width: 100%; margin: auto">

            <section class="invoice" style="margin: 20px">
                <!-- title row -->

                {{--
                <h2 class="page-header" style="text-align: center">
                    <i class="fa fa-globe"></i> Fatima Collections
                </h2> --}}

                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <img src="{{asset('logo.png')}}" width="100" alt="Leopards Courier" />
                    </div>
                    <div class="col-sm-2 invoice-col">

                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 invoice-col pull-right">

                        <strong><h2 style="font-family : Arial Narrow', Arial, sans-serif";>
                    Fatima Collections</h2></strong>

                    <b>Date:</b> {{ date_format($order->created_at, "d/m/y") }}<br> 

                    </div>
                    <!-- /.col -->
                    {{--
                    <div class="col-sm-4 invoice-col pull-right">
                        <br>
                     
                       
                       
                    </div> --}}
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="clearfix">
                    <br>
                </div>
                <!-- Table row -->
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table style="width:100%">

                                <tr>
                                        <td class="right"> <b>Order Number :  &nbsp; </b></td>
                                        <td colspan="2">  &nbsp; {{ $order->id }} </td>
                                    </tr>

                                    <tr>
                                            <td class="right"> <b>Tracking Number:  &nbsp; </b></td>
                                            <td colspan="2">  </td>
                                        </tr>

                            <tr>
                                <td class="right"> <b>Recipient:  &nbsp; </b></td>
                                <td colspan="2"> &nbsp; {{ $order->client->name }} </td>
                            </tr>
                            <tr>
                                <td class="right"><b>Address:  &nbsp; </b></td>
                                <td colspan="2"> <p></p> &nbsp; {{ $order->client->address }}   </p> </td>
                            </tr>
                            <tr>
                                <td class="right"><b>City:   &nbsp;</b></td>
                                <td colspan="2">  &nbsp; {{ $order->client->city }}  </td>


                            </tr>

                            <tr>
                                <td class="right"> <b>Contact #:   &nbsp;</b></td>
                                <td colspan="2">&nbsp; {{ $order->client->phone }}  </td>
                            </tr>

                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="clearfix">
                    <br>
                    <br>
                </div>
                {{--
                <div class="row">
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




            </section>

        </div>




    </body>

    </html>