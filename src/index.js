import { addToFavourites, getUser, init, setupFavButton } from './utils.js';

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
  results.forEach((result) => {
    resultArea.appendChild(createRow(result));
    setupDetailsButton(result.place_id);
    setupFavButton(result.place_id);
  });
};

export const createRow = (result) => {
  console.log(result);
  const row = document.createElement('div');
  row.className = 'row-item';
  row.innerHTML = `
    <div class="store-name">
      <h3><span class="status">${
        result.open_now ? 'Open' : 'Closed'
      }</span> -- ${result.name}</h3>
    </div>
      <div class="store-info">
        ${getPhoto(result.photos)}
        <div class="details-lower">
          <div class="directions">
          <p class="address">${result.vicinity}</p>
          </div>
          <div class="fine-details">
          <p class="rating">${
            result.rating === undefined
              ? 'No reviews'
              : result.rating + ' / 5 ☆'
          }</p>
          <button class="details-button" id="${result.place_id}">詳細</button>
          <p class="like-button" id="favourites-${result.place_id}"><3</p>
        </div>
      </div>
    </div>
  `;

  return row;
};

const getPhoto = (photos) => {
  const size = window.innerWidth <= 600 ? 80 : 120;
  return photos !== undefined
    ? `<img class="row-img" src="${photos[0].getUrl({
        maxWidth: size,
        maxHeight: size,
      })}">`
    : '';
};

export const setupDetailsButton = (id) => {
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
