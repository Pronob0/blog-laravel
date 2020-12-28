@extends('layouts.backend.main')
@section('title','Post')
@push('css')
 <link href="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">   
@endpush
@section('content')
<section class="content">
        <div class="container-fluid">
            

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All Favourite POST
                                <span class="badge bg-blue" >{{  $posts->count() }}</span>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th><i class="material-icons">favorite</i></th>
                                            
                                            <th><i class="material-icons">visibility</i></th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th><i class="material-icons">favorite</i></th>
                                            
                                            <th><i class="material-icons">visibility</i></th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         @foreach ($posts as $post)
                                            
                                        
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>{{ str_limit($post->title,'10')  }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>{{ $post->favourite_to_users->count() }}</td>
                                            <td>{{ $post->view_count }}</td>
                                            <td>
                                                
                                                <a class="btn btn-success btn-sm" href="{{ route('admin.post.show',$post->id) }}" type="submit"> <i class="material-icons">visibility</i></a>
                                                
                                                <button class="btn btn-danger btn-sm" type="button" onclick="removePost({{ $post->id }})"> <i class="material-icons">delete</i></button>

                                                <form id="remove-from-{{$post->id }}" action="{{ route('post.favourite',$post->id) }}" method="post" style="display: none;">
                                                
                                                @csrf
                                                
                                                
                                                </form>


                                                

                                                
                                            </td>

                                        </tr>
                                        
                                        
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
    
@endsection
@push('js')
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
  
    <script src="{{ asset('public/assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script type="text/javascript">
    function removePost(id) {
        Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    event.preventDefault();
    document.getElementById('remove-from-'+id).submit();
  }
})
    }

    
    </script>

@endpush