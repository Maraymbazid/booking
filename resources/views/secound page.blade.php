@extends('layouts.app2')
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
<div class="content-wrapper">

    <div class="container">

        <div class="option">
            <div class="image-option-games">
                <img src=" " width="100%" ;
                    style="border-radius: 25px 25px 0px 0px;">
            </div>
            <div class="option-description">
                <p class="option-text">

                </p>
                @if (session()->has('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session()->get('success') }}
                </div>
                @elseif (session()->has('error'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ session()->get('error') }}
                </div>
                @endif
                <hr>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">الخدمة</th>
                            <th scope="col">السعر </th>
                            <th scope="col">الرقم</th>
                            <th scope="col"></th>
                            <th scope="col">شراء الان</th>
                        </tr>
                    </thead>
                    <tbody>

                        <form method="post" onsubmit="myFunction()"
                            {{-- action="{{ route('ordercheck', ['one' =>  encrypt(), 'tow' =>  encrypt()]) }}" --}}
                            enctype="multipart/form-data">
                            @csrf
                            <tr>
                                <td data-label="Services"></td>
                                <td data-label="Buying">
                                </td>

                                <td data-label="game_id"><input name='game_id' type='text'></td>
                                <td></td>
                                <td><a style="color: #fff;" href="#"> <button name="page" value="index"
                                            class="btn btn-primary rounded form-control"> شراء
                                        </button></a></td>
                            </tr>

                        </form>

                    </tbody>
                </table>
                <div class="multi-pay">

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')
<script>
    function myFunction() {
            $(':button').prop('disabled', true);
        }
</script>

@endsection
