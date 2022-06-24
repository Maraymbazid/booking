@extends('admin.layouts.lay')
@section('content')
    <section class="content" style="text-align: center; direction: rtl;">
        <div class="container-fluid">
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Row information</h4>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="content-wrapper">
        <section class="content" style=" direction: rtl; max-width:90%;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 m-5 ml-5">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">
                              تفاصيل  الطلب
                        </h3>
                        </div>
                        <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4"> رقم الطلب  </dt>
                            <dd class="col-sm-6">{{ $order->Num}}</dd>
                            <dt class="col-sm-4">  اسم التاكسي  </dt>
                            <dd class="col-sm-6"> {{$order->taxi_name}}</dd>
                            <dt class="col-sm-4">  نوع التاكسي  </dt>
                            <dd class="col-sm-6"> {{$order->taxi_model}}</dd>
                            <dt class="col-sm-4"> اسم الشخص المعني بالحجز </dt>
                            <dd class="col-sm-6"> {{$order->customername}}</dd>
                            <dt class="col-sm-4">  رقم الواتساب  </dd>
                            <dd class="col-sm-6"> {{$order->number }}</dd>
                            <dt class="col-sm-4">   مكان إستلام</dt>
                            <dd class="col-sm-6"> {{$order->deliveryplace }}</dd>
                            <dt class="col-sm-4">  الوجهة </dt>
                            <dd class="col-sm-6"> {{$order->destination }}</dd>
                            <dt class="col-sm-4">  تاريخ الوصول  </dt>
                            <dd class="col-sm-6">  {{$order->datearrive }} </dd>
                            <dt class="col-sm-4">  سعر </dt>
                            <dd class="col-sm-6">  {{$order->price}}</dd>
                            <dt class="col-sm-4">  سعر </dt>
                            <dd class="col-sm-6">  {{$order->finallprice}}</dd>
                            <dt class="col-sm-4">  برمو </dt>
                            <dd class="col-sm-6">  {{$order->pro}}</dd>
                            @if($order->chauffeur == 1)  
                            <dt class="col-sm-4">    مع سائق  </dt>
                            @else
                            <dt class="col-sm-4">    بدون سائق  </dt>
                            @endif
                            <dt class="col-sm-4">   صورة التذكرة  </dt>
                            <dd class="col-sm-6"> <img src="{{$order->ticket}}" /></dd>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    </div>
                    <!-- ./col -->
            </div>
                <!-- /.row -->
                <!-- Main row -->     <!-- Modal -->
                <!-- /.row (main row) -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
    </div>
@endsection
@section('js')
    <script>
        function myFunction() {
            $(':button').prop('disabled', true);
        }
    </script>

@endsection
