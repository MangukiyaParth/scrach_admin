@extends('layouts.main') 
@section('title', 'Landing Page Setting')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Landing Page Setting')}}</h5>
                            <span>{{ __('')}}</span>
                        </div>
                        </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <!-- <a href="#">{{ __('Add User')}}</a> -->
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Landing Page Setting')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/setting/update" enctype= "multipart/form-data">
                        @csrf
                            
                            <input type=hidden name="type" value="landing"/>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('App Name')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control " name="title" value="{{$data->title}}" placeholder="App Name" required>
                                </div>
                            </div>
                            
                            

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('App Logo 100*100')}}</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="logo">
                                     </div>
                             </div>
                             
                             <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Top Image')}}</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="top_image">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('App  Description')}}</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control"  name="description" placeholder="Reward app is a......" required>
                                     {{$data->description}}</textarea>
                                    </div>
                             </div>

                            
                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Short Title')}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{$data->short_title}}" name="short_title" placeholder="Why Use Reward App">
                                    </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Short SubTitle')}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{$data->short_subtitle}}" name="short_subtitle" placeholder="check all the reasons why you should be using Reward App">
                                    </div>
                            </div>
                            <br>
                            <h5>Download App Setup</h5>
                            <hr>
                            
                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Download Title')}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{$data->download_title}}" name="download_title" placeholder="Download the app">
                                    </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Download Link Type')}}</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="download_type" name="download_type" required>
                                        <option value="0" {{($data->download_type == '0') ? 'selected' : ''}}>PlayStore Link</option>
                                        <option value="1" {{($data->download_type == '1') ? 'selected' : ''}}>Download App from Landing Page</option>
                                        </select>
                                    </div>
                            </div>
                            
                            <div class="form-group row div_download_link">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('PlayStore Download Link')}}</label>
                                <div class="col-sm-9">
                                    <input type="url" class="form-control" id="download_link" value="{{$data->download_link}}" name="download_link" placeholder="http">
                                    </div>
                            </div>
                            
                            <div class="form-group row div_download_file">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Upload Apk File')}}</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="download_file" name="download_file" >
                                    </div>
                            </div>
                       
                            
                        <br>
                        <h5>Page Content</h5>
                        <hr>
                        
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Content Image 1')}}</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="slide_image1">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Content Title 1')}}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$data->slide_title1}}" name="slide_title1" placeholder="Title 1">
                                </div>
                        </div>
                             
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Content  Description 1')}}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control"  name="slide_desc1" required>
                                 {{$data->slide_desc1}}</textarea>
                                </div>
                         </div> 
                         
                         <hr>
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Content Image 2')}}</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="slide_image2">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Content Title 2')}}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$data->slide_title2}}" name="slide_title2" placeholder="Title 2">
                                </div>
                        </div>
                             
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Content  Description 2')}}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control"  name="slide_desc2" required>
                                 {{$data->slide_desc2}}</textarea>
                                </div>
                         </div> 
                        
                        <hr>
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Content Image 3')}}</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="slide_image3">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Content Title 2')}}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$data->slide_title3}}" name="slide_title3" placeholder="Title 3">
                                </div>
                        </div>
                             
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Content  Description 3')}}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control"  name="slide_desc3" required>
                                 {{$data->slide_desc3}}</textarea>
                                </div>
                         </div> 

                            <button type="submit" class="btn btn-primary mr-2 float-right">{{ __('Save')}}</button>
                        </form>
                    </div>
                  </div>
        </div>
        
    </div>
    <!-- push external js -->
    @push('script') 
    @include('model')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>

        <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
         <!--get role wise permissiom ajax script-->
         
        <script>
            
            $(document).ready(function(){
                var dt="{{$data->download_type}}";
                if(dt=='0'){
                    $('.div_download_link').show()
                    $('.div_download_file').hide()
                }else{
                    $('.div_download_link').hide()
                    $('.div_download_file').show()
                }
            });
            
            $('#download_type').change(function(){
                if(this.value==0){
                    $('.div_download_link').show()
                    $('.div_download_file').hide()
                }else{
                    $('.div_download_link').hide()
                    $('.div_download_file').show()
                }
            })
            
        </script> 

    @endpush
@endsection
