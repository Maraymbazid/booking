@extends('layout.flay')
@section('css')
 <meta http-equiv="refresh" content="120" />

@endsection

@include('layout.nav')

@section('content')


 <div class="container">
    <div class="cards ">



        <section class="content" style=" direction: rtl; max-width:90%;">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <!-- ./col -->
                    <div class="col-12 m-2">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">
                              تفاصيل  طلب تأجير سياره
                        </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">  الرقم المرجعي   </dt>
                            <dd class="col-sm-6"> {{$order->Num}}</dd>
                            <dt class="col-sm-4">  اسم السياره    </dt>
                            <dd class="col-sm-6"> {{$order->car_model}}</dd>
                            <dt class="col-sm-4">  موديل السياره    </dt>
                            <dd class="col-sm-6"> {{$order->car_model}}</dd>
                            <dt class="col-sm-4"> اسم العميل  </dt>
                            <dd class="col-sm-6">{{$order->customrname}}</dd>
                            <dt class="col-sm-4"> رقم الواتساب </dt>
                            <dd class="col-sm-6"> {{$order->number}}</dd>
                            <dt class="col-sm-4"> عدد {{$order->show}} </dt>
                            <dd class="col-sm-6"> {{$order->numberdays}}</dd>
                            <dt class="col-sm-4"> تاريخ الاستلام </dd>
                            <dd class="col-sm-6"> {{$order->date}}</dd>
                            <dt class="col-sm-4">  مكان الاستلام </dt>
                            <dd class="col-sm-6"> {{$order->deliveryplace}}</dd>
                            <dt class="col-sm-4">  مكان التسليم </dt>
                            <dd class="col-sm-6"> {{$order->receivingplace}}</dd>
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
 </div>

    @endsection

    @section('js')

        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>



    @endsection
