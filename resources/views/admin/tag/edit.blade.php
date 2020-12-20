@extends('layouts.backend.main')
@section('title','Tag')
@push('css')
 
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
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD NEW TAG
                         
                            </h2>
                            
                        </div>
                        <div class="body">
                           
                            <form action="{{ route('admin.tag.update',$tag->id) }}" method="POST" >
                                @csrf
                                @method('PUT')
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="name" name="name" value="{{ $tag->name }} " class="form-control">
                                        <label class="form-label">Tag Name</label>
                                    </div>
                                </div>
                               
                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->

        </div>
    </section>

@endsection

@push('js')

@endpush