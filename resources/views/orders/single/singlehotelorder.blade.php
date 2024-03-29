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
                    <div class="col-12 m-2 ">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">
                              تفاصيل  طلب فندق
                        </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4"> اسم الشخص  </dt>
                            <dd class="col-sm-6">{{$order->name}}</dd>
                            <dt class="col-sm-4">  الرقم المرجعي  </dt>
                            <dd class="col-sm-6">{{$order->order_number}}</dd>
                            <dt class="col-sm-4">رقم الواتساب </dt>
                            <dd class="col-sm-6"> {{$order->whatsapp}}</dd>
                            <dt class="col-sm-4"> عدد الايام </dt>
                            <dd class="col-sm-6"> {{$order->daycount}}</dd>
                            <dt class="col-sm-4"> تاريخ الوصول </dd>
                            <dd class="col-sm-6"> {{$order->arrival}}</dd>
                            <dt class="col-sm-4"> تاريخ المغادره</dt>
                            <dd class="col-sm-6"> {{$order->checkout}}</dd>
                            <dt class="col-sm-4"> اسم الفندق </dt>
                            <dd class="col-sm-6"> {{$order->hotel_name}}</dd>
                            <dt class="col-sm-4"> اسم الغرفة </dt>
                            <dd class="col-sm-6"> {{$order->room_name}}</dd>
                            <dt class="col-sm-4">  سعر الليله   </dt>
                            <dd class="col-sm-6"> {{$order->main_price}}</dd>
                            @if($order->discount > 0)
                            <dt class="col-sm-4">  الاجمالى قبل الخصم     </dt>
                            <dd class="col-sm-6"> {{$order->price}}</dd>
                            <dt class="col-sm-4">  قيمة الخصم   </dt>
                            <dd class="col-sm-6"> {{$order->discount}}</dd>
                            @endif
                            <dt class="col-sm-4">  الاجمالي   </dt>
                            <dd class="col-sm-6"> {{$order->total}}</dd>
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
                            <dd class="col-sm-6"> {{$order->user->name}}</dd>
                            <dt class="col-sm-4">   تاريخ الطلب      </dt>
                            <dd class="col-sm-6"> {{$order->created_at}}</dd>
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

        {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}

    @endsection
