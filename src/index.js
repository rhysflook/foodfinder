import { Place } from './place.js';
import { init, setupFavButton } from './utils.js';

var isLocal = false;

const initMap = () => {
  init(() => {
    const addressBar = document.getElementById('address');
    const searchBtn = document.getElementById('search');

    searchBtn.addEventListener('click', () => {
      setupRequest(addressBar.value);
      saveSearch(addressBar.value);
    });
  });
};

const saveSearch = (content) => {
  axios.post('./userSearchRecord.php', {
    id: Number(localStorage.getItem('user')),
    content,
    date: Math.floor(Date.now() / 1000),
    type: 'address',
  });
};

const geoCallback = (results, status) => {
  if (status === 'OK') {
    const coords = new google.maps.LatLng(
      results[0].geometry.location.lat(),
      results[0].geometry.location.lng()
    );
    const distanceField = document.getElementById('distance');
    const request = {
      location: coords,
      radius: distanceField.value * 1000,
      type: ['restaurant'],
    };
    search(request, displayResults);
  } else {
    alert('Geocode was not successful for the following reason: ' + status);
  }
};

const localGeo = async () => {
  const response = await fetch('../example_data/geography.json');
  const { results, status } = await response.json();
  geoCallback(results, status);
};

export const setupRequest = (location) => {
  if (isLocal) {
    localGeo();
  } else {
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ address: location }, geoCallback);
  }
};

export const search = (request, callback) => {
  const service = new google.maps.places.PlacesService(
    document.createElement('div')
  );
  service.nearbySearch(request, (results, status) => {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
      callback(results);
    }
  });
};

const displayResults = (results) => {
  const resultArea = document.getElementById('results');

  const size = window.innerWidth <= 600 ? 80 : 120;
  results.forEach((result) => {
    const place = new Place(result, size);
    resultArea.appendChild(place.createRow());
    setupDetailsButton(result.place_id);
    setupFavButton(result.place_id);
    setupDirections(`map-${result.place_id}`, result.name);
  });
};

export const setupDetailsButton = (id) => {
  const button = document.getElementById(id);
  button.addEventListener(
    'click',
    () => (window.location.href = `./details.php?code=${id}`)
  );
};

export const setupDirections = (id, name) => {
  const url = `https://www.google.com/maps/dir/?api=1&destination=${name}&destination_place_id=${
    id.split('-')[1]
  }`;
  const button = document.getElementById(id);
  button.addEventListener('click', () => {
    window.location.href = url;
  });
};

initMap();

// getUser(() => {
//   initMap();
// });
