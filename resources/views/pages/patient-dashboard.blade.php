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
                     <h3 class="user-name big-title">Mergim Uka</h3>
                     <p class="boxed-icon location-icon">
                         Zurich, Swiss
                     </p>
                     <p class="sub-info grey-font">
                         mergim@gmail.com, +38349111122
                     </p>

                     <div class="divided-column">
                         <div class="wrapped-sub-info">
                             <p class="flex-item">
                                 <span class="label-item">Hospital</span>
                                 American Clinic
                             </p>
                             <p class="flex-item">
                                 <span class="label-item">Department</span>
                                 Endocrinology
                             </p>
                             <p class="flex-item">
                                 <span class="label-item">Room No.</span>
                                 345
                             </p>
                             <p class="flex-item">
                                 <span class="label-item">Bed No.</span>
                                 245
                             </p>
                             <p class="flex-item">
                                 <span class="label-item">Age</span>
                                 26 years
                             </p>
                         </div>
                         <div class="card patient-card">
                             <span class="card-name">Vizita</span>
                             <h3 class="name">Mergim Uka</h3>
                             <p class="date">6 January, 2020</p>
                             <div class="wrapped-sub-info">
                                 <p class="flex-item blood-type">
                                     <span class="label-item">Blood Type</span>
                                     0 positive
                                 </p>
                                 <p class="flex-item">
                                     <span class="label-item">Allergies</span>
                                     No allergies
                                 </p>
                             </div>
                             <p class="mb-0">
                                 <span class="label-item">Diagnose</span>
                                 Flu and some problems with ear hearing
                             </p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="insights-content">
         <div class="left-side-bar">
             <div class="container">
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
