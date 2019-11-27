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


export {notMeasuredIcon, criticalHighIcon, criticalLowIcon, lowIcon, highIcon, normalIcon}
