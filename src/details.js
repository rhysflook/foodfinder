import { addToFavourites, init, setupFavButton } from './utils.js';

const initMap = () => {
  init(() => {
    getStoreDetails();
  });
};

const getStoreDetails = () => {
  const service = new google.maps.places.PlacesService(
    document.createElement('div')
  );
  service.getDetails({ placeId: getCode() }, (results, status) => {
    console.log(results);
    const title = document.getElementById('title');
    title.innerHTML = `
        <div class="title-box">
            <div class="upper-box">
              <h2>${results.name}</h2>
              <p class="like-button" id="favourites-${getCode()}"><3</p>
            </div>
            <div class="rating-box">
                <p>${results.rating} with ${
      results.user_ratings_total
    } total ratings</p>
            </div>
        </div>
    `;
    setupFavButton(getCode());
    const reviews = document.getElementById('reviews');
    results.reviews !== undefined &&
      results.reviews.forEach((review) => {
        const userReview = document.createElement('div');
        userReview.className = 'user-review';
        userReview.innerHTML = `
        <p>${review.author_name}</p>
        <p>${review.rating}</p>
        <p class="review-content">${review.text}</p>
        `;
        reviews.appendChild(userReview);
      });
    const photos = document.getElementById('photos');
    results.photos !== undefined &&
      results.photos.forEach((photo) => {
        const photoFrame = document.createElement('div');
        photoFrame.className = 'photo-box';
        const storePhoto = document.createElement('img');
        storePhoto.className = 'details-img';
        storePhoto.src = photo.getUrl({ maxWidth: 300, maxHeight: 300 });
        photoFrame.appendChild(storePhoto);
        photos.appendChild(photoFrame);
      });
  });
};

const getCode = () => {
  const params = window.location.search;
  return params.split('=')[1];
};

window.initMap = initMap;
initMap();
