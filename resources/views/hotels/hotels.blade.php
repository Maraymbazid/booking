@extends('layout.lay')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .row{
        margin-right: 20px !important;
        margin-left: auto !important;
    }
    .company{
        text-align: center;
        /* background-color:rgb(30, 228, 218); */
        color:rgb(5, 69, 88);
        font-size: 20px;
    }
</style>
    <div class="input-group">
    <div class="input-group input-group-lg">
    <select _ngcontent-c9="" class="form-control gouvernements" id="gouvernement_id" name="gouvernement_id" data-dependent="gouvernements">
        <option value="">  اختر محافظة </option>
        @if($allgouvernements && $allgouvernements -> count() > 0)
        @foreach($allgouvernements as $gouvernement)
        <option
        value="{{$gouvernement-> id }}">
        {{$gouvernement->name}}
            </option>
        @endforeach
        @endif
    </select>
    </div>
    </div>
<br>
<div class="row" id="gouvernements">
        @if (session('status'))
            <div class="alert alert-success text-center">
                {{ session('status') }}
            </div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
        </div>
@endsection
@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.6.1/vue-resource.min.js"></script>
 <script>
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      $('.gouvernements').change(function() {
            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('hotelsordered') }}",
                    data: {
                        'id': value,
                        'dependent': dependent
                    },
                    success: function(result) {
                        $('#' + dependent).html(result);
                    },
                    error: function (reject) {
                       console.log('error');
                    }
                
                });
            }
        });
</script>

@endsection