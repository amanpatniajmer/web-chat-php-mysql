
var cacheName='cache-v1';
var resources=[
    'calculator.html',
    'icon.png',
    'calc-manifest.json',
];
var optionalResources=[
    //optional
];
self.addEventListener('install',event=>{
    self.skipWaiting();
    importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

if (workbox) {
  console.log(`Yay! Workbox is loaded 🎉`);
} else {
  console.log(`Boo! Workbox didn't load 😬`);
}
    console.log('Installed new');
    event.waitUntil(
        caches.open(cacheName)
        .then(cache=> {
            cache.addAll(optionalResources);
            return cache.addAll(resources);})
    )
});
self.addEventListener('activate',event=>{console.log('Activated')});
self.addEventListener('fetch',(event)=>{
    event.respondWith(caches.match(event.request)
    .then(cachedResponse=>{return cachedResponse ||fetch(event.request);}))
    
    
    console.log('Fetched from:'+event.request.url)})
self.addEventListener('push',event=>{
    const title="this is my title";
    const body="Lets go";
    const icon="icon.png";
    const tag="aj-tag";
    event.waitUntil(
        self.registration.showNotification(title,{
            body:body,
            icon:icon,
            tag:tag
        })
    )
})

