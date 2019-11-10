@extends('layouts.app')

@section('title', 'Doctor dashboard')


@section('page-styles')
    {{--importing css files regarding to this page--}}
@endsection


@section('content')
 <section class="content-padding pt-0  doctor-dashboard-wrapper">
     <div class="banner-with-pattern">
         <div class="container">
             <div class="doc-info">
                 <h3 class="title">Welcome,</h3>
                 <div class="item-info">
                     <h3 class="pink name">Mërgim Uka</h3>
                     <div class="">
                         <p class="boxed-icon location-icon">
                             Vranjevc, Pristina
                         </p>
                         <p class="hospital-icon boxed-icon">American Clinic</p>
                         <p class="department-icon boxed-icon">Endocrinology</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="container clearfix mt-5">
         <div class="filter-map-controls mt-5">
             {{--Each button gets class --active-- when is clicked and the patients on the map are filtered--}}
             <button class="btn active" data-toggle="tooltip" data-placement="top" title="See all patients">
                 See all
             </button>
             <button class="btn" data-toggle="tooltip" data-placement="top" title="See remote patients">
                 Remote
             </button>
             <button class="btn" data-toggle="tooltip" data-placement="top" title="See patients on the hospital">
                Hospital
             </button>
         </div>
     </div>
     <div id="patient-map"></div>
 </section>
@endsection


@section('page-scripts')

@endsection