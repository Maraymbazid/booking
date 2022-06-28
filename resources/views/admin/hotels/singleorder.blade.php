
@extends('admin.layouts.lay')
@section('title', 'الفنادق')


@section('content')

    <!-- Content Wrapper. Contains page content -->
    <section class="content" style="text-align: center; direction: rtl;">
        <div class="container-fluid">

            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
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
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <div class="content-wrapper">

        <section class="content" style=" direction: rtl; max-width:90%;">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <!-- ./col -->
                    <div class="col-12 m-5 ml-5">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">

                              تفاصيل  الطلب
                        </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4"> اسم الشخص  </dt>
                            <dd class="col-sm-6">{{$order->name}}</dd>
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
                            <dd class="col-sm-6"> {{$order->price}}</dd>
                            <dt class="col-sm-4">  قيمة الخصم   </dt>
                            <dd class="col-sm-6"> {{$order->discount}}</dd>
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
                            <dd class="col-sm-6"> {{$order->user_name}}</dd>
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
