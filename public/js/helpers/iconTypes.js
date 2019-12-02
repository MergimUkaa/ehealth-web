let iconSize = [16, 16];
export let notMeasuredProps = {
    iconSize: iconSize,
    color: '#555C5F',
    fillColor: '#555C5F',
    animate: true
};
export let normalIconProps = {
    iconSize: iconSize,
    color: '#66BB6A',
    fillColor: '#66BB6A',
    animate: true
};


export let criticalHighProps = {
    iconSize: iconSize,
    color: '#F44336',
    fillColor: '#F44336',
    animate: true
};

export let criticalLowProps = {
    iconSize: iconSize,
    color: '#FFA726',
    fillColor: '#FFA726',
    animate: true
};

export let highProps = {
    iconSize: iconSize,
    color: '#FF7043',
    fillColor: '#FF7043',
    animate: true
};

export let lowProps = {
    iconSize: iconSize,
    color: '#FFA726',
    fillColor: '#FFA726',
    animate: true
};


normalIconProps = {
    iconSize: iconSize,
    color: '#66BB6A',
    fillColor: '#66BB6A',
    animate: true
};


let notMeasuredIcon = L.icon.pulse({
    iconSize: iconSize,
    color: '#555C5F',
    fillColor: '#555C5F',
    animate: false
});

let criticalHighIcon = L.icon.pulse({
    iconSize: iconSize,
    color: '#F44336',
    fillColor: '#F44336',
    animate: false
});

let criticalLowIcon = L.icon.pulse({
    iconSize: iconSize,
    color: '#FFA726',
    fillColor: '#FFA726',
    animate: false
});

let lowIcon = L.icon.pulse({
    iconSize: iconSize,
    color: '#FFA726',
    fillColor: '#FFA726',
    animate: false
});

let highIcon = L.icon.pulse({
    iconSize: iconSize,
    color: '#FF7043',
    fillColor: '#FF7043',
    animate: false
});

let normalIcon = L.icon.pulse({
    iconSize: iconSize,
    color: '#66BB6A',
    fillColor: '#66BB6A',
    animate: false
});

function markerIcon(patientStatus, animated = false) {
    let patientIcon;
    switch (patientStatus) {
        case 'critical high':
            if (animated === false){
                patientIcon = criticalHighIcon;
            } else {
                patientIcon = L.icon.pulse(criticalHighProps);
            }
            break;
        case 'critical low':
            if (animated === false) {
                patientIcon = criticalLowIcon;
            } else {
                patientIcon =  L.icon.pulse(criticalLowProps);
            }
            break;
        case 'high':
            if (animated === false) {
                patientIcon = highIcon;
            } else {
                patientIcon =  L.icon.pulse(highProps);
            }
            break;
        case 'low':
            if (animated === false) {
                patientIcon = lowIcon;
            } else {
                patientIcon =  L.icon.pulse(lowProps);
            }
            break;
        case 'normal':
            if (!animated) {
                patientIcon = normalIcon;
            } else {
                patientIcon =  L.icon.pulse(normalIconProps);
            }
            break;
        default: patientIcon = notMeasuredIcon;
    }
    return patientIcon;

}
export {notMeasuredIcon, criticalHighIcon, criticalLowIcon, lowIcon, highIcon, normalIcon, markerIcon}
