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
                 <div class="initials big">{{substr($patient->name,0,1)}} {{substr($patient->surname,0,1)}}</div>
                 <div class="item-info">
                     <h3 class="user-name big-title">{{$patient->name}} {{$patient->surname}}</h3>
                     <p class="boxed-icon location-icon">
                        {{ $patient->address}}, {{$patient->city->name}}
                     </p>
                     <p class="sub-info grey-font">
                         {{$patient->email}}, {{$patient->phone}}
                     </p>

                     <div class="divided-column">
                         @if($patient && $patient->bedNumber)
                         <div class="wrapped-sub-info">
                             <p class="flex-item">
                                 <span class="label-item">Hospital</span>
                                 {{$patient->hospitalName}}
                             </p>
                             <p class="flex-item">
                                 <span class="label-item">Department</span>
                                 {{$patient->repartName}}
                             </p>
                             <p class="flex-item">
                                 <span class="label-item">Room No.</span>
                                 {{$patient->roomNumber}}
                             </p>
                             <p class="flex-item">
                                 <span class="label-item">Bed No.</span>
                                 {{$patient->bedNumber}}
                             </p>
                             <p class="flex-item">
                                 <span class="label-item">Age</span>
                                 {{\Carbon\Carbon::createFromDate($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y')}} years
                             </p>
                         </div>
                         @endif
                         <div class="card patient-card">
                             <span class="card-name">Vizita</span>
                             <h3 class="name">{{$patient->name}} {{$patient->surname}}</h3>
                             <p class="date">{{\Carbon\Carbon::createFromDate($patient->visitDate)->format(' jS  m Y h:i A')}} </p>
                             <div class="wrapped-sub-info">
                                 <p class="flex-item blood-type">
                                     <span class="label-item">Blood Type</span>
                                     {{$patient->blood_group}}
                                 </p>
                                 <p class="flex-item">
                                     <span class="label-item">Allergies</span>
                                   {{$patient->allergies ? $patient->allergies : 'No allergies'}}
                                 </p>
                             </div>
                             <p class="mb-0">
                                 <span class="label-item">Diagnose</span>
                                 {{$patient->diagnosis}}
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
                 <div class="chart-container" id="app">
                     @switch($patient->parameter)
                         @case('temperature')
                         <live-updating-temperature-chart></live-updating-temperature-chart>
                         @break
                         @case('pulse')
                         <live-updating-pulse-chart></live-updating-pulse-chart>
                         @break
                         @case('blood pressure')
                         <live-updating-blood-pressure-chart></live-updating-blood-pressure-chart>
                         @break
                         @endswitch
                 </div>
             </div>
         </div>
     </div>
 </section>
@endsection


@section('page-scripts')
    <script>

    </script>
@endsection
