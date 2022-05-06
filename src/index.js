import { addToFavourites, getUser, init, setupFavButton } from './utils.js';

var isLocal = window.location.href.includes('localhost');

const initMap = () => {
  init(() => {
    const addressBar = document.getElementById('address');
    const searchBtn = document.getElementById('search');

    searchBtn.addEventListener('click', () => {
      setupRequest(addressBar.value);
    });
  });
};

const geoCallback = (results, status) => {
  if (status === 'OK') {
    console.log(results);
    const coords = new google.maps.LatLng(
      results[0].geometry.location.lat,
      results[0].geometry.location.lng
    );
    const distanceField = document.getElementById('distance');
    const request = {
      location: coords,
      radius: distanceField.value * 1000,
      type: ['restaurant'],
    };
    search(request);
  } else {
    alert('Geocode was not successful for the following reason: ' + status);
  }
};

const localGeo = async () => {
  const response = await fetch('../example_data/geography.json');
  const { results, status } = await response.json();
  geoCallback(results, status);
};

const setupRequest = (location) => {
  if (isLocal) {
    localGeo();
  } else {
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ address: location }, geoCallback);
  }
};

const search = (request) => {
  const service = new google.maps.places.PlacesService(
    document.createElement('div')
  );
  service.nearbySearch(request, (results, status) => {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
      const resultArea = document.getElementById('results');
      results.forEach((result) => {
        resultArea.appendChild(createRow(result));
        setupDetailsButton(result.place_id);
        setupFavButton(result.place_id);
      });
    }
  });
};

const createRow = (result) => {
  const row = document.createElement('div');
  row.className = 'row-item';
  row.innerHTML = `
    <div class="store-name">
      <h3>${result.name}</h3>
      ${getPhoto(result.photos)}
    </div>
    <p class="status">${result.open_now ? 'Open' : 'Closed'}</p>
    <p class="rating">${result.rating} / 5</p>
    <div class="directions">
      <p class="address">${result.vicinity}</p>
    </div>
    <button id="${result.place_id}">Details</button>
    <p class="like-button" id="favourites-${result.place_id}"><3</p>
  `;

  return row;
};

const getPhoto = (photos) => {
  return photos !== undefined
    ? `<img class="row-img" src="${photos[0].getUrl({
        maxWidth: 200,
        maxHeight: 200,
      })}">`
    : '';
};

const setupDetailsButton = (id) => {
  const button = document.getElementById(id);
  button.addEventListener(
    'click',
    () => (window.location.href = `./details.php?code=${id}`)
  );
};

initMap();

// getUser(() => {
//   initMap();
// });
