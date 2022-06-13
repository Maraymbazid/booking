@extends('layout.lay')
@section('css')
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
            <h4 class='text-center'> تأكيد حجز الشقق  </h4>
            <thead>
                <tr>
                </tr>
            </thead>


            <form method="POST" id="confirmorderapart">
                @csrf
                <tbody>
                    <tr class='text-center border border-light'>
                        <td>  اسم الشقة   </td>
                        <td>  {{$cartapart->apart_name}}  </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td> السعر فى اليوم      </td>
                        <td> {{$cartapart->price}} </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td>  اسم الشخص المعني بالحجز   </td>
                        <td>{{$cartapart->customrname}} <input type="hidden" name="customrname" value="{{$cartapart->customrname}}" /> </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td> رقم الواتساب </td>
                        <td> {{$cartapart->number}} <input type="hidden" name="number" value="{{$cartapart->number}}" /> </td>
                    </tr>
                    
                    <tr class='text-center border border-light'>
                        <td>    تاريخ القدوم     </td>
                        <td> {{$cartapart->begindate}} <input type="hidden" name="begindate" value="{{$cartapart->begindate}}" /> </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td>     تاريخ الخروج     </td>
                        <td>{{$cartapart->enddate}} <input type="hidden" name="enddate" value="{{$cartapart->enddate}}" /> </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td>    المده      </td>
                        <td>{{$cartapart->numberdays}} <input type="hidden" name="numberdays" value="{{$cartapart->numberdays}}" /> </td>
                    </tr>

                    <tr class='text-center border border-light'>
                        <td>   عدد الأشخاص   </td>
                        <td> {{$cartapart->personnes}} <input type="hidden" name="personnes" value="{{$cartapart->personnes}}" /> </td>
                    </tr>
                    <input type="hidden" name="id" value="{{$cartapart->apart_id}}" />
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
        $('#confirmorderapart').submit(function(e) {
             e.preventDefault();
             let formData = new FormData(this);
            $.ajax({
                type: 'post',
                url: "{{route('confirmorderapart')}}",
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
                        window.location.href='{{ route('userIndexApartement')}}';
                }}
                , error: function (reject) {
                    console.log('no');
                }
            });
        });
    </script>
    @endsection