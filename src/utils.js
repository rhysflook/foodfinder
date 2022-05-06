export const addToFavourites = (userId, googleId) => {
  axios.post('./addToFavourites.php', { user_id: userId, google_id: googleId });
};

export const init = (callback) => {
  const google = document.getElementById('google');
  google.addEventListener('load', () => {
    getUser(callback);
  });
};

export const getUser = (callback) => {
  const user = localStorage.getItem('user');
  if (!user || user === undefined) {
    axios
      .get('./getCurrentUser.php')
      .then((res) => {
        localStorage.setItem('user', res.data.user);
        localStorage.setItem(
          'favourites',
          JSON.stringify(parseFavourites(res.data.favourites))
        );
        callback();
      })
      .catch(() => {
        window.location.href = 'login.php';
      });
  } else {
    callback();
  }
};

export const parseFavourites = (favs) => {
  return favs.map((fav) => fav.google_id);
};

export const setupFavButton = (googleId) => {
  const button = document.getElementById(`favourites-${googleId}`);
  button.style.userSelect = 'none';
  if (JSON.parse(localStorage.getItem('favourites')).includes(googleId)) {
    button.style.color = 'red';
  }
  button.addEventListener('click', () => {
    if (button.style.color === 'red') {
      removeFromFavourites(googleId);
      const favs = JSON.parse(localStorage.getItem('favourites'));
      favs.splice(favs.indexOf(googleId), 1);
      localStorage.setItem('favourites', JSON.stringify(favs));
      button.style.color = 'gray';
    } else {
      addToFavourites(localStorage.getItem('user'), googleId);
      const favs = JSON.parse(localStorage.getItem('favourites'));
      favs.push(googleId);
      localStorage.setItem('favourites', JSON.stringify(favs));
      button.style.color = 'red';
    }
  });
};

export const removeFromFavourites = (googleId) => {
  axios.delete(`./removeFromFavourites.php/${googleId}`);
};
