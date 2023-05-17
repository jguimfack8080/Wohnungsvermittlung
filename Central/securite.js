let $map = document.querySelector('#map'); // Toutes les variables avec Dollards designe des variables Html
class LeafletMap {

  constructor() {
    this.mymap = null;
    this.bounds = []
  }

  async load(element) {
    return new Promise((resolve, reject) => {

      $script('https://informatik.hs-bremerhaven.de/leaflet/leaflet.js', () => {

        //var mymap = new L.Map("map");
        this.mymap = L.map(element)
        // OpenStreetMap-Karte einfügen
        var osmUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
        var osmAtt = '<a href="https://openstreetmap.org">OpenStreetMap</a>';
        var args = {
          //minZoom: 8,
          //maxZoom: 19,
          attribution: osmAtt,
        }
        var osm = new L.TileLayer(osmUrl, args);

        // Hochschule Bremerhaven
        // this.mymap.setView([53.54, 8.5835], 15);
        this.mymap.addLayer(osm)
        resolve()


      })

    })
  }

  addMarker(lat, lng, text) {
    let point = [lat, lng]
    this.bounds.push(point)
    return new LeafletMaker(point, text, this.mymap)

    //img1 == js-marker


    // Cette methode centrera la carte


  }
  center() {
    this.mymap.fitBounds(this.bounds)
  }


}

class LeafletMaker {
  constructor(point, text, mymap) {
    this.text = text
    this.popup = L.popup({
      autoClose: false,
      closeOnEscapeKey: false,
      closeOnClick: false,
      closeButton: false,
      className: 'marker',
      maxWidth: 400

    })

      .setLatLng(point)
      .setContent(text)
      .openOn(mymap)

  }
//Gestion des markers actifs
  setActive() {
    this.popup.getElement().classList.add('is-active')

  }

  unsetActive() {
    this.popup.getElement().classList.remove('is-active')
  }

  addEventListener(event, cb) {

    this.popup.addEventListener('add', () => {
      this.popup.getElement().addEventListener(event, cb)
    })
  }

  setContent(text) {
    this.popup.setContent(text)
    this.popup.getElement().classList.add('is-expanded')
    this.popup.update()
  }

  resetContent() {

    this.popup.setContent(text)
    this.popup.getElement().classList.remove('is-expanded')
    this.popup.update()
  }

}
//Cette classe me permet d'identifier les marquueurs


const initMap = async function () {

  let mymap = new LeafletMap()
  let hoverMarker = null
  let activeMarker = null
  await mymap.load($map)
  Array.from(document.querySelectorAll('.img1')).forEach((item) => {
    let marker = mymap.addMarker(item.dataset.lat, item.dataset.lng, item.dataset.price + '€')
    item.addEventListener('mouseover', function () {
      if (hoverMarker !== null) {
        hoverMarker.unsetActive()
      }
      marker.setActive()
      hoverMarker = marker
    })
    //Quand on quitte un element( Enlever la classe active)

    item.addEventListener('mouseleave', function () {

      if (hoverMarker !== null) {

        hoverMarker.unsetActive()
      }
    })

    //Pouvoir cliquer sur un elemnt et l'afficher en gros

    marker.addEventListener('click', function () {
      if (activeMarker !== null) {
        activeMarker.resetContent()
      }
      marker.setContent(item.innerHTML)
      activeMarker = marker

    })

  })
  mymap.center()

}


if ($map !== null) {
  initMap();
}







// var mymap = new L.Map("map");
// // OpenStreetMap-Karte einfügen
// var osmUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
// var osmAtt = '<a href="https://openstreetmap.org">OpenStreetMap</a>';
// var args = {
//   minZoom: 8,
//   maxZoom: 19,
//   attribution: osmAtt,
// };

// var osm = new L.TileLayer(osmUrl, args);

// // Hochschule Bremerhaven
// mymap.setView([53.54, 8.5835], 15);
// mymap.addLayer(osm);


/*L.popup()
  .setLatLng([53.54481115464615, 8.570461443920676])
  .setContent('<p>Hello World!<br/> This is a nice popup.</p>')
  .openOn(mymap)
*/




