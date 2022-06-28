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
                            <dt class="col-sm-4"> اسم الشخص المعني بالحجز  </dt>
                            <dd class="col-sm-6">  {{ $order->customrname }} </dd>
                            <dt class="col-sm-4"> رقم الواتساب </dt>
                            <dd class="col-sm-6"> {{$order->phone }}</dd>
                            <dt class="col-sm-4"> اسم الشقة  </dt>
                            <dd class="col-sm-6">  {{$order->apartement_name}}</dd>
                            <dt class="col-sm-4"> عدد الايام  </dt> 
                            <dd class="col-sm-6">   {{ $order->numerdays}}</dd>
                            <dt class="col-sm-4"> تاريخ القدوم  </dt>
                            <dd class="col-sm-6"> {{$order->begindate }}</dd>
                            <dt class="col-sm-4">  تاريخ الخروج  </dt>
                            <dd class="col-sm-6">{{$order->enddate }} </dd>
                            <dt class="col-sm-4">  عدد الأشخاص  </dt>
                            <dd class="col-sm-6"> {{$order->personnes}} </dd>  
                            @if($order->dis > 0)
                            <dt class="col-sm-4">سعر قبل الخصم  </dt>
                            <dd class="col-sm-6">  {{$order->pricebefore }}</dd>
                            <dt class="col-sm-4">   نسبة الخصم </dt>
                            <dd class="col-sm-6"> {{$order->dis}}</dd>
                            @endif
                            <dt class="col-sm-4">التكلفة الاجمالية </dt>
                            <dd class="col-sm-6"> {{$order->finallprice}} </dd>
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
                            <dd class="col-sm-6"> {{$order->Note}}</dd>
                            
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