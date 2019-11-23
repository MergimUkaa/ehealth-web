@extends('structure.layout')

@section('title', 'Doctor dashboard')


@section('page-styles')
    {{--importing css files regarding to this page--}}
@endsection


@section('content')

 <section class="content-padding pt-0  doctor-dashboard-wrapper">
     <div class="banner-with-pattern">
         <div class="container">
             <div class="doc-info user-info-details">
                 <div class="initials big">MU</div>
                 <div class="item-info">
                     <h3 class="user-name big-title">{{$user->name}} {{$user->surname}}</h3>
                     <p class="boxed-icon location-icon">
                         {{$user->address}}, {{$user->city->name}}
                     </p>
                     <div class="wrapped-sub-info">
                         <p class="flex-item">
                             <span class="label-item">Hospital</span>
                             American Clinic
                         </p>
                         <p class="flex-item">
                             <span class="label-item">Department</span>
                             Endocrinology
                         </p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="container clearfix mt-5">
         <div class="filter-map-controls mt-5">
             {{--Each button gets class --active-- when is clicked and the patients on the map are filtered--}}
             <button class="btn active" data-toggle="tooltip" data-placement="top" title="See all patients" id="btn-all">
                 See all
             </button>
             <button class="btn" data-toggle="tooltip" data-placement="top" title="See remote patients" id="btn-remote">
                 Remote
             </button>
             <button class="btn" data-toggle="tooltip" data-placement="top" title="See patients on the hospital" id="btn-hospital">
                Hospital
             </button>
         </div>
     </div>
     <div id="patient-map"></div>
 </section>
@endsection

@section('page-scripts')
    <script>
    </script>
    <script src="{{asset('js/map-setup.js')}}" type="module"></script>


@endsection
