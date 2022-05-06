import { search, createRow, setupDetailsButton } from './index.js';
import { setupFavButton } from './utils.js';

const google = document.getElementById('google');
console.log(google);
google.addEventListener('load', () => {
  console.log('loaded');
  axios
    .get('./getSearchHistory.php/' + localStorage.getItem('user'))
    .then((res) => {
      const randomRes = res.data[Math.floor(Math.random() * res.data.length)];
      if (randomRes.type === 'address') {
        console.log(randomRes);
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({ address: randomRes.content }, geoCallback);
      }
    });
});

const geoCallback = (results, status) => {
  if (status === 'OK') {
    const coords = new google.maps.LatLng(
      results[0].geometry.location.lat(),
      results[0].geometry.location.lng()
    );
    const request = {
      location: coords,
      radius: 10000,
      type: ['restaurant'],
    };
    search(request, displayBestRated);
  } else {
    alert('Geocode was not successful for the following reason: ' + status);
  }
};

const displayBestRated = (results) => {
  results.sort(function (a, b) {
    if (a.rating === b.rating) {
      return b.user_ratings_total - a.user_ratings_total;
    } else {
      return b.rating - a.rating;
    }
  });

  const topResults = results.length < 3 ? results : results.splice(0, 3);

  const resultArea = document.getElementById('recommendations');
  topResults.forEach((result) => {
    resultArea.appendChild(createRow(result));
    setupDetailsButton(result.place_id);
    setupFavButton(result.place_id);
  });
};
