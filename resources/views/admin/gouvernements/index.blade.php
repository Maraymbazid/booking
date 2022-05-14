@extends('admin.layouts.lay')
@section('title','dashboard')
@section('content')
<div class="content-wrapper">
    <div class="container">
            <div class="alert alert-success" id="success_msg" style="argin-left:1%; color: #a94442;background-color: #f2dede;
                                                                display: none; border-color: #ebccd1; margin-top:20px;">
                <strong>Danger!</strong>  <span style="padding:10px;">Deleted sucessufully </span>
            </div>
        </div>
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>DataTables</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">DataTables</li>
                </ol>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      DataTable with minimal features & hover style
                    </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                                <table
                                id="example2"
                                class="table table-bordered table-hover"
                                >
                                    <thead>
                                        <tr>
                                        <th>Name</th>
                                        <th>Name</th>
                                        <th>events</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($allgouvernements)
                                        @foreach($allgouvernements as $gouvernement)
                                            <tr  class="gouvernementRow{{$gouvernement->id}}">
                                                <td>{{$gouvernement->name}}</td>
                                                <td><a  href=""  gouvernement_id="{{$gouvernement->id}}" class="btn remove button-delete" title="Remove"> delete
                                                        </a></td>
                                                <td>
                                                        <a  href="{{route('editgouvernement',$gouvernement->id)}}"  title="Edit"> edit
                                                        </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endisset
                                    </tbody>
                                </table>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </div>
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
                    $('#success_msg').show();
                }, error: function (reject) {

                }
            });
        });
    </script>
@endsection
