const placePrototype = {
  user: Number(localStorage.getItem('user')),
  favourites: JSON.parse(localStorage.getItem('favourites')),

  createRow() {
    console.log(this);
    const { open_now, vicinity, rating } = this.results;
    const row = document.createElement('div');
    row.className = 'row-item';
    row.innerHTML = `
        <div class="store-name">
          <h3><span class="status">${open_now ? 'Open' : 'Closed'}</span> -- ${
      this.name
    }</h3>
        </div>
          <div class="store-info">
            ${this.getPhoto()}
            <div class="details-lower">
              <div class="directions">
              <p class="address">${vicinity}</p>
              </div>
              <div class="fine-details">
              <p class="rating">${
                rating === undefined ? 'No reviews' : rating + ' / 5 ☆'
              }</p>
              <button class="details-button" id="${this.id}">詳細</button>
              ${this.getLikeButton()}
              <img id="map-${
                this.id
              }" class="map-pointer" src="../images/map-pointer.png">
            </div>
          </div>
        </div>
      `;
    return row;
  },

  getPhoto() {
    return this.results.photos !== undefined
      ? `<img class="row-img" src="${this.results.photos[0].getUrl({
          maxWidth: this.size,
          maxHeight: this.size,
        })}">`
      : '<img class="row-img" src="../images/no-pic.png">';
  },

  setupDetailsButton() {
    const button = document.getElementById(this.id);
    button.addEventListener(
      'click',
      () => (window.location.href = `./details.php?code=${this.id}`)
    );
  },

  setupDirections() {
    const url = `https://www.google.com/maps/dir/?api=1&destination=${this.name}&destination_place_id=${this.id}`;
    const button = document.getElementById(`map-${this.id}`);
    button.addEventListener('click', () => {
      window.location.href = url;
    });
  },

  getLikeButton() {
    const btnClass = this.isLiked ? 'like-button liked' : 'like-button';
    return ` <p class="${btnClass}" id="favourites-${this.id}"><3</p>`;
  },

  setupFavourites() {
    const button = document.getElementById(`favourites-${this.id}`);
    button.addEventListener('click', () => {
      if (this.isLiked) {
        this.removeFromFavourites(this.id);
        const favs = JSON.parse(localStorage.getItem('favourites'));
        favs.splice(favs.indexOf(this.id), 1);
        localStorage.setItem('favourites', JSON.stringify(favs));
        button.classList.remove('liked');
      } else {
        this.addToFavourites(localStorage.getItem('user'), this.id);
        button.classList.add('liked');
      }
    });
  },

  addToFavourites() {
    axios
      .post('./addToFavourites.php', {
        user_id: this.user,
        google_id: this.id,
      })
      .then(() => {
        this.favourites.push(this.id);
        this.updateFavourites();
      });
  },

  removeFromFavourites() {
    axios.delete(`./removeFromFavourites.php/${this.id}`).then(() => {
      this.favourites.splice(this.favourites.indexOf(this.id), 1);
      this.updateFavourites();
    });
  },

  updateFavourites() {
    localStorage.setItem('favourites', JSON.stringify(this.favourites));
  },
};

export function Place(results, size) {
  this.results = results;
  this.size = size;
  this.id = results.place_id;
  this.name = results.name;
  this.isLiked = this.favourites.includes(this.results.place_id);
}

Place.prototype = placePrototype;
Place.prototype.constructor = Place;
