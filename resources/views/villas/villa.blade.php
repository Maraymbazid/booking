{{--
<form class="form-inline my-2 my-lg-0 mr-lg-2">
    <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." >
        <span class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fa fa-search"></i>
            </button>
        </span>
    </div>
</form>
<br>
<div class="row">



        @if (session('status'))
            <div class="alert alert-success text-center">
                {{ session('status') }}
            </div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
            @foreach ($villas as $villa)
            <div class="col-lg-2  col-md-4 card my-2 my-lg-0 mr-lg-2">
                <a href="{{route('userOneVilla', $villa->id )}}" style="text-decoration: none; ">
                    <div class="card-image" style="background-image: url({{$villa->image}});">
                    </div>
                    <p class="card-title">{{$villa->name_ar}}</p>

                </a>
            </div>
            @endforeach
        </div>


@endsection

 --}}


@extends('layout.flay')

@section('pagetitle',' تأجير فلا  ')
@section('content')



<div class="container" id='villas'>
<div class="row">
    <div class="col-lg-4 col-md-6 col-12" v-for='villa in villas'>
        <div class="cards" @click='gotoOnehotel(villa)'>
            <div class="card-image" style="background-image: url('images/22443294.jpg');" v-bind:style="{ backgroundImage: 'url(' + villa.image + ')' }">
            </div>
            <div class="card-des">
                <div class="row">
                    <div class="col-8">
                        <p class="card-title-me">
                          @{{villa.name_ar}}
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








@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.6.1/vue-resource.min.js"></script>

<script>
 villas = new Vue({
        'el' : '#villas',
        data:{
            'loading' : false,
            'villas' : null
        },
        methods:{
            getallvillas: function(){
                this.loading = true;
                url = '{{ route('villaApi')}}',
                    this.$http.get(url).then(response => {
                        // get body data
                        this.loading = false;
                        this.villas = response.data.villas
                        // this.jobs = response.data;
                    }, response => {
                        // error callback
                    })
            },
            gotoOnehotel: function(car){
                url = '{{ route('userOneCar' , ':id')}}',
                url = url.replace(':id' , tax.id)
                window.location.href = url;
            },
        },
        created(){
            this.getallvillas();
        }
    });


</script>
@endsection
