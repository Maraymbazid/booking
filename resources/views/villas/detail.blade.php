@extends('layout.lay')
@section('css')
<style>
    input {

        outline: none !important;
        text-align: center;
        border-top: none;
        border-right: none;
        border-left: none;
        border-bottom: 1px solid #222;

    }
</style>
@endsection
@section('content')


<div class="option">

    <div class="option-description">
        <p class="option-text">

        </p>

        <table>
            <h4 class='text-center'> تأكيد حجز فلل  </h4>
            <thead>
                <tr>
                </tr>
            </thead>
            <form method="POST" id="confirmordervilla">
                @csrf
                <tbody>
                    <tr class='text-center border border-light'>
                        <td>   اسم فلة   </td>
                        <td>  {{$cartvilla->villa_name}}  </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td> السعر فى اليوم      </td>
                        <td> {{$cartvilla->price}} </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td>  اسم الشخص المعني بالحجز   </td>
                        <td>{{$cartvilla->customrname}} <input type="hidden" name="customrname" value="{{$cartvilla->customrname}}" /> </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td> رقم الواتساب </td>
                        <td> {{$cartvilla->number}} <input type="hidden" name="number" value="{{$cartvilla->number}}" /> </td>
                    </tr>
                    
                    <tr class='text-center border border-light'>
                        <td>    تاريخ القدوم     </td>
                        <td> {{$cartvilla->begindate}} <input type="hidden" name="begindate" value="{{$cartvilla->begindate}}" /> </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td>     تاريخ الخروج     </td>
                        <td>{{$cartvilla->enddate}} <input type="hidden" name="enddate" value="{{$cartvilla->enddate}}" /> </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td>    المده      </td>
                        <td>{{$cartvilla->numberdays}} <input type="hidden" name="numberdays" value="{{$cartvilla->numberdays}}" /> </td>
                    </tr>

                    <tr class='text-center border border-light'>
                        <td>   عدد الأشخاص   </td>
                        <td> {{$cartvilla->personnes}} <input type="hidden" name="personnes" value="{{$cartvilla->personnes}}" /> </td>
                    </tr>
                    <input type="hidden" name="id" value="{{$cartvilla->villa_id}}" />
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan='2'>
                            <button name="page" value="index" type="submit"
                                class="btn btn-primary btn-lg btn-block">إكمال الطلب</button>
                        </td>
                    </tr>
                </tfoot>

            </form>


        </table>

    </div>
</div>

@endsection

@section('js')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
        $('#confirmordervilla').submit(function(e) {
             e.preventDefault();
             let formData = new FormData(this);
            $.ajax({
                type: 'post',
                url: "{{route('confirmordervilla')}}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                    Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.location.href='{{ route('userIndexVilla')}}';
                }}
                , error: function (reject) {
                    console.log('no');
                }
            });
        });
    </script>
    @endsection