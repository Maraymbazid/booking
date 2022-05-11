@extends('admin.layouts.dashboard')
@section('title','dashboard')
@section('content')
<section>
    <div class="container" style="margin-left:29%">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Name</th>
                </tr>
            </thead>
            <tbody>
                @isset($allgouvernements)
                            @foreach($allgouvernements as $gouvernement)
                                <tr class="gouvernementRow{{$gouvernement->id}}">
                                    <td>
                                        <h4 class="name">{{$gouvernement->name}}</h4>
                                    </td>
                                    <td>
                                        <div>
                                            <a  href=""  gouvernement_id="{{$gouvernement->id}}" class="btn remove button-delete" title="Remove"> delete
                                            </a>
                                            <a  href=""  gouvernement_id="{{$gouvernement->id}}"  class="btn remove button-edit" title="Edit"> edit
                                            </a>
                                        </div>  
                                    </td>
                                </tr>
                            @endforeach
                @endisset
            </tbody>
        </table>
        @include('admin.models.editmodel')
    </div>
</section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script>

        $(document).on('click', '.button-delete', function (e) {
            e.preventDefault();
            var gouvernement_id = $(this).attr('gouvernement_id');
            $.ajax({
                type: 'post',
                url: "{{route('delete-gouvernement')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :gouvernement_id
                },
                success: function (data) {
                    $('.gouvernementRow'+data.id).remove();
                    swal({
                        title: "deleted successsfully!",
                        text: "You clicked the button!",
                        });
                }, error: function (reject) {
                     swal("Something went wrong", "try again pleaseeee!", "error");
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.button-edit', function (e) {
            e.preventDefault();
            var gouvernement_id = $(this).attr('gouvernement_id');
            var row = $(this).closest("tr");
            var name=row.find('.name').text();
            $('#gouvernement_id').val(gouvernement_id);
            $('#gouvernement').val(name);
            $('#modal-id').modal('show');
        });
</script>
<script>
    function get_gouvernement_data() {
        const nextURL = data.redirect_url;
        const nextTitle = 'My new page title';
        const nextState = { additionalInformation: 'Updated the URL with JS' };
	$.ajax({
        url: "{{route('actionresponse')}}",
        type:'GET',
    	data: { },
        success: function (data) {
           // window.history.pushState('', 'New Page Title', 'data.redirect_url');
           window.history.pushState(nextState, nextTitle, nextURL);
            //window.location=data.redirect_url;
                }, error: function (reject) {
                     swal("Something went wrong", "try again pleaseeee!", "error");
                }
            });
}
function get_gouvernement_data1() {
    
	window.setTimeout(function () {
  window.location.reload();
}, 30000);
}
    $(document).on('click', '.submitedit', function (e) {
        e.preventDefault();
            var gouvernement_id = $('#gouvernement_id').val();
            var gouvernement_name = $('#gouvernement').val();
            $.ajax({
                type: 'post',
                url: "{{route('edit-gouvernement')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :gouvernement_id,
                    'name':gouvernement_name,
                },
                success: function (data) {
                    $('#modal-id').modal('hide');
                    // swal({
                    //     title: "updated successsfully!",
                    //     text: "You clicked the button!",
                    //     });
                        //get_gouvernement_data1();
                        location.reload();
                }, error: function (reject) {
                     swal("Something went wrong", "try again pleaseeee!", "error");
                }
            });
    });
    </script>
   
@endsection