@extends('layout.flay')



@section('moving-image')
<div class="section">
    <div class="moving-image"  style="background-image: url(https://ivang-design.com/svg-load/hotel/move-img@2x.jpg);"></div>
</div>
@endsection
@section('content')
@include('layout.nav2')
<div class="title">
    فنادق
</div>

<div class="container" id='gouvernements'>
    <div class="row mb-3">
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
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12" v-for='hotel in hotels'>
            <div class="cards" @click='gotoOnehotel(hotel)'>
                <div class="card-image" style="background-image: url('images/22443294.jpg');" v-bind:style="{ backgroundImage: 'url(' + hotel.image + ')' }">
                </div>
                <i class="fa-solid fa-star" v-for='item in hotel.sort' style="color: #f18602;"></i>

                {{-- <i class="fa-solid fa-star-half-stroke" style="color: #f18602;"></i> --}}
                 <i class="fa-regular fa-star" v-for='d in   5 - hotel.sort ' style="color: #f18602;"></i>
                <div class="card-des">
                    <div class="row">
                        <div class="col-8">
                            <p class="card-title-me">
                                @{{hotel.name_ar}}
                            </p>
                            <p class="loly"></p>
                            <i class="fa-solid fa-location-dot"></i><span>   @{{hotel.title}}</span>


                        </div>
                        <div class="col-4 border-me">

                            <p class="no-1">حجزك</p>
                            <p class="no-2">100$</p>
                            <p class="no-3">لكل ليلة</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.6.1/vue-resource.min.js"></script>

<script>

    hotelsIndex = new Vue({
        'el' : '#gouvernements',
        data:{
            'loading' : false,
            'govId' : '',
            'hotels' : null
        },
        methods:{
            getHotels: function(){
                this.loading = true;
                url = '{{ route('getAllHotelsForUser')}}',
                    this.$http.get(url).then(response => {
                        // get body data
                        this.loading = false;
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
