@extends('layouts.frontend.layout.main')
@section('title','Blog')
@push('css')
    <link href="{{ asset('public/assets/frontend/home/css/styles.css') }}" rel="stylesheet">

	<link href="{{ asset('public/assets/frontend/home/css/responsive.css') }}" rel="stylesheet">
@endpush
@if($errors->any())
 @foreach ($errors->all() as $error)
           <div class="alert alert-danger" role="alert">
        {{ $error }}
            </div>
 @endforeach
 @endif
@section('content')


	<section class="blog-area section">
		<div class="container">

			<div class="row">
				@foreach ($posts as $post)
					<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="{{ $post->title }}"></div>

							<a class="avatar" href="#"><img src="images/icons8-team-355979.jpg" alt="Profile Image"></a>

							<div class="blog-info">

								<h4 class="title"><a href="#"><b>{{ $post->title }}</b></a></h4>

								<ul class="post-footer">
									<li>
										@guest
											<a href="" onclick="toastr.info('To add to favourite list u have to log in first','Info',{
												closeButton:true,
												progressbar:true,
											})"><i class="ion-heart"></i>{{ $post->favourite_to_users->count() }}</a>

										@else
										<a href="javascript:void(0);" onclick="document.getElementById('favourite-post-{{ $post->id }}').submit();"><i class="ion-heart"></i>{{ $post->favourite_to_users->count() }}</a>


										<form id="favourite-post-{{ $post->id }}" method='POST' action="{{ route('post.favourite',$post->id) }}" style="display:none">
										@csrf
									</form>


										@endguest
										
									
									</li>
									<li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
									<li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div>
				@endforeach

				<!-- col-lg-4 col-md-6 -->

				

			</div><!-- row -->

			<a class="load-more-btn" href="#"><b>LOAD MORE</b></a>

		</div><!-- container -->
	</section><!-- section -->
    
@endsection
@push('js')

@endpush


