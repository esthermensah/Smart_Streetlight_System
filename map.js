//this code makes map focus on a place in ghana
var map = L.map("map").setView([5.758619, -0.220258], 12);


L.marker([5.760368, -0.219681]).addTo(map)
    // .bindPopup('Ashesi')
    .openPopup();


L.marker([5.759711, -0.218901]).addTo(map)
    // .bindPopup('Ashesi')
    .openPopup();

L.marker([5.759506, -0.218554]).addTo(map)
    // .bindPopup('Ashesi')
    .openPopup();


L.marker([5.757589, -0.221364]).addTo(map)
    // .bindPopup('Ashesi')
    .openPopup();


L.marker([5.758495, -0.221300]).addTo(map)
    // .bindPopup('Ashesi')
    .openPopup();

L.marker([5.758202, -0.221327]).addTo(map)
    // .bindPopup('Ashesi')
    .openPopup();
L.marker([5.758773, -0.221253]).addTo(map)
    // .bindPopup('Ashesi')
    .openPopup();
L.marker([5.758957, -0.221431]).addTo(map)
    // .bindPopup('Ashesi')
    .openPopup();
L.marker([5.759025, -0.221150]).addTo(map)
    // .bindPopup('Ashesi')
    .openPopup();







//this gives the whole world map 

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);





//this gives only the map of ghana

// $.getJSON('https://cdn.rawgit.com/johan/world.geo.json/34c96bba/countries/GHA.geo.json').then(function(geoJSON) {
//     var osm = new L.TileLayer.BoundaryCanvas("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
//         boundary: geoJSON,
//         attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors, GHA shape <a href="https://github.com/johan/world.geo.json">johan/word.geo.json</a>'
//     });
//     map.addLayer(osm);
//     var GHALayer = L.geoJSON(geoJSON);
//     map.fitBounds(GHALayer.getBounds());
// });