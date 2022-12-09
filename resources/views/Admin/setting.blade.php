@extends('Admin.admin-file')

    @section('admin-section')
    <style>
        /* .select2-selection__rendered{
            color: #696cff;
            background-color: #696cff29 !important;
        } */
        .select2-selection__choice{
            background-color: #696cff !important;
            color: white;
            border: 0 !important;
        }
        .select2-results__option{
            color: black ;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4>

        <div id="alert_tag"></div>
        @if ($errors->any())
        @foreach ($errors->all() as $k=>$error)
        <div class="alert alert-danger alert-dismissible mt-3">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach
        @endif
        <div class="mb-5 pb-5">
            <!-- <button class="btn btn-primary" onclick="notifyMe()">Notify me!</button> -->
            @foreach ($settings as $key => $setting)
            <form action="{{ route('admin.setting.save',$setting['id']) }}" method="post" enctype= multipart/form-data>
                @csrf
                <div class="card mb-4 shadow @error('product_name') shadow-danger @enderror">
                    <div class="card-body">
                        <div class="row">
                            <label for="{{ $setting['name'] }}" class="col-form-label col-md-3">{{ $setting['id'] }} . {{ $setting['name'] }}</label>
                            <div class="col-md-6">
                                @if(preg_match('/(?<=::)[^{]+/',$setting['option']))
                                    @php 
                                        $model = str_replace('::','',$setting['option']);
                                        $model = str_replace('','',$model);
                                        preg_match('/{.*?}/',$setting->option,$ext);
                                        $limit = str_replace(['{','}'],'',$ext[0]);
                                        $model = str_replace($ext[0],'',$model);
                                    @endphp
                                    <select multiple name="{{ $setting['name'] }}[]" id="{{ $setting['name'] }}" class="form-control form-control-lg"  value="{{ $setting['value'] }}">
                                        <option value="">Please Select</option>
                                        @foreach($models[$model] as $key=>$option)
                                            <option value="{{ $key }}"  @if($setting['value'] != null ) @if( in_array($key,json_decode($setting['value']))) selected @endif @endif>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        $("#{{ $setting['name'] }}").select2({
                                            placeholder: 'Select an option',
                                            maximumSelectionLength: '{{ $limit }}',
                                        })
                                    </script>
                                @else
                                    @switch($setting['type'])
                                        @case('select')
                                            <select name="{{ $setting['name'] }}" id="{{ $setting['name'] }}" class="form-control" value="{{ $setting['value'] }}">
                                                @if($setting['option'] != null)
                                                    @php $options = explode(';',$setting['option']); @endphp
                                                    @if(count($options) > 0)
                                                    <option value="">Please Select</option>
                                                        @foreach($options as $key=>$option)
                                                            @php $option = explode(':',$option); @endphp
                                                            @if(count($option) > 1)
                                                                <option value="{{ $option['1'] }}" @if($setting['value'] != null) @if($option['1'] == $setting['value']) selected @endif @endif>{{ $option['0'] }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>
                                            @break
                                        @case('checkbox')
                                                @if($setting['option'] != null)
                                                    @php $options = explode(';',$setting['option']); @endphp
                                                    @if(count($options) > 0)
                                                        <div class="row">
                                                            @foreach($options as $key=>$option)
                                                                @php $option = explode(':',$option); @endphp
                                                                @if(count($option) > 1)
                                                                    <div class="input-group w-auto">
                                                                        <div class="input-group-text">
                                                                        <input class="form-check-input mt-0" type="{{ $setting['type'] }}" name="{{ $setting['name'] }}[]" id="{{ $setting['name'] }}_{{ $option['1'] }}" value="{{ $option['1'] }}" @if($setting['value'] != null) @if( in_array($option['1'], json_decode($setting['value']))) checked @endif @endif />
                                                                        </div>
                                                                        <label class="form-control" for="{{ $setting['name'] }}_{{ $option['1']  }}">{{ $option['0'] }}</label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                @endif
                                            @break  
                                        @case('radio')
                                                @if($setting['option'] != null)
                                                    @php $options = explode(';',$setting['option']); @endphp
                                                    @if(count($options) > 0)
                                                        <div class="row">
                                                            @foreach($options as $key=>$option)
                                                                @php $option = explode(':',$option); @endphp
                                                                @if(count($option) > 1)
                                                                    <div class="input-group w-auto">
                                                                        <div class="input-group-text">
                                                                        <input class="form-check-input mt-0" type="{{ $setting['type'] }}" name="{{ $setting['name'] }}" id="{{ $setting['name'] }}_{{ $option['1'] }}" value="{{ $option['1'] }}" @if($setting['value'] != null) @if( $option['1'] == $setting['value']) checked @endif @endif />
                                                                        </div>
                                                                        <label class="form-control" for="{{ $setting['name'] }}_{{ $option['1']  }}">{{ $option['0'] }}</label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                @endif
                                            @break
                                        @case('textarea')
                                                <textarea class="form-control" id="{{ $setting['name'] }}" name="{{ $setting['name'] }}" {{ $setting['option'] }} cols="30" rows="5">{{ $setting['value'] }}</textarea>
                                            @break
                                        @case('file')
                                                <input type="hidden" name="{{ $setting['name'] }}_" value="{{ $setting['value'] }}">
                                                <input type="{{ $setting['type'] }}" class="form-control" id="{{ $setting['name'] }}" name="{{ $setting['name'] }}[]" {{ $setting['option'] }} />
                                                <div class="row" id="{{ $setting['name'] }}_preview">
                                                    @if( $setting['value'] != '')
                                                        @php $array = (json_decode($setting['value'])); @endphp
                                                        @foreach($array as $no => $img)
                                                            <img src="{{ asset('assets\img\settings\\' . $img) }}" class='w-25 p-2 rounded my-2' style="object-fit:contain;" height="100px" >
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @break
                                        @default
                                            <input type="{{ $setting['type'] }}" class="form-control" id="{{ $setting['name'] }}" name="{{ $setting['name'] }}" value="{{ $setting['value'] }}" {{ $setting['option'] }} />
                                    @endswitch
                                @endif
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary btn-outline-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @endforeach
            {{ $settings->links('pagination.setting') }}
        </div>
        <div>
            <form action="{{ route('admin.add_setting') }}" method="post">
                @csrf
                <div class="bottom-0 position-fixed row" style="width: 67%;">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <label for="new_setting" class="col-2">Add Setting Field</label>
                                    <div class="col-6">
                                        <input type="text" name="new_setting" id="new_setting" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <select name="field_type" id="field_type" class="form-control">
                                            <option value="">Select Field Type</option>
                                            <option value="text">Text</option>
                                            <option value="number">Number</option>
                                            <option value="file">File</option>
                                            <option value="textarea">Textarea</option>
                                            <option value="select">Select</option>
                                            <option value="radio">Radio</option>
                                            <option value="checkbox">Checkbox</option>
                                        </select>
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-outline-primary menu_submit float-end">Submit</button>
                                    </div>
                                    <label for="options_field" class="col-2">Add Option</label>
                                    <div class="col-10 my-2">
                                        <textarea name="options_field" id="options_field" cols="30" rows="2" class="form-control" placeholder="label:value;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @if (session()->exists('add_res'))
        @php $sus_data = session()->get('add_res'); @endphp
        <div class="bg-{{ $sus_data['show_popup'] }} bottom-0 bs-toast end-0 fade m-4 show toast toast-placement-ex" id="page-responce" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">{{ $sus_data['title'] }}</div>
                <!-- <small>11 mins ago</small> -->
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">{{ $sus_data['message'] }}</div>
        </div>
        @endif
    </div>
    <script>
        $(function () {
            $('input[type=file]').change(function(){
                preview_class = $(this).attr('id')+ '_preview';
                console.log($(this));
                var total_file=$(this)[0].files.length;
                html = '';
                for(var i=0;i<total_file;i++)
                {
                    html += `<img class='w-25 p-2 rounded my-2' style="object-fit:contain;" height="100px" src='${URL.createObjectURL(event.target.files[i])}'>`;
                }
                $('#'+preview_class).html(html);
            })
        });
        document.addEventListener('DOMContentLoaded', function() {
            if (!Notification) {
                alert('Desktop notifications not available in your browser. Try Chromium.');
                return;
            }

            if (Notification.permission !== 'granted')
                Notification.requestPermission();
        });


        function notifyMe() {
            if (Notification.permission !== 'granted')
                Notification.requestPermission();
            else {
                var notification = new Notification('Sahwa Production', {
                    icon: 'http://localhost/one/public/assets/img/svg/logo.svg',
                    body: 'Hey there! You\'ve been notified!',
                });
                notification.onclick = function() {
                    window.open('http://localhost/one/public/Admin/dashboard');
                };
            }
        }
    </script>
    @endsection
    @section('sub-script')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endsection
