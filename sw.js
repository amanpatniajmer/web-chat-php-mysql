
var cacheName='cache-v1';
var resources=[
    'index.php',
    //'icon.png',
    'load_msgs.php',
    'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
    'manifest.json',
];
self.addEventListener('install',event=>{
    self.skipWaiting();
    console.log('Installed new');
    event.waitUntil(
        caches.open(cacheName)
        .then(cache=> {
            return cache.addAll(resources);})
    )
});
self.addEventListener('activate',event=>{console.log('Activated')});
self.addEventListener('fetch',(event)=>{
    event.respondWith(caches.match(event.request)
    .then(cachedResponse=>{return cachedResponse ||fetch(event.request);}))
    console.log('Fetched from:'+event.request.url)})

