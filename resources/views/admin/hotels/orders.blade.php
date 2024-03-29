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
                                            <th> تاريخ إنشاء الطلب </th>
                                            <th>   حالة الطلب  </th>
                                            <th>   تعديل   </th>
                                            <th>  تفاصيل الطلب     </th>
                                            <th>  مسح     </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($orders as $order)
                                            <tr class="OrderRow{{$order->id}}">
                                                <td> {{ $order->hotel_name }}</td>
                                                <td> {{ $order->room_name }}</td>
                                                <td> {{$order->user_name}}</td>
                                                <td> {{ $order->created_at }} </td>
                                                <td> {{$order->status}}</td>
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
                                                    <a href="{{ route('showdetailhotel', $order->id) }}" class="">
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
            @if ($orders->hasPages())
                    <nav>
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($orders->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                            @else
                                <li class="page-item ">
                                    <a class="page-link" href=" {{ $orders->previousPageUrl() }}"
                                        tabindex="-1">Previous</a>
                                </li>
                            @endif


                            {{-- Next Page Link --}}
                            @if ($orders->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $orders->nextPageUrl() }}">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled" aria-disabled="true"
                                    aria-label="@lang('pagination.next')">
                                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                    @endif

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
@section('js')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
        $(document).on('click', '.button-delete', function (e) {
            e.preventDefault();
            var order_id = $(this).attr('order_id');
            $.ajax({
                type: 'post',
                url: "{{route('deleteorderhotel')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :order_id
                },
                success: (response) => {
                    if (response) {
                    $('.OrderRow'+response.id).remove();
                    Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                }}
                , error: function (reject) {

                }
            });
           // console.log(gouvernement_id);
        });
    </script>
    @endsection
