<!--================Scripts Area =================-->
{{--<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"--}}
        {{--integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="--}}
        {{--crossorigin=""></script>--}}
{{--<script>--}}
    {{--debugger;--}}

    {{--var map = L.map('map').setView([51.505, -0.09], 13);--}}

    {{--L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {--}}
        {{--attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'--}}
    {{--}).addTo(map);--}}

    {{--L.marker([51.5, -0.09]).addTo(map)--}}
        {{--.bindPopup('A pretty CSS3 popup.<br> Easily customizable.')--}}
        {{--.openPopup();--}}
{{--</script>--}}

{{--include js files and libraries--}}


{{--<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>--}}


<!-- Scripts -->
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>

{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/L.Icon.Pulse.js')}}"></script>
<script src="{{asset('js/chart-setup.js')}}"></script>


<!--================End Scripts Area =================-->
