@extends('admin.layouts.dashboard')
@section('title','dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('storegouvernement') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Gouvernement Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name">

                                @error('name')
                                    <div class="col-lg-7 font-weignt-bold py-3 ligne ">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
    
    </script>

@endsection