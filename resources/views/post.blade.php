@extends('layouts.frontend.layout.main')
@section('title','Post')
@push('css')
<link href="{{ asset('public/assets/frontend/post/css/styles.css') }}" rel="stylesheet"> 
 <link href="{{ asset('public/assets/frontend/post/css/responsive.css') }}" rel="stylesheet">  
  <style>
	  .post_image{
		  height:500px;
		  width: 100%;
	  }
  </style>
@endpush

@section('content')
 	<div class="post">
		 <img class="img-fluid post_image" src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="">
	</div><!-- slider -->

	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" alt="{{ $post->user->name }}"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{ $post->user->name }}</b></a>
									<h6 class="date">on {{ $post->created_at->diffForHumans() }}</h6>
								</div>

							</div><!-- post-info -->

							<h3 class="title"><a href="#"><b>{{ $post->title }}</b></a></h3>

							<div class="para">
								{!! html_entity_decode($post->body) !!}
							</div>

							
							<ul class="tags">

								@foreach ($post->tags as $tag)
									<li><a href="#">{{ $tag->name }}</a></li>
								@endforeach	
								
							</ul>
						</div><!-- blog-post-inner -->

						<div class="post-icons-area">
							<ul class="post-icons">
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

							<ul class="icons">
								<li>SHARE : </li>
								<li><a href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
							</ul>
						</div>


					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					<div class="single-post info-area">

						<div class="sidebar-area about-area">
							<h4 class="title"><b>ABOUT AUTHOR</b></h4>
							<p>{{ $post->user->about }}</p>
						</div>

						

						<div class="tag-area">

							<h4 class="title"><b>Categories </b></h4>
							<ul>
								
								@foreach ($post->categories as $category)
									<li><a href="#">{{ $category->name }}</a></li>
								@endforeach	
								
							</ul>

						</div><!-- subscribe-area -->

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">
				@foreach ($randomposts as $randompost)
				
					<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$randompost->image) }}" alt="{{ $randompost->title }}"></div>

							<a class="avatar" href="#"><img src="images/icons8-team-355979.jpg" alt="Profile Image"></a>

							<div class="blog-info">

								<h4 class="title"><a href="{{ route('post.details',$randompost->slug) }}"><b>{{ $randompost->title }}</b></a></h4>

								<ul class="post-footer">
									<li>
										@guest
											<a href="" onclick="toastr.info('To add to favourite list u have to log in first','Info',{
												closeButton:true,
												progressbar:true,
											})"><i class="ion-heart"></i>{{ $randompost->favourite_to_users->count() }}</a>

										@else
										<a href="javascript:void(0);" onclick="document.getElementById('favourite-post-{{ $randompost->id }}').submit();"><i class="ion-heart"></i>{{ $randompost->favourite_to_users->count() }}</a>


										<form id="favourite-post-{{ $randompost->id }}" method='POST' action="{{ route('post.favourite',$randompost->id) }}" style="display:none">
										@csrf
									</form>


										@endguest
										
									
									</li>
									<li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
									<li><a href="#"><i class="ion-eye"></i>{{ $randompost->view_count }}</a></li>
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div>
				@endforeach
	
				
				

				

			</div><!-- row -->

		</div><!-- container -->
	</section>

	<section class="comment-section">
		<div class="container">
			<h4><b>POST COMMENT</b></h4>
			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="comment-form">
						@guest


						<p>You need to login first to comment.<a href="{{ route('login') }}">Login</a></p>

						@else
						<form action="{{ route('comment.store',$post->id) }}" method="post">
							@csrf
							<div class="row">

						

								<div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
										placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
								</div><!-- col-sm-12 -->
								<div class="col-sm-12">
									<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
								</div><!-- col-sm-12 -->

							</div><!-- row -->
						</form>
						
						@endguest
						
					</div><!-- comment-form -->

					<h4><b>COMMENTS({{ $post->comments()->count() }})</b></h4>


@foreach ($post->comments as $comment)
	<div class="commnets-area ">

						<div class="comment">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$comment->user->image) }}" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
									<h6 class="date">{{ $comment->created_at->diffForHumans() }}</h6>
								</div>

								

							</div><!-- post-info -->

							<p>{{ $comment->comment }}</p>

						</div>

					</div><!-- commnets-area -->
@endforeach

					

					<a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>

				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>   
@endsection
@push('js')
    
@endpush