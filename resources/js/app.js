import mapbox from 'mapbox-gl';
import {
    Livewire,
    Alpine,
} from "../../vendor/livewire/livewire/dist/livewire.esm";
import { bbox } from '@turf/turf';

Alpine.data('constituencyMap', ({ token, geometry, center, markers }) => ({
    markers: {},
    map: null,
    init() {
        mapbox.accessToken = token;

        const map = new mapbox.Map({
            container: this.$refs.map,
            center,
            zoom: 11,
        });

        map.on('idle', () => {
            map.resize()._update();
        })

        this.map = map;

        map.on('load', () => {
            map.addSource('constituency', {
                type: 'geojson',
                data: geometry.geometry,
            });

            map.addLayer({
                id: "constituency-line",
                type: "line",
                source: "constituency",
                layout: {},
                paint: {
                    "line-color": "#ed0905",
                    "line-width": 3,
                },
            });

            map.addLayer({
                id: "constituency-fill",
                type: "fill",
                source: "constituency",
                layout: {},
                paint: {
                    "fill-color": "#ed0905",
                    "fill-opacity": 0.3,
                },
            });

            markers.forEach(marker => {
                this.markers[marker.id] = new mapbox.Marker()
                    .setLngLat([marker.longitude, marker.latitude])
                    .setPopup(
                        new mapbox.Popup({ offset: 25 })
                            .setHTML(`
                                <h3>${marker.name}</h3>
                                ${marker.address ? `<p>${marker.address}</p>` : ''}
                            `)
                    )
                    .addTo(map);
            });
        })
    },
    focusMarker(id) {
        const marker = this.markers[id];
        const coords = marker.getLngLat();

        // Fly to the marker.
        this.map.flyTo({
            center: coords,
            zoom: 14,
        });

        // Open the popup.
        marker.togglePopup();

        // Close all other popups.
        Object.values(this.markers).forEach(m => {
            if (m !== marker) {
                m.getPopup().remove();
            }
        })
    }
}))

Alpine.data('constituencyStaticMap', ({ token, geometry, center }) => ({
    init() {
        mapbox.accessToken = token;

        const map = new mapbox.Map({
            container: this.$root,
            center,
            zoom: 10,
            interactive: false,
        });

        map.on('load', () => {
            map.addSource('constituency', {
                type: 'geojson',
                data: geometry.geometry,
            });

            map.addLayer({
                id: "constituency-line",
                type: "line",
                source: "constituency",
                layout: {},
                paint: {
                    "line-color": "#ed0905",
                    "line-width": 3,
                },
            });

            map.addLayer({
                id: "constituency-fill",
                type: "fill",
                source: "constituency",
                layout: {},
                paint: {
                    "fill-color": "#ed0905",
                    "fill-opacity": 0.3,
                },
            });

            // Fit the map to the geometry.
            const bounds = bbox(geometry);

            map.fitBounds(bounds, {
                padding: 50,
            });
        })
    },
}))

Livewire.start();
