// Locations permissions
let autoLocation = null
let autoLocationLink = null
let autoLocationLoading = null
let locationLinks = null
let locationLinksActive = null

function setAutoLocation() {
    // console.warn('@setAutoLocation()');
    locationLinksActive = document.querySelectorAll('.link--active')
    locationLinksActive.forEach(link => {
        link.classList.add('link--hide')
    })

    locationLinks = document.querySelectorAll('.link--default')
    locationLinks.forEach(link => {
        link.classList.remove('link--hide')
        link.addEventListener('click', function() {
            autoLocation = link.parentElement.getElementsByClassName('link--active')[0]
            handleLocationPermission()
        })
    })
}

function setStatusPermission(state) {
    // console.warn('@setStatusPermission(state)', state);
    switch (state) {
        case 'granted':
        case 'prompt':
            locationLinks.forEach(link => {
                link.classList.remove('link--error', 'link--blocked', 'link--disabled')
                link.classList.add('link--hide')
            })
            locationLinksActive.forEach(link => {
                link.classList.remove('link--hide')
                    // link.classList.add('link--disabled')
            })
            break;
        case 'denied':
            locationLinks.forEach(link => {
                link.classList.remove('link--error', 'link--blocked', 'link--disabled')
                link.classList.add('link--blocked')
            })
            break;
        case 'disabled':
            locationLinks.forEach(link => {
                link.classList.remove('link--error', 'link--blocked', 'link--disabled')
                link.classList.add('link--disabled')
            })
            break;
        default:
            locationLinks.forEach(link => {
                link.classList.remove('link--error', 'link--blocked', 'link--disabled')
                link.classList.add('link--error')
            })
            break;
    }
}

function handleLocationPermission() {
    // console.warn('@handleLocationPermission()');
    setStatusPermission('disabled');

    navigator.geolocation.getCurrentPosition(
        successCoordinates,
        tryWithPermissions
    );
}

function tryWithPermissions() {
    // console.warn('@tryWithPermissions()');
    if ("permissions" in navigator) {
        navigator.permissions.query({
            name: "geolocation"
        }).then((result) => {
            if (result.state == "granted" || result.state == "prompt") {
                setStatusPermission(result.state)

                navigator.geolocation.getCurrentPosition(
                    successCoordinates,
                    errorCoordinates
                );
            } else if (result.state == "denied") {
                setStatusPermission(result.state)
            }

            result.addEventListener("change", function() {
                setStatusPermission(result.state)
            });
        });
    }
}

function errorCoordinates(err) {
    // console.warn('@errorCoordinates(err)', err);
    locationLinksActive.forEach(link => {
        link.classList.remove('link--error', 'link--disabled')
        link.classList.add('link--error')
    })
    console.error('Autolocation:', err);
}

let successCoordinates = function(position) {
    // console.warn('@successCoordinates(position)', position.coords);
    let {
        latitude,
        longitude
    } = position.coords
    localStorage.setItem('location_coordinates', JSON.stringify({
        latitude,
        longitude
    }));

    if (autoLocation) autoLocation.click()
    if (autoLocationLink) window.location.href = autoLocationLink;
}

window['handleAutoLocation'] = function(route) {
    // console.warn(`@handleAutoLocation(route)`, route);
    autoLocationLink = route

    if (localStorage.getItem('location_coordinates')) {
        window.location.href = route;
    } else {
        navigator.geolocation.getCurrentPosition(
            successCoordinates,
            errorCoordinates
        );
    }
}

function initAutoLocation() {
    document.addEventListener("DOMContentLoaded", function() {
        setAutoLocation()
    })
}







const AD_CODE = "Web:Social:Ad"
const DEFAULT_CODE = "Direct"

function setSavedLead(date) {
    localStorage.setItem("acad-lead", date)
}

function getSavedLeadDate() {
    const savedData = localStorage.getItem("acad-lead")
    if (!savedData) {
        return null
    }

    return new Date(savedData)
}

function deleteSavedLead() {
    localStorage.removeItem("acad-lead")
}

function differenceInMonths(date1, date2) {
    if (!date1)
        return null
    if (!date2)
        return null
            // Calculating the difference in years
    const yearsDiff = date2.getFullYear() - date1.getFullYear();

    // Calculating the difference in months
    const monthsDiff = (date2.getMonth() + 1) - (date1.getMonth() + 1);

    // Total months difference
    const totalMonthsDiff = yearsDiff * 12 + monthsDiff;

    return totalMonthsDiff;
}

function clearAd() {
    deleteSavedLead()
}

function isValidAd() {
    const savedLeadDate = getSavedLeadDate()
    const currentDate = new Date()
    const diferenceInMonths = differenceInMonths(savedLeadDate, currentDate)

    return diferenceInMonths != null && diferenceInMonths === 0
}


function getReferralCode() {

    if (!isValidAd()) {
        clearAd()
        return DEFAULT_CODE
    }
    return AD_CODE
}

function getParameterByName(name, url) {
    if (!url) {
        url = window.location.href;
    }
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

window.addEventListener("DOMContentLoaded", function() {
    const adParam = getParameterByName('ad');

    if (!(typeof adParam == "string")) {
        return
    }

    if (!isValidAd()) {
        setSavedLead(new Date())
    }

})