export default {
  geocoderUrl:
    'https://api.opencagedata.com/geocode/v1/json?key=' +
    window.opencageKey +
    '&no_annotations=1&q=',
  defaultLocation: {
    name: 'Berlin',
    lat: 52.52,
    lng: 13.4
  },
  markerIcon: '/img/marker.png'
};
