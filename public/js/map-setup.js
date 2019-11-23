import {getPatients} from "./helpers/getPatients.js";

if ( document.getElementById("btn-all").classList.contains('active') ){
    getPatients('http://localhost:8000/api/all-patients', 'all');
}
    const btnAll = document.getElementById('btn-all');
    const btnRemote = document.getElementById('btn-remote');
    const btnHospital = document.getElementById('btn-hospital');

    btnAll.addEventListener('click',function () {
        document.getElementById("btn-remote").classList.remove('active');
        document.getElementById("btn-all").classList.add('active');
        document.getElementById("btn-hospital").classList.remove('active');
        getPatients('http://localhost:8000/api/all-patients', 'all');
    });

    btnHospital.addEventListener('click',function () {
        document.getElementById("btn-remote").classList.remove('active');
        document.getElementById("btn-all").classList.remove('active');
        document.getElementById("btn-hospital").classList.add('active');
        getPatients('http://localhost:8000/api/hospital-patients', 'hospital');
    });

    btnRemote.addEventListener('click',function () {
        document.getElementById("btn-remote").classList.add('active');
        document.getElementById("btn-all").classList.remove('active');
        document.getElementById("btn-hospital").classList.remove('active');
        getPatients('http://localhost:8000/api/remote-patients', 'remote');
    });
// document.addEventListener("DOMContentLoaded", function() {
//
//     // btnAll.addEventListener('click',function () {
//     //    console.log(' hdf');
//     // });
//
//
//
//     getPatients();
// });

// document.addEventListener("DOMContentLoaded", function(){
//
//     // async function testApi() {
//
//     //     console.log(JSON.stringify(myJson));
//     // }
//     // testApi();
//     console.log(getPatients());
//
//     getPatients();
//     if(document.getElementById("patient-map")) {
//         let patientMap = L.map('patient-map').setView([59.329323, 18.068581], 13);
//         let mapLayer = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
//         let i = 0;
//         let iconSize = [24,24];
//
//         /*
//         *
//         * Map Pulse Markers
//         *
//         * **/
//
//         let criticalHighIcon = L.icon.pulse({
//             iconSize: iconSize,
//             color: '#F44336',
//             fillColor: '#F44336'});
//
//         let criticalLowIcon = L.icon.pulse({
//             iconSize: iconSize,
//             color: '#FFA726',
//             fillColor: '#FFA726'});
//
//         let lowIcon = L.icon.pulse({
//             iconSize: iconSize,
//             color: '#FF7043',
//             fillColor: '#FF7043'});
//
//         let highIcon = L.icon.pulse({
//             iconSize: iconSize,
//             color: '#FFA726',
//             fillColor: '#FFA726'});
//
//         let normalIcon = L.icon.pulse({
//             iconSize: iconSize,
//             color: '#66BB6A',
//             fillColor: '#66BB6A'});
//
//         /*
//         *
//         * Patient List
//         *
//         * **/
//
//         // let patients = [
//         //     {
//         //         fullName: 'Mergim Uka',
//         //         imageUrl: '../images/avatar/muka.jpg',
//         //         location: 'Stockholm, Sweden',
//         //         statusClass: 'critical-high',
//         //         status: 'critical high',
//         //         statusIcon: criticalHighIcon,
//         //         profileUrl: '/',
//         //         latitude: 59.329323,
//         //         longitude: 18.068581,
//         //     },
//         //     {
//         //         fullName: 'Teuta Koraqi',
//         //         imageUrl: '../images/avatar/tkuka.jpg',
//         //         location: 'Stockholm, Sweden',
//         //         statusClass: 'critical-low',
//         //         status: 'critical low',
//         //         statusIcon: criticalLowIcon,
//         //         profileUrl: '/',
//         //         latitude: 59.332451,
//         //         longitude: 18.091333,
//         //     },
//         //     {
//         //         fullName: 'Mbresa Shehu',
//         //         imageUrl: '../images/avatar/mbresashehu.jpg',
//         //         location: 'Stockholm, Sweden',
//         //         statusClass: 'low',
//         //         status: 'low',
//         //         statusIcon: lowIcon,
//         //         profileUrl: '/',
//         //         latitude: 59.334552,
//         //         longitude: 18.069370
//         //     },
//         //     {
//         //         fullName: 'Arbresha Uka',
//         //         imageUrl: '../images/avatar/arbreshauka.jpg',
//         //         location: 'Stockholm, Sweden',
//         //         statusClass: 'high',
//         //         status: 'high',
//         //         statusIcon: highIcon,
//         //         profileUrl: '/',
//         //         latitude: 59.333326,
//         //         longitude: 18.054956
//         //     },
//         //     {
//         //         fullName: 'Emira Shehu',
//         //         imageUrl: '../images/avatar/mila.jpg',
//         //         location: 'Stockholm, Sweden',
//         //         statusClass: 'normal',
//         //         status: 'normal',
//         //         statusIcon: normalIcon,
//         //         profileUrl: '/',
//         //         latitude: 59.332801,
//         //         longitude: 18.118786
//         //     },
//         // ]
//
//
//
//
//
//         patientMap.scrollWheelZoom.disable();
//
//         L.tileLayer(mapLayer, {
//             maxZoom: 14,
//             id: 'mapbox.streets'
//         }).addTo(patientMap);
//
//         L.icon = function (options) {
//             return new L.Icon(options);
//         };
//
//         /*
//         *
//         * Patients Info Window Popup
//         *
//         * **/
//
//         for (i = 0; i < patients.length; i++) {
//             console.log(' mergim');
//             L.marker([patients[i].latitude, patients[i].longitude], {icon: patients[i].statusIcon}).addTo(patientMap)
//                 .bindPopup("<div class='map-popup" + ' ' + patients[i].statusClass + "'>" +
//                     "              <div class='user-image'>" +
//                     "                  <img src=" + patients[i].imageUrl +">" +
//                     "              </div>" +
//                     "              <div class='info'>" +
//                     "                  <h4>" + patients[i].fullName +"</h4>" +
//                     "                  <p class='location'>" + patients[i].location +"</p>" +
//                     "                  <p class='status'>" + patients[i].status +"</p>" +
//                     "              </div>" +
//                     "              <a href='#' class='btn btn-element small-btn'>View Profile</a>" +
//                     "          </div>").openPopup();
//
//         }
//     }
// });

