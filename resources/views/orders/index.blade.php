@extends('layout.lay')
@section('css')
 <meta http-equiv="refresh" content="30" />

@endsection
@section('content')


        <div class="cards ">
            <div class="card-header" style="text-align: center;">
                <i class="fa fa-table"></i> المعلومات
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>  الاسم   </th>

                            <th>   رقم الواتساب   </th>
                            <th>   عدد الايام    </th>
                            <th>   تاريخ الوصول     </th>
                            <th>   تاريخ المغادرة     </th>
                            <th>    التكلفة الاجمالية     </th>
                            <th>     الخصم</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $order)
                            <tr>
                                <td> {{ $order->user_name }}</td>

                                <td> {{ $order->whatsapp }}</td>
                                <td> {{ $order->daycount }}</td>
                                <td> {{ $order->arrival }}</td>
                                <td> {{ $order->checkout }}</td>
                                <td> {{ $order->total }} $</td>
                                <td>   <button class="btn btn-warning">
                                    <a href="{{ route('H_O', $order->id) }}" class="">
                                       <i class="fa fa-eye" aria-hidden="true"></i>
                                     </a>
                                 </button></td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>



    @endsection

    @section('js')
<script type="text/javascript">
function load()
{
setTimeout("window.open(self.location, '_self');", 180000);
}
</script>
<body onload="load()">

    @endsection
