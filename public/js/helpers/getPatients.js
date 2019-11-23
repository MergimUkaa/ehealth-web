import {notMeasuredIcon, lowIcon, highIcon, criticalLowIcon, criticalHighIcon, normalIcon} from "./iconTypes.js";

let patientMap = L.map('patient-map').setView([42.639885, 20.891453], 10);
let mapLayer = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
let i = 0;
let markers = [];
let markerLayers = new L.LayerGroup();


/*
*
* Map Pulse Markers
*
* **/

Echo.channel('home').listen('NewMessage', function (e) {
    console.log(e);
});


let patients = [];
let statusClass;
let statusText;
let measuredTime;


async function getPatients(apiUrl) {


    if (document.getElementById("patient-map")) {

        markerLayers.clearLayers();
        const response = await fetch(apiUrl);
    const myJson = await response.json();

        myJson.map(patient => {
            if (patient.sensorId) {
                patients.push(patient);
            }
        });

        /*
        *
        * Patients Info Window Popup
        *
        * **/
        patientMap.scrollWheelZoom.disable();

        L.tileLayer(mapLayer, {
            maxZoom: 16,
            id: 'mapbox.streets'
        }).addTo(patientMap);

        L.icon = function (options) {
            return new L.Icon(options);
        };
        let icon;
        for (i = 0; i < patients.length; i++) {
            if (patients[i].status) {
                statusClass = patients[i].status.split(' ').join('-');
                statusText = patients[i].status;
            } else {
                statusClass = 'not-measured';
                statusText = 'Nuk ka te dhena!';
            }
            measuredTime = patients[i].measuredTime ? patients[i].measuredTime : 'Data nuk ekziston!';
            switch (patients[i].status) {
                case 'critical high':
                    icon = criticalHighIcon;
                    break;
                case 'critical low':
                    icon = criticalLowIcon;
                    break;
                case 'high':
                    icon = highIcon;
                    break;
                case 'low':
                    icon = lowIcon;
                    break;
                case 'normal':
                    icon = normalIcon;
                    break;
                case false:
                    icon = notMeasuredIcon;
                    break;
            }
            var marker = L.marker([patients[i].latitude, patients[i].longitude], {icon: icon})
                .bindPopup("<div class='map-popup" + ' ' + statusClass + "'>" +
                    "              <div class='user-image'>" +
                    // "                  <img src=" + patients[i].imageUrl + ">" +
                    "                  <span class='initials'>" + patients[i].initials + "</span>" +
                    "              </div>" +
                    "              <div class='info'>" +
                    "                  <h4>" + patients[i].name + ' ' + patients[i].surname + "</h4>" +
                    "                  <p class='location'>" + patients[i].address + ", " + patients[i].city + "</p>" +
                    "                  <p class='status'>" + statusText + "</p>" +
                    "                  <p class='time'>" + measuredTime + "</p>" +
                    "              </div>" +
                    "              <a href='#' class='btn btn-element small-btn'>View Profile</a>" +
                    "          </div>").openPopup();

            markerLayers.addLayer(marker);

        }

        patients = [];

    }
}

markerLayers.addTo(patientMap);
export {getPatients};
