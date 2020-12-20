@extends('layouts.backend.main')
@section('title','Category')
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
                                ADD NEW Category
                         
                            </h2>
                            
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="name" name="name" class="form-control">
                                        <label class="form-label">Category Name</label>
                                    </div> <br>
                                    <div class="form-line">
                                        <input type="file" id="image" name="image" class="form-control">
                                        
                                    </div>
                                </div>
                               
                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
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