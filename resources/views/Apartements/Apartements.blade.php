@extends('layout.flay')



@section('moving-image')
<div class="section">
    <div class="moving-image"  style="background-image: url(https://ivang-design.com/svg-load/hotel/move-img@2x.jpg);"></div>
</div>
@endsection
@section('content')
@include('layout.nav2')
<div class="title">
    حجز شقق
</div>
<div class="container" id='apartements'>
    <div class="row mb-3">
        <div class="input-group">
            <div class="input-group input-group-lg">
            <select  class="form-control gouvernements"  name="gouvernement_id" v-model='govId' @change='getAppByGov'>
                <option   value="  ">  اختر محافظة </option>
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
    <div class="row" v-show='empty'>
        <div class='alert-danger col-12 m-4 p-5' style='text-align: center'>
            <h3>  نأ سف  هذا المحتوي غير متاح او يمكنك تحديث الصفحة</h3>
        </div>
    </div>
<div class="row">
  
  
    <div class="col-lg-4 col-md-6 col-12 mt-3 mb-3" v-if='loading' >
        <div class="cards">
            <div class="card-image" style="background-image: url('https://cdn.dribbble.com/users/902865/screenshots/4814970/loading-opaque.gif');" >
            </div>
            <div class="card-des">
                <div class="row">
                    <div class="col-8">
                        <p class="card-title-me">

                        </p>
                        <p class="loly"  > </p>
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                    <div class="col-4 border-me">
                        <p class="no-1"><i class="fas fa-spinner fa-spin"></i></p>
                        <p class="no-1"><i class="fas fa-spinner fa-spin"></i></p>
                        <p class="no-1"><i class="fas fa-spinner fa-spin"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-12 mt-3 mb-3" v-if='loading' >
        <div class="cards">
            <div class="card-image" style="background-image: url('https://cdn.dribbble.com/users/902865/screenshots/4814970/loading-opaque.gif');" >
            </div>
            <div class="card-des">
                <div class="row">
                    <div class="col-8">
                        <p class="card-title-me">

                        </p>
                        <p class="loly"  > </p>
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                    <div class="col-4 border-me">
                        <p class="no-1"><i class="fas fa-spinner fa-spin"></i></p>
                        <p class="no-1"><i class="fas fa-spinner fa-spin"></i></p>
                        <p class="no-1"><i class="fas fa-spinner fa-spin"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-12 mt-3 mb-3" v-if='loading' >
        <div class="cards">
            <div class="card-image" style="background-image: url('https://cdn.dribbble.com/users/902865/screenshots/4814970/loading-opaque.gif');" >
            </div>
            <div class="card-des">
                <div class="row">
                    <div class="col-8">
                        <p class="card-title-me">

                        </p>
                        <p class="loly"  > </p>
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                    <div class="col-4 border-me">
                        <p class="no-1"><i class="fas fa-spinner fa-spin"></i></p>
                        <p class="no-1"><i class="fas fa-spinner fa-spin"></i></p>
                        <p class="no-1"><i class="fas fa-spinner fa-spin"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-12 mt-3 mb-3" v-for='apartement in apartements'>
        <div class="cards" @click='gotoOnehotel(apartement)'>
            <div class="card-image" style="background-image: url('images/22443294.jpg');" v-bind:style="{ backgroundImage: 'url(' + apartement.image + ')' }">
            </div>
            <div class="card-des">
                <div class="row">
                    <div class="col-8">
                        <p class="card-title-me">
                           @{{apartement.name_ar}}
                        </p>
                        <p class="loly"></p>
                        <i class="fa-solid fa-location-dot"></i><span>  @{{apartement.address_ar}}</span>


                    </div>
                    <div class="col-4 border-me">

                        <p class="no-1">حجزك</p>
                        <p class="no-2">   @{{apartement.price}}</p>
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
 apartements = new Vue({
        'el' : '#apartements',
        data:{
            'loading' : false,
            'apartements' : [],
            'empty' : false
        },
        methods:{
            apartementAp: function(){
                this.loading = true;
                url = '{{ route('apartementApi')}}',
                    this.$http.get(url).then(response => {
                        this.loading = false;
                        this.apartements = response.data.apartements
                        if(this.apartements.length == 0) this.empty = true
                    }, response => {
                        // error callback
                       this.empty = true
                    })
            },
            gotoOnehotel: function(car){
                url = '{{ route('userOneApartement' , ':id')}}',
                url = url.replace(':id' , car.id)
                window.location.href = url;
            },
            getAppByGov:function(){
                this.empty = false;
                url = '{{ route('Apartordered' , ':id')}}',
                url = url.replace(':id' , this.govId)
                this.$http.get(url).then(response => {
                        // get body data
                        this.apartements = response.data[1]
                        if(this.apartements.length == 0) this.empty = true
                    }, response => {
                         this.empty = true
                        // error callback
                    })
            }
        },
        created(){
            this.apartementAp();
        }
    });


</script>
@endsection
