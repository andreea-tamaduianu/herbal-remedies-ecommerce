@extends('frontend.main_master')
@section('content')

@section('title')
{{ $blogpost->post_title_en }}
@endsection



<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
			<li><a href="{{ url('/') }}">Home</a></li>
				<li class='active'>{{ $blogpost->post_title_en }}</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="row">
			<div class="blog-page">
				<div class="col-md-9">
					<div class="blog-post wow fadeInUp">
						<img class="img-responsive" src="{{ asset($blogpost->post_image) }}" alt="">


						<h1>@if(session()->get('language') == 'romanian') {{ $blogpost->post_title_ro }} @else {{ $blogpost->post_title_en }} @endif</h1>




						<span class="date-time">{{ Carbon\Carbon::parse($blogpost->created_at)->diffForHumans()  }}</span>




						<p> @if(session()->get('language') == 'romanian') {!! $blogpost->post_details_ro !!} @else {!! $blogpost->post_details_en !!} @endif
						</p>






						<!-- Go to www.addthis.com/dashboard to customize your tools -->
						<div class="addthis_inline_share_toolbox_8tvu"></div>


					</div>







					<div class="blog-post-author-details wow fadeInUp">
						<div class="row">
							<div class="col-md-2">
								<img src="{{ asset($adminData->profile_photo_path)}}" alt="Responsive image" class="img-circle img-responsive">
							</div>
							<div class="col-md-10">
								<h3 class="title-review-comments">Author: </h3>
								<h4>{{$adminData->name}}</h4>
								<div class="btn-group author-social-network pull-right">

								</div>

							</div>
						</div>
					</div>
					<div class="blog-review wow fadeInUp">
						<div class="row">
							<div class="col-md-12">
								<h3 class="title-review-comments">{{count($comments)}} comments</h3>
							</div>
							@foreach($comments as $comment)
							<div class="col-md-2 col-sm-2">
								<img src="{{ asset('frontend/assets/images/no_face.png')}}" alt="Responsive image" class="img-rounded img-responsive">
							</div>
							<div class="col-md-10 col-sm-10">
								<div class="blog-comments inner-bottom-xs outer-bottom-xs">
									<h4>{{$comment->name}}</h4>
									<span class="review-action pull-right">
										{{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}} &sol;
										<a href="javascript:void(0)"> Repost</a> &sol;
										<a href="javascript:void(0)"> Reply</a>
									</span>
									<p>{{$comment->comment}}</p>
								</div>
							</div>
							@endforeach

						</div>
					</div>
					<div class="blog-write-comment outer-bottom-xs outer-top-xs">
						<div class="row">
							<form class="register-form" role="form" method="post" action="{{route('create.comment')}}">
								@csrf
								<input type="hidden" name="blog_post_id" value="{{$blogpost->id }}">
								<div class="col-md-12">
									<h4>Leave a comment</h4>
								</div>
								<div class="col-md-6">

									<div class="form-group">
										<label class="info-title" for="exampleInputName">Your name <span>*</span></label>
										<input type="text" class="form-control unicase-form-control text-input" id="exampleInputName" placeholder="" name="name" required>
									</div>

								</div>
								<div class="col-md-6">

									<div class="form-group">
										<label class="info-title" for="exampleInputEmail1">Email address <span>*</span></label>
										<input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="" name="email" required>
									</div>

								</div>

								<div class="col-md-12">

									<div class="form-group">
										<label class="info-title" for="exampleInputComments">Your comments <span>*</span></label>
										<textarea class="form-control unicase-form-control" id="exampleInputComments" name="comment"></textarea required>
									</div>
								
								</div>
							<div class="col-md-12 outer-bottom-small m-t-20">
								<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Submit comment</button>
							</div>
						</form>
						</div>
					</div>
				</div>
				<div class="col-md-3 sidebar">



					<div class="sidebar-module-container">
						<div class="search-area outer-bottom-small">
							<form>
								<div class="control-group">
									<input placeholder="Type to search" class="search-field">
									<a href="#" class="search-button"></a>
								</div>
							</form>
						</div>




						<!-- ======== ====CATEGORY======= === -->
						<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
							<h3 class="section-title">Blog categories</h3>
							<div class="sidebar-widget-body m-t-10">
								<div class="accordion">

									@foreach($blogcategory as $category)
									<ul class="list-group">
										<a href="{{ url('blog/category/post/'.$category->id) }}">
											<li class="list-group-item">@if(session()->get('language') == 'romanian') {{ $category->blog_category_name_ro }} @else {{ $category->blog_category_name_en }} @endif</li>
										</a>

									</ul>
									@endforeach



								</div><!-- /.accordion -->
							</div><!-- /.sidebar-widget-body -->
						</div><!-- /.sidebar-widget -->
						<!-- ===== ======== CATEGORY : END ==== = -->



					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e4b85f98de5201f"></script>


@endsection