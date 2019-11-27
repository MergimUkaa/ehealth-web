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
                     <h3 class="user-name big-title">
                         Mergim Uka
                         {{--{{$user->name}} {{$user->surname}}--}}
                     </h3>
                     <p class="boxed-icon location-icon">
                         Zurich
{{--                         {{$user->address}}, {{$user->city->name}}--}}
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
     <div class="container clearfix">
         <div class="filter-map-controls">
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
        // const app = new Vue({
        //     el: '#app',
        // });
       const app = new Vue({
           el: '#app',
          data: {
            a: 'Mergim'
          },
           mounted() {
               console.log(this.a);
               this.listen();
           },
           methods: {
               listen() {
                   Echo.channel('home')
                       .listen('NewMessage', (e) => {
                           console.log(e);
                       })
               }
           }
       });

        Echo.channel('home').listen('NewMessage', (e)=>{
            console.log(e);
        })
    </script>
    <script src="{{asset('js/map-setup.js')}}" type="module"></script>


@endsection
