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
                 <div class="item-info">
                     <h3 class="pink name">Teuta Koraqi</h3>
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
     <div class="insights-content">
         <div class="left-side-bar">
             <div class="container">
                 <div class="left-side-bar">
                     <h4 class="subtitle">Contact Info</h4>
                     <div class="">
                         <label class="label-item">Email</label>
                         <p class="label-value">teuta_koraqi@hotmail.com</p>
                         <div class="">
                             <label class="label-item">Tel</label>
                             <p class="label-value">049884409</p>
                         </div>

                         <div class="">
                             <label class="label-item">Room No.</label>
                             <p class="label-value">345</p>
                         </div>

                         <div class="">
                             <label class="label-item">Bed No.</label>
                             <p class="label-value">32</p>
                         </div>
                     </div>
                     <div class="">
                         <label class="label-item">Age</label>
                         <p class="label-value">27 years old</p>
                     </div>



                     <div class="card">
                         sensor properties
                         <p>Name</p>
                         <p>Manifacture</p>
                         <p>Pulse: 80/160</p>
                     </div>
                 </div>
                 <div class="chart-container">
                     <canvas id="canvas"></canvas>
                 </div>
             </div>
         </div>
     </div>
 </section>
@endsection


@section('page-scripts')

@endsection