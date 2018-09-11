let $map = document.querySelector('#wh_map');

class GoogleMaps {
    /*
     * charge la carte
     * @param {html element} 
     */

    constructor() {
        this.map = null;
        this.bounds = null;
        this.texMarker = null;
    }

    async  load(element) {
        return new Promise((resolve, reject) => {
            $script('https://maps.googleapis.com/maps/api/js', () => {

                this.texMarker = class TextMarker extends google.maps.OverlayView {

                    constructor(pos, map, text) {
                        super()
                        this.div = null
                        this.pos = pos
                        this.text = text
                        this.setMap(map)
                    }

                    onAdd() {
                        this.div = document.createElement('div')
                        this.div.classList.add('marker')
                        this.div.style.position = 'absolute'
                        this.div.innerHTML = this.text
                        this.getPanes().overlayImage.appendChild(this.div)
                    }

                    draw() {
                        let position = this.getProjection().fromLatLngToDivPixel(this.pos)
                        this.div.style.left = position.x + "px"
                        this.div.style.top = position.y + "px"
                    }

                    onRemove() {
                        this.div.parentNode.removeChild(this.div)
                    }
                    actived() {
                        if (this.div !== null) {
                            this.div.classList.add('is-active');
                        }

                    }

                    desactived() {
                        if (this.div !== null) {
                            this.div.classList.remove('is-active');
                        }

                    }

                }

                this.map = new google.maps.Map(element);
                this.bounds = new google.maps.LatLngBounds();
                resolve();
            });
        })

    }
    /*
     * @param {string} lat
     * @param {string} log  
     */
    addMarkereur(lat, log) {

        let myLatLng = new google.maps.LatLng(lat, log);


        let marker = new this.texMarker(myLatLng, this.map, 'positionTest');

        this.bounds.extend(myLatLng);

        return marker;
    }

    centerMaps() {
        this.map.panToBounds(this.bounds);
        this.map.fitBounds(this.bounds);
    }
}


const initMap = async function () {
    let map = new GoogleMaps();
    let activeMarker = null;
    await  map.load($map);

    Array.from(document.querySelectorAll('.item')).forEach(function (item) {

        let marker = map.addMarkereur(item.dataset.lat, item.dataset.log);

        item.addEventListener('mouseover', () => {

            marker.actived();

            if (activeMarker !== null) {

                activeMarker.desactived();
            }

            activeMarker = marker;
        })

        item.addEventListener('mouseleave', () => {

            if (activeMarker === marker) {
                marker.desactived();
                activeMarker = null;
            }

        });

    });

    map.centerMaps();
}


if ($map !== null) {

    initMap();

}


