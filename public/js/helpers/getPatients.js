let patientMap = L.map('patient-map').setView([42.639885, 20.891453], 10);
let mapLayer = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
let i = 0;
let markers =[];
let markerLayers = new L.LayerGroup();
let iconSize = [16, 16];

/*
*
* Map Pulse Markers
*
* **/



let notMeasuredIcon = L.icon.pulse({
    iconSize: iconSize,
    color: '#555C5F',
    fillColor: '#555C5F',
    animate:false
});

let criticalHighIcon = L.icon.pulse({
    iconSize: iconSize,
    color: '#F44336',
    fillColor: '#F44336',
    animate:false
});

let criticalLowIcon = L.icon.pulse({
    iconSize: iconSize,
    color: '#FFA726',
    fillColor: '#FFA726',
    animate:false
});

let lowIcon = L.icon.pulse({
    iconSize: iconSize,
    color: '#FF7043',
    fillColor: '#FF7043',
    animate:false
});

let highIcon = L.icon.pulse({
    iconSize: iconSize,
    color: '#FFA726',
    fillColor: '#FFA726',
    animate:false
});

let normalIcon = L.icon.pulse({
    iconSize: iconSize,
    color: '#66BB6A',
    fillColor: '#66BB6A',
    animate:false
});
let patients = [];
async function getPatients(apiUrl) {
    let statusClass;
    let statusText;
    let measuredTime;

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
                case 'critical high': icon = criticalHighIcon; break;
                case 'critical low': icon = criticalLowIcon; break;
                case 'high': icon = highIcon; break;
                case 'low': icon = lowIcon; break;
                case 'normal': icon = normalIcon; break;
                case false: icon = notMeasuredIcon; break;
            }
            var marker = L.marker([patients[i].latitude, patients[i].longitude], {icon: icon})
                .bindPopup("<div class='map-popup" + ' ' + statusClass + "'>" +
                    "              <div class='user-image'>" +

                    // "                  <img src=" + patients[i].imageUrl + ">" +
                    "                  <span class='initials'>" + patients[i].initials+"</span>"+
                    "              </div>" +
                    "              <div class='info'>" +
                    "                  <h4>" + patients[i].name  + ' ' + patients[i].surname  + "</h4>" +
                    "                  <p class='location'>" + patients[i].address +", " + patients[i].city + "</p>" +
                    "                  <p class='status'>" + statusText + "</p>" +
                    "                  <p class='time'>"+ measuredTime +"</p>" +
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
