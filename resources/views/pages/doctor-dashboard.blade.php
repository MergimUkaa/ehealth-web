@extends('layouts.app')

@section('title', 'Doctor dashboard')


@section('page-styles')
    {{--importing css files regarding to this page--}}
@endsection


@section('content')
 <section class="content-padding">
     <div class="container doctor-dashboard-wrapper">
         <div class="doc-info">
             <h3 class="title">Welcome, <strong class="pink stethoscope">Mërgim Uka</strong></h3>
             <div class="item-info">
                 <p class="boxed-icon location-icon">
                     Vranjevc, Pristina
                 </p>
                 <p class="hospital-icon boxed-icon">American Clinic</p>
                 <p class="department-icon boxed-icon">Endocrinology</p>
             </div>
         </div>
     </div>
     <div id="patient-map"></div>
 </section>
@endsection


@section('page-scripts')

@endsection