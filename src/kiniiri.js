import { init } from './utils.js';
import { Place } from './place.js';

const initMap = () => {
  init(() => {
    const service = new google.maps.places.PlacesService(
      document.createElement('div')
    );

    // get all shop
    var el = document.querySelectorAll('.shop');
    console.log(el.length);

    //for loop
    for (var i = 0; i < el.length; i++) {
      const size = window.innerWidth <= 600 ? 80 : 120;
      service.getDetails({ placeId: el[i].id }, (results, status) => {
        const resultArea = document.getElementById(results.place_id);
        const place = new Place(results, size);
        resultArea.appendChild(place.createRow());
        place.setupElement();
      });
    }
    // break;
    //end for loop
  });
};
initMap();
