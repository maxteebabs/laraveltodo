@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="main">
                <div class="presentation-left">
                    <img src="{{URL::asset('/images/welcome-left.png')}}" 
                    class="image-left x-hidden-focus" alt="left-images"/>
                </div>
                <div class="interaction">
                    <div class="interaction-top"> 
                        <h1 class="">Docler Holdings</h1>
                        <span class="description">A simple Todo App</span>
                    </div>
                    <div class="interaction-signin">
                        <a href="{{url('task')}}" 
                            class="button text-center mt-20 inline-block">Get Started</a>
                    </div>
                </div>
                <div class="presentation-right">
                    <img src="{{URL::asset('/images/welcome-right.png')}}"
                        class="image-right"
                        alt="right-images"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
