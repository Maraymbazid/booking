{{--

        @if (session('status'))
            <div class="alert alert-success text-center">
                {{ session('status') }}
            </div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
            @foreach ($taxis as $taxi)
            <div class="col-lg-2  col-md-4 card my-2 my-lg-0 mr-lg-2">
                <a href="{{route('userOneTax', $taxi->id )}}" style="text-decoration: none; ">
                    <div class="card-image" style="background-image: url({{$taxi->image}});">
                    </div>
                    <p class="card-title">{{$taxi->name}}</p>

                </a>
            </div>
            @endforeach
        </div>


@endsection --}}










@extends('layout.flay')



@section('moving-image')
<div class="section">
    <div class="moving-image"  style="background-image: url({{url('/assest/tax.jpg')}});"></div>
</div>
@endsection
@section('content')
@include('layout.nav2')
<div class="title">
      تأجير تاكسي
</div>




<div class="container" id='cars'>
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
    </div>   <div class="col-lg-4 col-md-6 col-12 mt-3 mb-3" v-if='loading' >
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
    </div>   <div class="col-lg-4 col-md-6 col-12 mt-3 mb-3" v-if='loading' >
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
    <div class="col-lg-4 col-md-6 col-12 mt-3 mb-3" v-for='taxi in taxis'>
        <div class="cards" @click='gottoOnetaxi(taxi)'>
            <div class="card-image" style="background-image: url('images/22443294.jpg');" v-bind:style="{ backgroundImage: 'url(' + taxi.image + ')' }">
            </div>
            <div class="card-des">
                <div class="row">
                    <div class="col-8">
                        <p class="card-title-me">
                          @{{taxi.name}}
                        </p>
                        <i class="fa-solid fa-location-dot"></i><span>  @{{ taxi.company_id }}</span>
                        <p class="loly" v-if='taxi.company_id' >  </p>
                    </div>
                    <div class="col-4 border-me">
                        <p class="no-1">متوسط </p>
                        <p class="no-2"> @{{taxi.price}} $</p>
                        <p class="no-3"> </p>
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
 cars = new Vue({
        'el' : '#cars',
        data:{
            'loading' : false,
            'taxis' : null
        },
        methods:{
            getallCars: function(){
                this.loading = true;
                url = '{{ route('taxApi')}}',
                    this.$http.get(url).then(response => {
                        // get body data
                        this.loading = false;
                        this.taxis = response.data.taxis
                        // this.jobs = response.data;
                    }, response => {
                        // error callback
                    })
            },
            gottoOnetaxi: function(taxi){
                url = '{{ route('userOneTax' , ':id')}}',
                url = url.replace(':id' , taxi.id)
                window.location.href = url;
            },
        },
        created(){
            this.getallCars();
        }
    });


</script>
@endsection
