import {
    notMeasuredIcon,
    lowIcon,
    highIcon,
    criticalLowIcon,
    criticalHighIcon,
    normalIcon,
    notMeasuredProps,
    lowProps,
    highProps,
    criticalLowProps,
    criticalHighProps,
    normalIconProps
} from "./iconTypes.js";

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



let patients = [];
let statusClass;
let statusText;
let measuredTime;

async function getPatients(apiUrl) {


    if (document.getElementById("patient-map")) {

        markerLayers.clearLayers();
        patientMap.scrollWheelZoom.disable();


        const response = await fetch(apiUrl);
        const myJson = await response.json();
        let icon;



        myJson.map((patient, index) => {
            if (!patient.sensorId) {
                myJson.splice(index, 1);
            }

            patients.push(patient);
            switch (patient.status) {
                case 'critical high':
                    patient.icon = normalIcon;
                    break;
                case 'critical low':
                    patient.icon = criticalLowIcon;
                    break;
                case 'high':
                    patient.icon = highIcon;
                    break;
                case 'low':
                    patient.icon = lowIcon;
                    break;
                case 'normal':
                    patient.icon = normalIcon;
                    break;
                default: patient.icon = notMeasuredIcon;
            }


        });
        console.log(myJson);

        /*
        *
        * Patients Info Window Popup
        *
        * **/
        L.tileLayer(mapLayer, {
            maxZoom: 16,
            id: 'mapbox.streets'
        }).addTo(patientMap);


        Echo.channel('StreamingData').listen('ReadStreamingData', function (e) {
            console.log(e.data[0].sensor_id);
            console.log(e);
            let index;
            // index =  myJson.findIndex(x => x.sensorId === e.data[0].sensor_id);
            myJson.some(function(entry, i) {
                 if (entry.sensorId === e.data[0].sensor_id){
                    return true;
                }
            });
        });
        for (i = 0; i < patients.length; i++) {
            if (i === 1) {
                patients[i].icon = L.icon.pulse(lowProps);
            }
             if (i === 35) {
                 patients[i].icon = L.icon.pulse(normalIconProps);
             }
            if (patients[i].status) {
                statusClass = patients[i].status.split(' ').join('-');
                statusText = patients[i].status;
            } else {
                statusClass = 'not-measured';
                statusText = 'Nuk ka te dhena!';
            }
            measuredTime = patients[i].measuredTime ? patients[i].measuredTime : 'Data nuk ekziston!';


            var marker = L.marker([patients[i].latitude, patients[i].longitude], {icon: patients[i].icon})
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
