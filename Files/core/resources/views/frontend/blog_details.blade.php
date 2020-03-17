@extends('frontend.master')
@section('title','Blog Details')
@section('content')
    <!-- agent details begin-->

    @include('frontend.partials.breadcrumb',['title'=>'Blog Details','item'=>['Blog Details'=>null]])

    <!--Blog Area-->
    <!--Blog Details Area-->
    <section class="blog-details-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="blog-details-content">
                        <img src="{{asset('assets/backend/image/blog/post/'.$post->image)}}" alt="" />
                        <div class="single-blog-content-meta">
                            <a href="{{route('blog',$post->category->id)}}"><i class="fa fa-folder-open"></i> {{$post->category->name}}</a>
                            <a href=""><i class="fa fa-calendar"></i> {{$post->created_at->format('d/m/Y')}}</a>
                            <a href=""><i class="fa fa-eye"></i> {{$post->hit}}</a>
                        </div>
                        <h2 class="cl-black mb-20"><a href="" class="cl-black">{{$post->title}}</a></h2>
                        {{ $post->details }}
                        <div class="blog-tag-share mt-50">

                            <div class="blog-share">
                                <i class="fa fa-share"></i>
                                <a  href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a  href="https://twitter.com/intent/tweet?text=my share text&amp;url={{urlencode(url()->current()) }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a  href="https://plus.google.com/share?url={{urlencode(url()->current()) }}" target="_blank"><i class="fa fa-google-plus"></i></a>
                                <a  href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}&amp;title=my share text&amp;summary=dit is de linkedin summary" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="blog-comments">

                            <div class="blog-comments">
                                <div class="fb-comments"  data-width="100%"
                                     data-href="{{url()->current()}}"
                                     data-numposts="5"></div>
                                <div id="fb-root"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5 wow fadeInRight" data-wow-delay="0.4s">
                    <div class="page-sidebar">

                        <div class="single-sidebar-block category-list">
                            <h3>Category</h3>
                            <ul class="cat-anchors">
                                @foreach($categories as $cat)
                                <li><a href="{{route('blog',$cat->id)}}">{{$cat->name}} <span>({{$cat->post_count}})</span></a></li>
                              @endforeach
                            </ul>
                        </div>
                        <div class="single-sidebar-block most-viewed-post">
                            <h3>Most Viewed Posts</h3>
                            <div class="viewed-post">
                                <div class="row">
                                    @foreach($most_view_post as $m_v_post)
                                    <div class="col-6">
                                        <a href="{{route('blog-details',[$m_v_post->id,str_slug($m_v_post->title)])}}" class="single-most-viewed-post mb-30">
                                            <img src="{{asset('assets/backend/image/blog/post/'.$m_v_post->thumb)}}" alt="">
                                            <h4>{{$m_v_post->title}}</h4>
                                        </a>
                                    </div>
                                   @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section><!--/Blog Details Area-->


@endsection
@section('script')

    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId={{web_setting()->general_general_section_fb_comment_script}}&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    @endsection