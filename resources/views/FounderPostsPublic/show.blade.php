@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top: 130px;" style="align-items: center;">
        {{-- <form action="GET" action="{{ route('auth-founder-posts-show', $post->id) }}">
        @csrf
            <div class="form-group row">
                                <label for="title"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ old('title', $post->title) }}" required autocomplete="title"
                                        autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
        </form> --}}

        <div class="main-container">
            <div class="left">
                <div class="profile-img">
                    <img src="{{asset('/storage/avatars/founders/'.$post->founder_profile->founder_avatar)}}" alt="avatar" style="width: 80px; height:80px;">
                </div>
                <div class="owner-details">
                    <div class="name-surname">
                        <h4>{{ $post->founder_profile->founder_name }}  {{ $post->founder_profile->founder_surname }}</h4>
                    </div>
                    <div class="social">
                        <div class="instagram">
                            <a href="{{ $post->founder_profile->founder_insta_link }}"><i class='bx bxl-instagram instagram-eff'></i></a>
                        </div>
                        <div class="facebook">
                                <a href="{{ $post->founder_profile->founder_face_link }}"><i class='bx bxl-facebook-circle facebook-eff'></i></a>
                        </div>
                        <div class="linkedin">
                                <a href="{{ $post->founder_profile->founder_linked_link }}"><i class='bx bxl-linkedin-square linkedin-eff'></i></a>
                        </div>
                    </div>
                    <div class="organization">
                        <h4><i class='bx bx-buildings'></i> Organization: {{ $post->founder_profile->founder_organization }}</h4>
                    </div>
                    <div class="position">
                        <h4><i class='bx bxs-briefcase' ></i> Position: {{ $post->founder_profile->founder_position }}</h4>
                    </div>
                    <div class="telephone">
                        <h4><i class='bx bx-phone' ></i> Telephone: {{ $post->founder_profile->founder_telephone }}</h4>
                    </div>
                    <div class="location" style="margin-top: 20px;">
                        <h4><i class='bx bx-current-location' style="font-size: 20px;"></i> Location: {{ $post->city }}, {{ $post->country }}</h4>
                    </div>
                    <div class="btns">
                        <a href=""><i class='bx bx-conversation' ></i> Start Conversation</a>
                        @if (Auth::user()->role == "admin")
                            <a href=""><i class='bx bx-star' ></i> Add to Favorites</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="title">
                    <h4>{{ $post->title }}</h4>
                </div>
                <div class="top" style="justify-content: center; padding: 0 10px;">
                    <div class="top-left" style="margin-right: 70px;">
                        <div class="top-organization" style="margin-bottom: 10px">
                            Organization: {{ $post->organization }}
                        </div>
                        <div class="hiring-tag" style="margin-bottom: 10px">
                            Looking for: {{ $post->hiring_tag->name }}
                        </div>
                        <div class="industry-tag" style="margin-bottom: 10px">
                            Industry of Startup: {{ $post->industry_tag->name }}
                        </div>
                        <div class="year" style="margin-bottom: 10px">
                            Startup Established: {{ $post->organization_year }}
                        </div>
                    </div>

                    <div class="top-right">
                        <div class="stage" style="margin-bottom: 10px">
                            Project Stage: {{ $post->project_stage }}
                        </div>
                        <div class="hours" style="margin-bottom: 10px">
                            Hours/Week Required: {{ $post->hours_per_week }}
                        </div>
                        <div class="type" style="margin-bottom: 10px">
                            Work Type: {{ $post->type_week }}
                        </div>
                        <div class="type" style="margin-bottom: 10px">
                            Funded Till Today: {{ $post->investment }}
                        </div>
                    </div>
                </div>
                <div class="bottom" style="margin-top: 30px;">
                    <div class="bottom-1">
                        <div class="bottom-1-title" style="position: relative; padding-right: 10px;">
                            <h4>Post Description:</h4>
                            {{ $post->post_description }}
                        </div>
                        
                    </div>
                    <div class="bottom-2" style="margin-top: 30px;">
                        <div class="bottom-2-title" style="position: relative; padding-right: 10px;">
                            <h4>Organization Description</h4>
                            {{ $post->organization_description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <hr> --}}
        <div class="comment-section">
            <div class="wrapperr">
                <div class="collapsiblee">
                    <input class="check-input" type="checkbox" id="collapsiblee-head">
                    <label for="collapsiblee-head">VIEW AND ADD COMMENTS FOR THIS POST</label>
                    <div class="collapsiblee-text">
                        <h4>Add comment</h4>
                        <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="body"></textarea>
                                <input type="hidden" name="project_post_id" value="{{ $post->id }}" />
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <input type="submit" class="btn btn-primary" value="Add Comment" />
                            </div>
                        </form>

                        <h4 style="margin-top: 30px;">What other people think?</h4>
                        @include('FounderPostsPublic.commentsDisplay', ['comments' => $post->comments, 'project_post_id' => $post->id])
                    </div>
                </div>
            </div>
        </div>
        
    </div>


    <style>
        
        .main-container {
            display: flex;
            box-shadow: 0 5px 10px rgba(0,0,0,0.5);
            border-radius: 20px;
        }

        .left {
            width: 500px;
            background: #fff;
            height: 70vh;
            display: block;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        .right {
            width: 800px;
            background: #ccc;
            height: 70vh;
            display: block;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .profile-img {
            text-align: center;
            margin-top: 40px;
        }

        .owner-details {
            text-align: center;
            display: block;
        }

        .owner-details h4 {
            font-size: 15px;
        }

        .name-surname {
            margin-top: 10px;
        }

        img {
            border-radius: 50%;
            margin-top: 20px;
        }

        .organization {
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .organization i {
            font-size: 20px;
        }

        .telephone i {
            font-size: 20px;
        }

        .position {
            margin-bottom: 20px;
        }

        .position i {
            font-size: 20px;
        }

        .social {
            display: flex;
            text-align: center;
            align-items: center;
            justify-content: center;
        }

        .social i {
            font-size: 30px;
            cursor: pointer;
            margin: 0 10px;
            transition: 0.5s all ease;
            color: black;
        }

        .btns {
            margin-top: 40px;
            display: block;
        }

        .btns a {
            text-decoration: none;
            color: black;
            padding: 5px 15px;
            border: 1px solid orange;
            transition: 0.3s all ease;
        }

        .btns a:hover {
            background: orange;
            color: white;
        }

        .instagram-eff:hover {
            color: #fff;
            background: #d6249f;
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%);
            border-radius: 30px;
        }
        .facebook-eff:hover {
            color: #3b5998;
        }
        .linkedin-eff:hover {
            color: #0072b1;
        }

        .top {
            display: flex;
        }

        .top-left {
            display: block;
        }

        .title {
            margin-top: 30px;
            text-align: center;
            padding: 0 10px;
            margin-bottom: 30px;
        }

        .bottom {
            display: block;
            margin-left: 100px;
        }

        /* Comments Collapsible Section */
        .wrapperr {
            width: 1300px;
            display: flex;
            padding-top: 50px;
            justify-content: center;
        }

        .collapsiblee {
            width: 1300px;
            overflow: hidden;
            font-weight: 500;
        }

        .collapsiblee .check-input  {
            display: none;
        }

        .collapsiblee label {
            width: 1300px;
            position: relative;
            font-weight: 600;
            background: #fff;
            box-shadow: 0 5px 11px 0 rgba(0, 0, 0, .1), 0 4px 11px 0 rgba(0, 0, 0, .08);
            color: #1c1c6b;
            display: block;
            margin-bottom: 10px;
            cursor: pointer;
            padding: 15px 10px;
            border-radius: 8px;
            z-index: 1;
            transition: 0.3s;
        }

        .collapsiblee label:hover {
            background: orange;
            color: #fff;
        }

        .collapsiblee label::after {
            content: "";
            position: absolute;
            right: 15px;
            top: 15px;
            width: 18px;
            height: 18px;
        }

        /* .collapsiblee input:checked + label::after {

        } */

        .collapsiblee-text {
            padding: 20px 40px;
            max-height: 1px;
            overflow: hidden;
            border-radius: 4px;
            line-height: 1.4;
            position: relative;
            top: -100%;
            opacity: 0.5;
            transition: all 0.3s ease;
            overflow: auto;
        }

        .collapsiblee input:checked ~ .collapsiblee-text {
            max-height: 500px;
            padding-bottom: 25px;
            background: #fff;
            box-shadow: 0 5px 11px 0 rgba(0, 0, 0, .1), 0 4px 11px 0 rgba(0, 0, 0, .08);
            opacity: 1;
            top: 0;
        }

        .collapsiblee-text h2 {
            margin-bottom: 10px;
            padding: 15px 15px 0;
        }

        /* Responsive part */

        @media screen and (max-width: 1400px) {
            .bottom {
                margin-left: 45px;
            }
        }

        @media screen and (max-width: 1200px) {
            .bottom {
                margin-left: 0px;
                padding: 0 10px;
            }
        }

        @media screen and (max-width: 1000px) {
            .main-container{
                display: block;
            }
            .left {
                width: 650px;
                border-bottom-left-radius: 0px;
                border-top-right-radius: 20px;
            }

            .right {
                width: 650px;
                border-top-right-radius: 0px;
                border-bottom-left-radius: 20px;
            }
            .main-container {
                width: 650px;
            }
        }

        @media screen and (max-width: 765px) {
            .container {
            }
            .main-container{
                display: block;
            }

            .left {
                width: 500px;
            }

            .right {
                width: 500px;
            }
            .main-container {
                width: 500px;
            }
        }
    </style>

@endsection