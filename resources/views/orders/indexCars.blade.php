@extends('layout.flay')
@section('css')
 <meta http-equiv="refresh" content="60" />
<style>
    .table-responsive-stack tr {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-direction: row;
          flex-direction: row;
}


.table-responsive-stack td,
.table-responsive-stack th {
   display:block;
/*
   flex-grow | flex-shrink | flex-basis   */
   -ms-flex: 1 1 auto;
    flex: 1 1 auto;
}

.table-responsive-stack .table-responsive-stack-thead {
   font-weight: bold;
}

@media screen and (max-width: 768px) {
   .table-responsive-stack tr {
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
          -ms-flex-direction: column;
              flex-direction: column;
      border-bottom: 3px solid #ccc;
      display:block;

   }
   /*  IE9 FIX   */
   .table-responsive-stack td {
      float: left\9;
      width:100%;
   }
}


</style>
@endsection

@include('layout.nav')

@section('content')



    <div class="container">
    <h3 class="mayati-title">
         حجز السيارات
        </h3>

            <div class="cards ">
                <div class="card-header" style="text-align: center;">
                    <i class="fa fa-table"></i> المعلومات
                </div>
                <div class="card-body">

            <table class="table table-bordered table-striped table-responsive-stack" id="tableOne" style="text-align:center">
            <thead class="thead-dark">
                <tr>
                    <th>  رقم الطلب   </th>
                    <th>  الاسم   </th>
                    <th>  رقم التواصل    </th>
                    <th>    السعر الاجمالي</th>
                    <th>     تاريخ الطلب   </th>
                    <th>     حالة الطلب   </th>
                    <th>     تفاصيل </th>
                    {{-- <th>   رقم الواتساب   </th>
                    <th>   عدد الايام    </th>
                    <th>   تاريخ الاستلام      </th>
                    <th>   مكان الاستلام      </th>
                    <th>   مكان التسليم      </th>
                    <th>   سعر اليوم        </th>
                    <th>     الخصم ان وجد        </th> --}}

                </tr>
            </thead>
            <tbody>

                @foreach ($cars as $car )
                    <tr>
                        <td> {{ $car->Num}}</td>
                        <td> {{ $car->customrname }}    </td>
                        <td> {{ $car->number }} </td>
                        <td> {{ $car->price }}</td>
                        <td> {{ $car->created_at }}</td>
                        <td>       @if($car->status == 1 )
                            قيد التنفيذ
                      @elseif ($car->status == 2)
                            تم القبول
                      @elseif ($car->status == 3)
                          انتظر مكالمة للقبول
                      @elseif ($car->status == 4)
                               مرفوض
                      @else
                      هناك خطأ ما من فضلك تواصل معنا
                      @endif
                            </td>
                        <td>   <button class="btn btn-primary">
                            <a href="{{ route('singlecarOrder', $car->id) }}" >
                                <span style="color: #fff;">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </a>
                        </button></td>
                    </tr>
                @endforeach
            </tbody>
            </table>
                    @if ($cars->hasPages())

                    <nav>
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($cars->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                            @else
                                <li class="page-item ">
                                    <a class="page-link" href=" {{ $cars->previousPageUrl() }}"
                                        tabindex="-1">Previous</a>
                                </li>
                            @endif


                            {{-- Next Page Link --}}
                            @if ($cars->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $cars->nextPageUrl() }}">Next</a>
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
            </div>
            </div>

    </div>



    @endsection

    @section('js')


<script type="text/javascript">

$(document).ready(function() {


// inspired by http://jsfiddle.net/arunpjohny/564Lxosz/1/
$('.table-responsive-stack').each(function (i) {
   var id = $(this).attr('id');
   //alert(id);
   $(this).find("th").each(function(i) {
      $('#'+id + ' td:nth-child(' + (i + 1) + ')').prepend('<span class="table-responsive-stack-thead">'+             $(this).text() + ':</span> ');
      $('.table-responsive-stack-thead').hide();

   });



});





$( '.table-responsive-stack' ).each(function() {
var thCount = $(this).find("th").length;
var rowGrow = 100 / thCount + '%';
//console.log(rowGrow);
$(this).find("th, td").css('flex-basis', rowGrow);
});




function flexTable(){
if ($(window).width() < 768) {

$(".table-responsive-stack").each(function (i) {
   $(this).find(".table-responsive-stack-thead").show();
   $(this).find('thead').hide();
});


// window is less than 768px
} else {


$(".table-responsive-stack").each(function (i) {
   $(this).find(".table-responsive-stack-thead").hide();
   $(this).find('thead').show();
});



}
// flextable
}

flexTable();

window.onresize = function(event) {
 flexTable();
};






// document ready
});




</script>


    @endsection


