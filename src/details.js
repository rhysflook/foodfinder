import { setupDirections } from './index.js';
import { init, setupFavButton } from './utils.js';

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
    renderTitleSection(results);
    setupFavButton(getCode());
    renderReviews(results);
    renderPhotos(results);
    setupDirections(`map-${results.place_id}`, results.name);
  });
};

const renderTitleSection = (results) => {
  const { name, rating, user_ratings_total } = results;
  const title = document.getElementById('title');
  title.innerHTML = `
        <div class="title-box">
            <div class="upper-box">
              <h2>${name}</h2>
              <img id="map-${
                results.place_id
              }" class="map-pointer" src="../images/map-pointer.png">
              <p class="like-button" id="favourites-${getCode()}"><3</p>
            </div>
            <div class="rating-box">
                <p>${rating} with ${user_ratings_total} total ratings</p>
            </div>
            <div class="seperator"></div>
        </div>
    `;
};

const renderReviews = (results) => {
  const reviews = document.getElementById('reviews');
  let innerContainer;
  if (window.innerWidth <= 600) {
    reviews.innerHTML = `   
      <div id="review-container" class="review-hidden">

      </div>
      <div class="show-section">...<button id="view-reviews" class="show-button">View more</button></div>
    `;
    innerContainer = document.getElementById('review-container');
    setupOpenButton();
  }

  results.reviews !== undefined &&
    results.reviews.forEach((review) => {
      window.innerWidth > 600
        ? reviews.appendChild(generateReview(review))
        : innerContainer.appendChild(generateReview(review));
    });
};

const generateReview = (review) => {
  const { author_name, rating, text } = review;
  const userReview = document.createElement('div');
  userReview.className = 'user-review';
  userReview.innerHTML = `
    <p class="author">${author_name} -- ${rating} / 5</p>
    <p class="review-content">${text}</p>
    `;
  return userReview;
};

const setupOpenButton = () => {
  const button = document.getElementById('view-reviews');
  button.addEventListener('click', () => {
    const container = document.getElementById('review-container');
    if (container.className === '') {
      container.className = 'review-hidden';
      button.innerText = 'View more';
      window.scrollTo({ top: 0, behavior: 'smooth' });
    } else {
      document.getElementById('review-container').className = '';
      button.innerText = '^';
    }
  });
};

const renderPhotos = (results) => {
  const photos = document.getElementById('photos');
  results.photos !== undefined &&
    results.photos.forEach((photo) => {
      photos.appendChild(generatePhoto(photo));
    });
};

const generatePhoto = (photo) => {
  const photoFrame = document.createElement('div');
  photoFrame.className = 'photo-box';
  const storePhoto = document.createElement('img');
  storePhoto.className = 'details-img';
  storePhoto.src = photo.getUrl({
    maxWidth: window.innerWidth < 600 ? 600 : 200,
    maxHeight: window.innerWidth < 600 ? 600 : 200,
  });
  photoFrame.appendChild(storePhoto);
  return photoFrame;
};

const getCode = () => {
  const params = window.location.search;
  return params.split('=')[1];
};

initMap();
