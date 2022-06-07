<div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>اختر خدمة </label>
                                        <select v-model="status" id="allserv" data-dependent="services" class="form-control roles" style="width: 100%;">
                                            <option  value=""> اختر خدمة</option>
                                            @foreach(\App\Models\MainServicesHotel::all() as $services)
                                            <option  value="{{ $services->id}}"> {{$services->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label> اختر خدمة </label>
                                        <select id="services"   class="form-control " style="width: 100%;">
                                            <option>أختر خدمة فرعية </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                </div>


                                $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.roles').change(function() {
            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                $.ajax({
                    url: "{{ route('getSubByMainId') }}",
                    method: "POST",
                    data: {
                        'id': value,
                        'dependent': dependent
                    },
                    success: function(result) {
                        $('#' + dependent).html(result);
                    }
                })
            }
        });

        public function getSubByMainId(Request $request)
    {

        $value = $request->get('id');
        $dependent = $request->get('dependent');
        $services = DB::table('sub_services_hotels')->where('main_service_id', $value)->get();
        $output = '<option data-kt-flag="flags/united-states.svg" value="">' . ucfirst($dependent) . ' </option>';
        foreach ($services as $service) {
            $output .= '<option data-kt-flag="flags/united-states.svg" value="' . $service->id . '">' . $service->name . ' </option>';
        }
        echo $output;
    }