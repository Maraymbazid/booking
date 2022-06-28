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
                            <dd class="col-sm-6">{{ $order->order_number}}</dd>
                            <dt class="col-sm-4">   اسم القاعة  </dt>
                            <dd class="col-sm-6"> {{$order->meeting_name}}</dd>
                            <dt class="col-sm-4"> اسم الشخص المعني بالحجز </dt>
                            <dd class="col-sm-6"> {{$order->customername	}}</dd>
                            <dt class="col-sm-4">  رقم الواتساب  </dd>
                            <dd class="col-sm-6"> {{$order->number }}</dd>
                            <dt class="col-sm-4">   تاريخ البدء   </dt>
                            <dd class="col-sm-6"> {{$order->start_time }}</dd>
                            <dt class="col-sm-4">    تاريخ نهاية </dt>
                            <dd class="col-sm-6"> {{$order->end_time }}</dd>
                            <dt class="col-sm-4">   عدد الساعات </dt>
                            <dd class="col-sm-6"> {{$order->hours }}</dd>
                            <dt class="col-sm-4">   عدد الاشخاص  </dt>
                            <dd class="col-sm-6">  {{ $order->persones}} </dd>
                            @if($order->numberdays != '')
                            <dt class="col-sm-4">    عدد الايام  </dt>
                            <dd class="col-sm-6">  {{ $order->numberdays}} </dd> 
                            @endif
                            <dt class="col-sm-4">  سعر ساعة واحدة  </dt>
                            <dd class="col-sm-6">  {{$order->main_price }}</dd>
                            <dt class="col-sm-4">سعر قبل الخصم  </dt>
                            <dd class="col-sm-6">  {{$order->pricebefore }}</dd>
                            <dt class="col-sm-4"> سعر بعد الخصم   </dt>
                            <dd class="col-sm-6"> {{$order->finallPrice}} </dd>
                            <dt class="col-sm-4">   نسبة الخصم </dt>
                            <dd class="col-sm-6"> {{$order->discount}}</dd>
                            <dt class="col-sm-4">  حالة الطلب   </dt>
                            <dd class="col-sm-6">
                                @if($order->status == 1 )
                                  قيد التنفيذ
                            @elseif ($order->status == 2)
                                  تم القبول
                            @elseif ($order->status == 3)
                                انتظر مكالمة للقبول
                            @elseif ($order->status == 4)
                                     مرفوض
                            @else
                            هناك خطأ ما من فضلك تواصل معنا
                            @endif
                            </dd>
                            <dt class="col-sm-4">  ملاحظات  </dt>
                            <dd class="col-sm-6"> {{$order->note}}</dd>
                            
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    </div>
                    <!-- ./col -->
            </div>
                <!-- /.row -->
                <!-- Main row -->



                <!-- Modal -->

                <!-- /.row (main row) -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->


    </div>




@endsection