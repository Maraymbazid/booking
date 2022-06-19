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
                              تفاصيل  طلب تأجير شقة
                        </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">  الرقم المرجعي   </dt>
                            <dd class="col-sm-6"> {{$order->Num}}</dd>
                            <dt class="col-sm-4">  اسم التاكسي    </dt>
                            <dd class="col-sm-6"> {{$order->taxi_name}}</dd>
                            <dt class="col-sm-4"> اسم العميل  </dt>
                            <dd class="col-sm-6">{{$order->customrname}}</dd>
                            <dt class="col-sm-4"> رقم الواتساب </dt>
                            <dd class="col-sm-6"> {{$order->number}}</dd>
                            <dt class="col-sm-4">  موقع الاستلام </dt>
                            <dd class="col-sm-6"> {{$order->deliveryplace}}</dd>
                            <dt class="col-sm-4">  الواجهه  </dt>
                            <dd class="col-sm-6"> {{$order->destination_name}}</dd>
                            <dt class="col-sm-4">    تاريخ  الوصول </dd>
                            <dd class="col-sm-6"> {{$order->datearrive}}</dd>
                            <dt class="col-sm-4">    معها سائق   </dd>
                           <dd class="col-sm-6">       @if($carttaxi->chauffeur == 0) بدون سائق     @else مع سائق    @endif </dd>
            
                            <dt class="col-sm-4">  تكلفة الرحله   </dt>
                            <dd class="col-sm-6"> {{$order->price}}</dd>
                            @if($order->pro !== null)
                            <dt class="col-sm-4">  الاجمالى قبل الخصم     </dt>
                            <dd class="col-sm-6"> {{$order->}}</dd>
                            <dt class="col-sm-4">  قيمة الخصم   </dt>
                            <dd class="col-sm-6"> {{$order->discount}}</dd>
                            @endif
                            <dt class="col-sm-4">  الاجمالي   </dt>
                            <dd class="col-sm-6"> {{$order->finallprice}}</dd>
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
                            <dd class="col-sm-6"> {{$order->Note}}</dd>

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
