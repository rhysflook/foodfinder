import { init } from './utils.js';

const initMap = () => {
  init(() => {
      const service = new google.maps.places.PlacesService(
        document.createElement('div')
      );

      // get all shop
      var el = document.querySelectorAll(".shop"); 
      console.log(el.length)
      
      //for loop
      for( var i = 0 ; i < el.length ; i++ ){

      service.getDetails({ placeId: "ChIJY8vvgB_ecUgRoMp4F3uyzTM" }, (results, status) => {
            console.log(results);
      });
    }
      // break;
      //end for loop
  });
}
initMap();