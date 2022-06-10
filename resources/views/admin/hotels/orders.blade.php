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
        @if (session()->has('success'))
            <div class="alert alert-success mt-5 " role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        <section class="content" style="text-align: center; direction: rtl;">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-12 col-12">

                        <!-- small box -->

                    </div>
                    <!-- ./col -->

                    <!-- ./col -->
                    <div class="col-lg-4 col-12">
                        <!-- small box -->

                    </div>
                    <!-- ./col -->

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


        <!---- new -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> اوردرات الفنادق   </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>   الفندق   </th>
                                            <th>   الغرفة   </th>
                                            <th>  اسم الزبون </th>
                                            <th>   تعديل   </th>
                                            <th>  تفاصيل الطلب     </th>
                                            <th>  مسح     </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($orders as $order)
                                            <tr>
                                                <td> {{ $order->hotel_name }}</td>
                                                <td> {{ $order->room_name }}</td>
                                                <td> Ahmed Adawe</td>
                                                <td>
                                                     <button type="button" class="btn btn-warning"> 
                                                          <a
                                                            href="{{ route('editorderhotel', $order->id) }}" class="">
                                                            <i  class="far fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                    </button>

                                                </td>
                                                <td>
                                                <button class="btn btn-warning"> 
                                                    <a href="{{ route('showdetailcar', $order->id) }}" class="">
                                                       <i class="fa fa-eye" aria-hidden="true"></i>
                                                     </a>
                                                 </button>
                                                </td>
                                                <td>
                                                <button class="btn btn-danger rounded"> <a href="" class="button-delete" order_id="{{$order->id}}">
                                                   <i class="fas fa-trash"></i></button>
                                                        </a>
                                                </td>
                                               

                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>



                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>





    </div>



@endsection
@section('js')


    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "info": false,
                "bPaginate": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });







    </script>


    @endsection
