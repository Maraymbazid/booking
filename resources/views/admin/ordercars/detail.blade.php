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
                            <dt class="col-sm-4">  اسم السيارة  </dt>
                            <dd class="col-sm-6"> {{$order->car_name}}</dd>
                            <dt class="col-sm-4">  نوع السيارة  </dt>
                            <dd class="col-sm-6"> {{$order->car_model}}</dd>
                            <dt class="col-sm-4"> اسم الشخص المعني بالحجز </dt>
                            <dd class="col-sm-6"> {{$order->customrname	}}</dd>
                            <dt class="col-sm-4">  رقم الواتساب  </dd>
                            <dd class="col-sm-6"> {{$order->number }}</dd>
                            <dt class="col-sm-4"> عدد {{$order->show}} </dt>
                            <dd class="col-sm-6"> {{$order->numberdays}}</dd>
                            <dt class="col-sm-4">  موقع تسليم السياره  </dt>
                            <dd class="col-sm-6"> {{$order->deliveryplace }}</dd>
                            <dt class="col-sm-4">  موقع إستلام السياره </dt>
                            <dd class="col-sm-6"> {{$order->receivingplace }}</dd>
                            <dt class="col-sm-4">  تاريخ الاستلام </dt>
                            <dd class="col-sm-6"> {{$order->date }}</dd>
                            <dt class="col-sm-4">   المده  </dt>
                            <dd class="col-sm-6">  {{ $order->numberdays}} </dd>
                            <dt class="col-sm-4">  تكلفة {{$order->method}}   </dt>
                            <dd class="col-sm-6"> {{$order->mainPrice}}</dd>
                            @if($order->discount > 0)
                            <dt class="col-sm-4">  الاجمالى قبل الخصم     </dt>
                            <dd class="col-sm-6"> {{$order->beforeDis}}</dd>
                            <dt class="col-sm-4">  قيمة الخصم   </dt>
                            <dd class="col-sm-6"> {{$order->discount}}</dd>
                            @endif
                            <dt class="col-sm-4">  الاجمالي   </dt>
                            <dd class="col-sm-6"> {{$order->price}}</dd>
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

                            <dt class="col-sm-4">  اسم الحساب الذي تم طلب منه  </dt>
                            <dd class="col-sm-6"> {{$order->user->name }}</dd>

                    </div>
                    </div>
            </div>
            </div>
        </section>
    </div>
@endsection