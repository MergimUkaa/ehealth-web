document.addEventListener("DOMContentLoaded", function(){

    let mymap = L.map('map').setView([59.329323, 18.068581], 13);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 14,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox.streets'
    }).addTo(mymap);

    //Icons with images
    // let LeafIcon = L.Icon.extend({
    //     options: {
    //         iconAnchor: [22, 94],
    //         popupAnchor: [-3, -82],
    //         shadowSize: [68, 95],
    //         shadowAnchor: [22, 94]
    //     }
    // });

    // let redIcon = new LeafIcon({iconUrl: '../images/icons/location-pin-red.svg'}),
    //     orangeIcon = new LeafIcon({iconUrl: '../images/icons/location-pin-orange.svg'});



    //Icons with pulse
    let iconSize = [24,24];

    let criticalHighIcon = L.icon.pulse({iconSize:iconSize,color:'#F44336', fillColor: '#F44336'});
    let criticalLowIcon = L.icon.pulse({iconSize:iconSize,color:'#FFA726', fillColor: '#FFA726'});
    let lowIcon = L.icon.pulse({iconSize:iconSize,color:'#FF7043', fillColor: '#FF7043'});
    let highIcon = L.icon.pulse({iconSize:iconSize,color:'#FFA726', fillColor: '#FFA726'});
    let normalIcon = L.icon.pulse({iconSize:iconSize,color:'#66BB6A', fillColor: '#66BB6A'});


    L.icon = function (options) {
        return new L.Icon(options);
    };

    let patients = [
        {
            fullName: 'Mergim Uka',
            imageUrl: '../images/avatar/muka.jpg',
            location: 'Stockholm, Sweden',
            statusClass: 'critical-high',
            status: 'critical high',
            statusIcon: criticalHighIcon,
            profileUrl: '/',
            latitude: 59.329323,
            longitude: 18.068581,
        },
        {
            fullName: 'Teuta Koraqi',
            imageUrl: '../images/avatar/tkuka.jpg',
            location: 'Stockholm, Sweden',
            statusClass: 'critical-low',
            status: 'critical low',
            statusIcon: criticalLowIcon,
            profileUrl: '/',
            latitude: 59.332451,
            longitude: 18.091333,
        },
        {
            fullName: 'Mbresa Shehu',
            imageUrl: '../images/avatar/mbresashehu.jpg',
            location: 'Stockholm, Sweden',
            statusClass: 'low',
            status: 'low',
            statusIcon: lowIcon,
            profileUrl: '/',
            latitude: 59.334552,
            longitude: 18.069370
        },
        {
            fullName: 'Arbresha Uka',
            imageUrl: '../images/avatar/arbreshauka.jpg',
            location: 'Stockholm, Sweden',
            statusClass: 'high',
            status: 'high',
            statusIcon: highIcon,
            profileUrl: '/',
            latitude: 59.333326,
            longitude: 18.054956
        },
        {
            fullName: 'Emira Shehu',
            imageUrl: '../images/avatar/mila.jpg',
            location: 'Stockholm, Sweden',
            statusClass: 'normal',
            status: 'normal',
            statusIcon: normalIcon,
            profileUrl: '/',
            latitude: 59.332801,
            longitude: 18.118786
        },
    ]

    let i = 0;

    for (i = 0; i < patients.length; i++) {
        L.marker([patients[i].latitude, patients[i].longitude], {icon: patients[i].statusIcon}).addTo(mymap)
            .bindPopup("<div class='map-popup" + ' ' + patients[i].statusClass + "'>" +
                "              <div class='user-image'>" +
                "                  <img src=" + patients[i].imageUrl +">" +
                "              </div>" +
                "              <div class='info'>" +
                "                  <h4>" + patients[i].fullName +"</h4>" +
                "                  <p class='location'>" + patients[i].location +"</p>" +
                "                  <p class='status'>" + patients[i].status +"</p>" +
                "              </div>" +
                "              <a href='#' class='btn btn-element small-btn'>View Profile</a>" +
                "          </div>").openPopup();

    }

});

