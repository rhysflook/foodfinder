const initMap = () => {
  const addressBar = document.getElementById('address');
  const distanceField = document.getElementById('distance');
  const searchBtn = document.getElementById('search');

  searchBtn.addEventListener('click', () => {
    setupRequest(addressBar.value, distanceField.value * 1000);
  });
};

const setupRequest = (location, distance) => {
  const geocoder = new google.maps.Geocoder();
  geocoder.geocode({ address: location }, (results, status) => {
    if (status === 'OK') {
      const coords = new google.maps.LatLng(
        results[0].geometry.location.lat(),
        results[0].geometry.location.lng()
      );
      const request = {
        location: coords,
        radius: distance,
        type: ['restaurant'],
      };
      search(request);
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
};

const search = (request) => {
  const service = new google.maps.places.PlacesService(
    document.createElement('div')
  );
  service.nearbySearch(request, (results, status) => {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
      results.forEach((result) => {
        console.log(result);
      });
    }
  });
};

window.initMap = initMap;
