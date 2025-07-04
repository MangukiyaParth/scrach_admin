@extends('layouts.main') 
@section('title', 'Apps')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Apps')}}</h5>
                            <span>{{ __('List of Apps')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Apps')}}</a>
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
                <div class="card p-3">
                    <div class="card-header"><h3>                                
                    <a class="btn btn-info btn-sm" href="/apps/create-app">{{ __('Create New')}}</a>
                    </h3></div>
                    <div class="card-body">
                        <table id="apps_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Serial No.')}}</th>
                                    <th>{{ __('Icon')}}</th>
                                    <th>{{ __('Name')}}</th>
                                    <th>{{ __('Coin')}}</th>
                                    <th>{{ __('Url')}}</th>
                                    <th>{{ __('Description')}}</th>
                                    <th>{{ __('View')}}</th>
                                    <th>{{ __('Created Date')}}</th>
                                    <th>{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
     <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <!--server side users table script-->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/layouts.js') }}"></script>
   
    @endpush
@endsection
