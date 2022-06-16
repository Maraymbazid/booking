

 @extends('layout.flay')



 @section('moving-image')
 <div class="section">
     <div class="moving-image"  style="background-image: url(https://ivang-design.com/svg-load/hotel/move-img@2x.jpg);"></div>
 </div>
 @endsection
 @section('content')
 @include('layout.nav2')
 <div class="title">
     تأجير الفلل
 </div>

<div class="container" id='villas'>
    <div class="row mb-3">
        <div class="input-group">
            <div class="input-group input-group-lg">
            <select _ngcontent-c9="" class="form-control gouvernements"  name="gouvernement_id" v-model='govId' @change='getVillaByGov'>
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
    <div class="col-lg-4 col-md-6 col-12 mt-3 mb-3" v-for='villa in villas'>
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
            gotoOnehotel: function(villa){
                url = '{{ route('userOneVilla' , ':id')}}',
                url = url.replace(':id' , villa.id)
                window.location.href = url;
            },
            getVillaByGov:function(){
                url = '{{ route('Villaordered' , ':id')}}',
                url = url.replace(':id' , this.govId)
                this.$http.get(url).then(response => {
                        // get body data
                        this.villas = response.data[1]
                    }, response => {
                        // error callback
                    })
            }
        },
        created(){
            this.getallvillas();
        }
    });


</script>
@endsection
