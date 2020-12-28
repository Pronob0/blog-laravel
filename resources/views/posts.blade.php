@extends('layouts.frontend.layout.main')
@section('title','Post')
@push('css')
<link href="{{ asset('public/assets/frontend/css/allpost/styles.css') }}" rel="stylesheet"> 
 <link href="{{ asset('public/assets/frontend/css/allpost/responsive.css') }}" rel="stylesheet">  

@endpush

@section('content')
<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>BEAUTY</b></h1>
	</div><!-- slider -->

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

								<h4 class="title"><a href="{{ route('post.details',$post->slug) }}"><b>{{ $post->title }}</b></a></h4>

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

				
			</div><!-- row -->

			{{ $posts->links() }}

		</div><!-- container -->
	</section><!-- section -->


 	</section>   
@endsection
@push('js')
    
@endpush