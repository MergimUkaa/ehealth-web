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
    normalIconProps,
    markerIcon
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

        L.tileLayer(mapLayer, {
            maxZoom: 16,
            id: 'mapbox.streets'
        }).addTo(patientMap);


        Echo.channel('StreamingData').listen('ReadStreamingData', function (e) {
            let index;
            console.log(e);
            // index =  myJson.findIndex(x => x.sensorId === e.data[0].sensor_id);

            markerLayers.clearLayers();

            myJson.map((patient, i) => {
                if (!patient.sensorId) {
                    myJson.splice(i, 1);
                }

                if (e.data.length < 1 ) {
                    patient.icon = markerIcon(patient.status);
                    if (patient.status) {
                        statusClass = patient.status.split(' ').join('-');
                        statusText = patient.status;
                    } else {
                        statusClass = 'not-measured';
                        statusText = 'Nuk ka te dhena!';
                    }
                    measuredTime = patient.measuredTime ? patient.measuredTime : 'Data nuk ekziston!';

                    var marker = markerWithTooltip(patient);

                    markerLayers.addLayer(marker);
                    return;
                }


                e.data.map((el) => {
                    if (el.sensor_id === patient.sensorId) {
                            patient.icon = markerIcon(patient.status, true);
                    } else {
                       patient.icon = markerIcon(patient.status);
                    }
                });
                console.log(patient);
                if (patient.status) {
                    statusClass = patient.status.split(' ').join('-');
                    statusText = patient.status;
                } else {
                    statusClass = 'not-measured';
                    statusText = 'Nuk ka te dhena!';
                }
                measuredTime = patient.measuredTime ? patient.measuredTime : 'Data nuk ekziston!';

                var marker = markerWithTooltip(patient);

                markerLayers.addLayer(marker);

            });
        });

        myJson.map((patient, i) => {
            if (!patient.sensorId) {
                myJson.splice(i, 1);
            }
          patient.icon = markerIcon(patient.status);

            if (patient.status) {
                statusClass = patient.status.split(' ').join('-');
                statusText = patient.status;
            } else {
                statusClass = 'not-measured';
                statusText = 'Nuk ka te dhena!';
            }
            measuredTime = patient.measuredTime ? patient.measuredTime : 'Data nuk ekziston!';


            var marker = markerWithTooltip(patient);

            markerLayers.addLayer(marker);

        });

    }
}

markerLayers.addTo(patientMap);

function markerWithTooltip(patient) {
  return  L.marker([patient.latitude, patient.longitude], {icon: patient.icon})
        .bindPopup("<div class='map-popup" + ' ' + statusClass + "'>" +
            "              <div class='user-image'>" +
            // "                  <img src=" + patients[i].imageUrl + ">" +
            "                  <span class='initials'>" + patient.initials + "</span>" +
            "              </div>" +
            "              <div class='info'>" +
            "                  <h4>" + patient.name + ' ' + patient.surname + "</h4>" +
            "                  <p class='location'>" + patient.address + ", " + patient.city + "</p>" +
            "                  <p class='status'>" + statusText + "</p>" +
            "                  <p class='time'>" + measuredTime + "</p>" +
            "              </div>" +
            "              <a href='"+window.origin+"/patient/"+patient.id+"' class='btn btn-element small-btn'>View Profile</a>" +
            "          </div>").openPopup()
}
export {getPatients};
