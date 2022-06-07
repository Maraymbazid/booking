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


<div id ='gouvernements'>


    <div class="input-group">
    <div class="input-group input-group-lg">
    <select _ngcontent-c9="" class="form-control gouvernements"  name="gouvernement_id" v-model='govId' @change='getHotelsByGov'>
        <option value="">  اختر محافظة </option>
        @if(\App\Models\Admin\Gouvernement::All() && \App\Models\Admin\Gouvernement::All() -> count() > 0)
        @foreach(\App\Models\Admin\Gouvernement::All() as $gouvernement)
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

@if (session('status'))
<div class="alert alert-success text-center">
    {{ session('status') }}
</div>
@elseif(session()->has('error'))
<div class="alert alert-danger text-center">
    {{ session('error') }}
</div>
@endif


<div class="row " style='justify-content: center' id="gouvernements">

            <div  class="card col-md-5 " style="text-decoration: none; " v-for='hotel in hotels'>

                <a  @click='gotoOnehotel(hotel)'  style="text-decoration: none; ">
                            <img :src="hotel.image" class="card-image" alt="...">
                            <div class="card-body">
                            <h5 class="card-title">@{{hotel.name_ar}}</h5>
                            <p class="card-text"> العنوان  : @{{hotel.title}}</p>
                            <p class="card-text"> التقييم  : <small class="text-muted">
                                <i class="fas fa-star" v-for='item in hotel.sort' ></i>
                                {{-- <i class="far fa-star" v-for='d in   5 - hotel.sort ' ></i> --}}
                            </small></p>
                                {{-- @for($i=0;  $i < $hotel->sort; $i++)  <i class="fas fa-star" v-for='t=0 hotel.sort  ' ></i>   @endfor
                                @for($i=$hotel->sort;  $i < 5; $i++)  <i class="far fa-star"></i>  @endfor    </small></p> --}}
                    </div>
                </a>
            </div>


</div>

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

    hotelsIndex = new Vue({
        'el' : '#gouvernements',
        data:{
            'hotels' : [],
            'govId' : ''
        },
        methods:{
            getHotels: function(){
                url = '{{ route('getAllHotelsForUser')}}',
                    this.$http.get(url).then(response => {
                        // get body data
                        console.log(response.data[1])
                                this.hotels = response.data[1]
                        // this.jobs = response.data;
                    }, response => {
                        // error callback
                    })
            },
            gotoOnehotel: function(hotel){
                url = '{{ route('getRoomsByHotelId' , ':id')}}',
                url = url.replace(':id' , hotel.id)
                window.location.href = url;
                    // this.$http.get(url).then(response => {
                    //     // get body data

                    //     // this.jobs = response.data;
                    // }, response => {
                    //     // error callback
                    // })
            },
            getHotelsByGov:function(){
                url = '{{ route('hotelsordered' , ':id')}}',
                url = url.replace(':id' , this.govId)
                this.$http.get(url).then(response => {
                        // get body data
                        console.log(response.data[1])
                        this.hotels = response.data[1]
                    }, response => {
                        // error callback
                    })
            }
        },
        created(){
                this.getHotels()
        }
    })




</script>

@endsection
