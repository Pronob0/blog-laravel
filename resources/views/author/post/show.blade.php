@extends('layouts.backend.main')
@section('title','Post')
@push('css')
<link href="{{ asset('public/assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush



@section('content')

<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Posted By: {{ $post->user->name }}
                    <small>{{ $post->created_at }}</small>
                </h2>
            </div>

 @if($errors->any())
 @foreach ($errors->all() as $error)
           <div class="alert alert-danger" role="alert">
        {{ $error }}
            </div>
 @endforeach
 @endif
          
            
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                             {{ $post->title }}
                         
                            </h2>
                            
                        </div>
                        <div class="body">
                            
                            {!! $post->body !!}
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue text-center">
                            <h2>
                                    Category
                         
                            </h2>
                            
                        </div>
                        <div class="body">
                            
                               @foreach ($post->categories as $category)
                               <span class="label bg-cyan">{{ $category->name }}</span>
                                   
                               @endforeach
                                
                            
                        </div>
                    </div>
                    <div class="card">
                        <div class="header bg-green text-center">
                            <h2>
                                Tag
                         
                            </h2>
                            
                        </div>
                        <div class="body">
                            
                                @foreach ($post->tags as $tag)
                                    <span class="label bg-cyan">{{ $tag->name }}</span>
                                @endforeach
                               
                                
                            
                        </div>
                    </div>
                    <div class="card">
                        <div class="header bg-blue text-center">
                            <h2>
                                Featured Image
                         
                            </h2>
                            
                        </div>
                        <div class="body">
                         <img class="img-responsive thhumbnail" src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="">
                         </div>
                    </div>
                </div>
            </div>

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