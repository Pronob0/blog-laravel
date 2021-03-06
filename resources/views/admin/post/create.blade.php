@extends('layouts.backend.main')
@section('title','Category')
@push('css')
<link href="{{ asset('public/assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush



@section('content')

<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>FORM EXAMPLES</h2>
            </div>

 @if($errors->any())
 @foreach ($errors->all() as $error)
           <div class="alert alert-danger" role="alert">
        {{ $error }}
            </div>
 @endforeach
 @endif
          
            <!-- Vertical Layout | With Floating Label -->
            <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD NEW POST
                         
                            </h2>
                            
                        </div>
                        <div class="body">
                            
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="title" name="title" class="form-control">
                                        <label class="form-label">Post Title</label>
                                    </div> <br>
                                    <div class="form-line">
                                        <label for="image" >Featured Image</label> <br>
                                        <input type="file" id="image" name="image" class="form-control">
                                        
                                    </div>
                                </div>
                               <div class="form-group">
                                   <input type="checkbox" id="publish" class="filled-in" name="status" value="1">
                                   <label for="publish">publish</label>
                               </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Select Category & Tags
                         
                            </h2>
                            
                        </div>
                        <div class="body">
                            
                                <div class="form-group form-float">
                                    <div clals="form-line {{ $errors->has('categories') ? 'focused error': ' ' }}">
                                        <label for="category" class="form-label">Select Category</label>

                                        <select name="categories[]" class="selectpicker" multiple data-selected-text-format="count">
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                             
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                <div class="form-group form-float">
                                    <div clals="form-line {{ $errors->has('tags') ? 'focused error': ' ' }}">
                                        <label for="tag" class="form-label ">Select Tag</label>
                                      

                                        <select name="tags[ ]" class="selectpicker" multiple data-selected-text-format="count">
                                            @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                                <a type="button" href="{{ route('admin.post.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                                
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD NEW Category
                         
                            </h2>
                            
                        </div>
                        <div class="body">
                            
                               <textarea name="body" id="tinymce" ></textarea>
                            
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <!-- Vertical Layout | With Floating Label -->

        </div>
    </section>

@endsection

@push('js')
<script src="{{ asset('public/assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('public/assets/backend/plugins/tinymce/tinymce.js') }}"></script>

<script>
    $(function () {


    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '{{ asset('public/assets/backend/plugins/tinymce') }}';
});
</script>

@endpush