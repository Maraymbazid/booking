@extends('layout.flay')
@section('css')
 <meta http-equiv="refresh" content="30" />

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
                    <div class="col-12 m-5 ml-5">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">
                              تفاصيل  طلب قاعة اجتماعات
                        </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">  الرقم المرجعي   </dt>
                            <dd class="col-sm-6"> {{$order->order_number}}</dd>
                            <dt class="col-sm-4"> اسم العميل  </dt>
                            <dd class="col-sm-6">{{$order->customername}}</dd>
                            <dt class="col-sm-4"> رقم الواتساب </dt>
                            <dd class="col-sm-6"> {{$order->number}}</dd>
                            <dt class="col-sm-4"> عدد الاشخاص </dt>
                            <dd class="col-sm-6"> {{$order->persones}}</dd>
                            <dt class="col-sm-4">  تاريخ الحجز  </dd>
                            <dd class="col-sm-6"> {{$order->date}}</dd>
                            <dt class="col-sm-4">  تكلفة الساعه   </dt>
                            <dd class="col-sm-6"> {{$order->main_price}}</dd>
                            <dt class="col-sm-4">   بداية الحجز   </dt>
                            <dd class="col-sm-6"> {{$order->start_time}}</dd>
                            <dt class="col-sm-4">  عدد الساعات  </dt>
                            <dd class="col-sm-6"> {{$order->hours}}</dd>
                            <dt class="col-sm-4">   نهايته   </dt>
                            <dd class="col-sm-6"> {{$order->end_time}}</dd>
                            @if($order->numberdays !== null)
                            <dt class="col-sm-4">   عدد الايام   </dt>
                            <dd class="col-sm-6"> {{$order->numberdays}}</dd>
                            @endif
                            @if($order->discount > 0)
                            <dt class="col-sm-4">  الاجمالى قبل الخصم     </dt>
                            <dd class="col-sm-6"> {{$order->pricebefore}}</dd>
                            <dt class="col-sm-4">  قيمة الخصم   </dt>
                            <dd class="col-sm-6"> {{$order->discount}}</dd>
                            @endif
                            <dt class="col-sm-4">  الاجمالي   </dt>
                            <dd class="col-sm-6"> {{$order->finallPrice}}</dd>
                            <dt class="col-sm-4">  حالة الطلب   </dt>
                            <dd class="col-sm-6">
                                @if($order->status == '0' )
                            جارى المراجعة
                            @elseif ($order->status == 1)
                            تم  قبول الطلب
                            @elseif ($order->status == 2)
                                تم إالغاء الطلب
                            @else
                            هناك خطأ ما ونحاول التواصل معك
                            @endif
                            </dd>
                            <dt class="col-sm-4">  ملاحظات  </dt>
                            <dd class="col-sm-6"> {{$order->note}}</dd>

                            <dt class="col-sm-4">  اسم الحساب الذي تم طلب منه  </dt>
                            <dd class="col-sm-6"> {{$order->user_id }}</dd>






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
