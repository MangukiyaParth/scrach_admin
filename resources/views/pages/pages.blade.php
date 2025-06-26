@extends('layouts.main') 
@section('title', 'Pages')
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
                            <h5>{{ __('Pages')}}</h5>
                            <span>{{ __('Pages')}}</span>
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
                                <a href="#">{{ __('Pages')}}</a>
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
                    <Button class="btn btn-info btn-sm create-page">{{ __('Create Page')}}</Button>
                    </h3></div>
                    <div class="card-body">
                        <table id="banner_table" class="table">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>{{ __('Title')}}</th>
                                    <th>{{ __('Url')}}</th>
                                    <th>{{ __('Visible in Landing Page')}}</th>
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
     @include('model')
     
<div class="modal fade modal" id="addPage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Page Data')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample-banner" method="POST" action="/setting/pages/create" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group row" >
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Page Title</label>
                        <div class="col-sm-12">
                            <input type="text" name="title" class="form-control" placeholder="Privacy Policy" required/>
                        </div>
                    </div>
                    
                    <div class="form-group row" >
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Page Slug(it will visible on browser url)</label>
                        <div class="col-sm-12">
                            <input type="text" name="slug" class="form-control" placeholder="privacy-policy" required/>
                        </div>
                    </div>
                    
                   <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-12 col-form-label">{{ __('Page Content')}}</label>
                        <div class="col-sm-12">
                        <textarea class="ckeditor form-control" name="detail" required></textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Show Page Name in Landing Page')}}</label>
                        <div class="col-sm-12">
                            <select name="visible" class="form-control"required>
                                <option value="0">Yes</option>
                                <option value="1">No</option>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

   
   <div class="modal fade modal" id="updatePage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Page Data')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample-banner" method="POST" action="/setting/pages/update" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden"  name="id" id="pid">
                    
                    <div class="form-group row" >
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Page Title</label>
                        <div class="col-sm-12">
                            <input type="text" name="title" id="ptitle" class="form-control" placeholder="Privacy Policy" required/>
                        </div>
                    </div>
                    
                    <div class="form-group row" >
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Page Slug(it will visible on browser url)</label>
                        <div class="col-sm-12">
                            <input type="text" name="slug" id="pslug" class="form-control" placeholder="privacy-policy" required/>
                        </div>
                    </div>
                    
                   <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-12 col-form-label">{{ __('Page Content')}}</label>
                        <div class="col-sm-12">
                        <textarea class="ckeditor form-control" name="detail"  id="p22text" required></textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Show Page Name in Landing Page')}}</label>
                        <div class="col-sm-12">
                            <select name="visible" class="form-control" id="pvisible"  required>
                                <option value="0">Yes</option>
                                <option value="1">No</option>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
  
     
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
       <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <!--server side users table script-->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/layouts.js') }}"></script>
    
    <script>
    
    $("body").on("click",".create-page",function(){
     $("#addPage").modal('show');
    });
    
     $("body").on("click",".edit-page",function(){
        var current_object = $(this);
        var id=current_object.attr('data-id');
        
        $.ajax({
            url: '/setting/pages/edit/'+id,
            type: "GET",

            success: function (data) {
                 $("#updatePage").modal('show');
                 $("#pid").val(data['id']);
                 $("#ptitle").val(data['title']);
                 $("#pslug").val(data['slug']);
              
                CKEDITOR.instances.p22text.setData(data['text']);


                 var selectedUser = data['visible'];
                $('#pvisible option[value="'+ selectedUser +'"]').attr("selected", "selected");
                console.log(data);
            },
          });
     
    });
    
    $("body").on("click",".remove-page",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete this item?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/setting/pages/delete/'+id,
                        type: "get",
                        success: function (data) {
                            if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                        });
                } else {
                    swal("The item is not deleted!");
                }
            });
        });
    
    $(document).ready(function()
    {
        var searchable = [];
        var selectable = []; 
        
        var dTable = $('#banner_table').DataTable({
    
            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            processing: true,
            responsive: false,
            serverSide: true,
            processing: true,
            language: {
              processing: '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>'
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            ajax: {
                url: '/setting/pages/list',
                type: "get"
            },
            columns: [
                {data:'DT_RowIndex', name: 'DT_RowIndex', "searchable": false},
                {data:'title', name: 'title', "searchable": true},
                {data:'url', name: 'url', "searchable": true},
                {data:'visible', name: 'visible', "searchable": false}, // add column name
                {data:'action', name: 'action', "searchable": false}
    
            ],
          
        });
    });
    
    </script>

    @endpush
@endsection
