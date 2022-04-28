const initMap = () => {
  getStoreDetails();
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
            <h2>${results.name}</h2>
            <div class="rating-box">
                <p>${results.rating} with ${results.user_ratings_total} total ratings</p>
            </div>
        </div>
    `;
    const reviews = document.getElementById('reviews');
    results.reviews.forEach((review) => {
      const userReview = document.createElement('div');
      userReview.className = 'user-review';
      userReview.innerHTML = `
        <p>${review.author_name}</p>
        <p>${review.rating}</p>
        <p>${review.text}</p>
        `;
      reviews.appendChild(userReview);
    });
    const photos = document.getElementById('photos');
    results.photos.forEach((photo) => {
      const storePhoto = document.createElement('img');
      storePhoto.className = 'details-img';
      storePhoto.src = photo.getUrl({ maxWidth: 400, maxHeight: 400 });
      photos.appendChild(storePhoto);
    });
  });
};

const getCode = () => {
  const params = window.location.search;
  return params.split('=')[1];
};

window.initMap = initMap;