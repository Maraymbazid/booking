@extends('layout.flay')
@include('layout.nav')
<div class="section">
    <div class="moving-image"  style="background-image: url(https://ivang-design.com/svg-load/hotel/move-img@2x.jpg);"></div>
</div>
@section('content')
@include('layout.nav2')
<div class="title">
     تأجير سيارات
</div>

<div class="container" id='cars'>
<div class="row">
    <div class="col-lg-4 col-md-6 col-12" v-for='car in cars'>
        <div class="cards" @click='gotoOnehotel(car)'>
            <div class="card-image" style="background-image: url('images/22443294.jpg');" v-bind:style="{ backgroundImage: 'url(' + car.image + ')' }">
            </div>
            <div class="card-des">
                <div class="row">
                    <div class="col-8">
                        <p class="card-title-me">
                          @{{car.name}}
                        </p>
                        <p class="loly"></p>
                        <i class="fa-solid fa-location-dot"></i><span>  شركة</span>


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







@include('layout.footer')
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.6.1/vue-resource.min.js"></script>

<script>
 cars = new Vue({
        'el' : '#cars',
        data:{
            'loading' : false,
            'cars' : null
        },
        methods:{
            getallCars: function(){
                this.loading = true;
                url = '{{ route('getallcarsapi')}}',
                    this.$http.get(url).then(response => {
                        // get body data
                        this.loading = false;
                        this.cars = response.data.cars
                        // this.jobs = response.data;
                    }, response => {
                        // error callback
                    })
            },
            gotoOnehotel: function(car){
                url = '{{ route('userOneCar' , ':id')}}',
                url = url.replace(':id' , car.id)
                window.location.href = url;
            },
        },
        created(){
            this.getallCars();
        }
    });


</script>
@endsection
