import { Place } from './place.js';
import { init, setupFavButton } from './utils.js';

var isLocal = false;
console.log('yo');
const initMap = () => {
  init(() => {
    const addressBar = document.getElementById('address');
    const searchBtn = document.getElementById('find-food');
    console.log(searchBtn);
    searchBtn.addEventListener('click', () => {
      const results = document.getElementById('results');
      results.innerHTML = '';
      if (window.innerWidth <= 600) {
        const srchBox = document.getElementById('srch');
        srchBox.style.display = 'none';
        const area = document.getElementById('srch-area');
        const newBtn = document.createElement('button');
        newBtn.innerText = 'もう一回';
        newBtn.className = 'go-btn med';
        newBtn.style.display = 'none';
        newBtn.id = 'again-btn';
        newBtn.addEventListener('click', () => {
          const results = document.getElementById('results');
          results.innerHTML = '';
          srchBox.style.display = 'flex';
          newBtn.remove();
        });
        area.appendChild(newBtn);
      }
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
    place.setupElement();
  });
  document.getElementById('again-btn').style.display = 'initial';
};

if (window.location.pathname.includes('search')) {
  initMap();
}

// getUser(() => {
//   initMap();
// });
