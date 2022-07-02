
 @extends('layout.flay')



 @section('moving-image')
 <div class="section">
     <div class="moving-image"  style="background-image:url({{url('/assest/met.jpg')}});"></div>
 </div>
 @endsection
 @section('content')
 @include('layout.nav2')
 <div class="title">
      قاعات الاجتماعات
 </div>


<div class="container" id='meeting'>
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
    <div class="col-lg-4 col-md-6 col-12 mt-3 mb-3" v-for='meeting in meetings'>
        <div class="cards" @click='gotoOnehotel(meeting)'>
            <div class="card-image" style="background-image: url('images/22443294.jpg');" v-bind:style="{ backgroundImage: 'url(' + meeting.image + ')' }">
            </div>
            <div class="card-des">
                <div class="row">
                    <div class="col-8">
                        <p class="card-title-me">
                          @{{meeting.name_ar}}
                        </p>
                        <p class="loly">   <i class="fa-solid fa-location-dot"></i><span>      @{{meeting.address_ar}} </span>
                        </p>
                    </div>
                    <div class="col-4 border-me">

                        <p class="no-1">حجزك</p>
                        <p class="no-2">  @{{meeting.price}} </p>
                        <p class="no-3">لكل ساعه</p>
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
 meeting = new Vue({
        'el' : '#meeting',
        data:{
            'loading' : false,
            'meetings' : null
        },
        methods:{
            getallmeetingroom: function(){
                this.loading = true;
                url = '{{ route('meetingaApi')}}',
                    this.$http.get(url).then(response => {
                        // get body data
                        this.loading = false;
                        this.meetings = response.data.MeetingRooms
                        // this.jobs = response.data;
                    }, response => {
                        // error callback
                    })
            },
            gotoOnehotel: function(meeting){
                url = '{{ route('oneMeetingRoom' , ':id')}}',
                url = url.replace(':id' , meeting.id)
                window.location.href = url;
            },
        },
        created(){
            this.getallmeetingroom();
        }
    });


</script>
@endsection
