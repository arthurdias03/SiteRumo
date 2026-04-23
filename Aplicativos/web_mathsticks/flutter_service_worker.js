'use strict';
const MANIFEST = 'flutter-app-manifest';
const TEMP = 'flutter-temp-cache';
const CACHE_NAME = 'flutter-app-cache';

const RESOURCES = {"assets/AssetManifest.bin": "f1de2cc34f2587e7d9f6959e4aa6d211",
"assets/AssetManifest.bin.json": "32b6d3dde177da8a224412a6bf677d25",
"assets/AssetManifest.json": "e88187e011d2b26b9e0abf72c3d34179",
"assets/assets/fonts/Poppins-Light.ttf": "fcc40ae9a542d001971e53eaed948410",
"assets/assets/images/CNPQ_Logo.png": "26649c6831c5e22bcc1aee92e76381df",
"assets/assets/images/IFSP_Logo.png": "cb22ff2feaba4a2f3caa6550a662a625",
"assets/assets/images/palito_dd.png": "404e0333663fc8a04bf51f08b4c4ad23",
"assets/assets/images/palito_de.png": "d326cd1a3e70174910e459e26fbe36a1",
"assets/assets/images/palito_h.png": "57a7245805171f542b613db5eb63529a",
"assets/assets/images/palito_v.png": "25dbe268fffad7665c669179c6df76a4",
"assets/assets/images/personagem.png": "d56dc3e859429adaaec204025a5fb544",
"assets/assets/images/ponto.png": "140b2160a1017c34024a140eb73a86f9",
"assets/assets/images/pularb.png": "ed3e24ad0f6b81d45d3b039a66285fc1",
"assets/assets/images/pularc.png": "3babf91f880e1f6d6e8b8b3656bfabda",
"assets/assets/images/pulard.png": "b0b746cc700b855a2d233d9275bd032a",
"assets/assets/images/pulare.png": "d833ff6a2029ac63d0969b18b5944dc9",
"assets/assets/images/RUMO_Logo.png": "6c3d2bad6f81757d9d4e14e540a49731",
"assets/assets/sounds/baixo.mp3": "baea6bb4aa8928d7dafa4c02afed77cd",
"assets/assets/sounds/cima.mp3": "20181b6dd9fa460a46dcb770e4a6714f",
"assets/assets/sounds/direita.mp3": "db50b745a126b0e20f1a5c6de7622150",
"assets/assets/sounds/esquerda.mp3": "3b0afc29f3fbe7fde530d948c0c3faa3",
"assets/assets/sounds/palitoDiagonalDireita.mp3": "5494e6f9010a3a448d87498ed15a0707",
"assets/assets/sounds/palitoDiagonalEsquerda.mp3": "71c24ba8332a152e3dbc1ea2e73a3ae7",
"assets/assets/sounds/palitoHorizontal.mp3": "4e5c11ff5112e8dc28463913c3ab8602",
"assets/assets/sounds/palitoVertical.mp3": "4e3ca8d2dc6dd5bd96b9f47fda58c401",
"assets/FontManifest.json": "d1188ded18ed599549b04a82b4e699cd",
"assets/fonts/MaterialIcons-Regular.otf": "5ad329c1b8cd5a1c83ceb19a1d81f64b",
"assets/NOTICES": "ff9311f139b6a18f01736a24675fc299",
"assets/packages/cupertino_icons/assets/CupertinoIcons.ttf": "33b7d9392238c04c131b6ce224e13711",
"assets/shaders/ink_sparkle.frag": "ecc85a2e95f5e9f53123dcaf8cb9b6ce",
"canvaskit/canvaskit.js": "86e461cf471c1640fd2b461ece4589df",
"canvaskit/canvaskit.js.symbols": "68eb703b9a609baef8ee0e413b442f33",
"canvaskit/canvaskit.wasm": "efeeba7dcc952dae57870d4df3111fad",
"canvaskit/chromium/canvaskit.js": "34beda9f39eb7d992d46125ca868dc61",
"canvaskit/chromium/canvaskit.js.symbols": "5a23598a2a8efd18ec3b60de5d28af8f",
"canvaskit/chromium/canvaskit.wasm": "64a386c87532ae52ae041d18a32a3635",
"canvaskit/skwasm.js": "f2ad9363618c5f62e813740099a80e63",
"canvaskit/skwasm.js.symbols": "80806576fa1056b43dd6d0b445b4b6f7",
"canvaskit/skwasm.wasm": "f0dfd99007f989368db17c9abeed5a49",
"canvaskit/skwasm_st.js": "d1326ceef381ad382ab492ba5d96f04d",
"canvaskit/skwasm_st.js.symbols": "c7e7aac7cd8b612defd62b43e3050bdd",
"canvaskit/skwasm_st.wasm": "56c3973560dfcbf28ce47cebe40f3206",
"favicon.png": "923f520f1a1f01d0a25f6e69da865e2d",
"flutter.js": "76f08d47ff9f5715220992f993002504",
"flutter_bootstrap.js": "116437f209cc8022fcedd97c4695e510",
"icons/Icon-192.png": "8cf44af57f87c3589cf82d359758beb6",
"icons/Icon-512.png": "aec49a9d90b39dadf894bdf2be1f86e7",
"icons/Icon-maskable-192.png": "8cf44af57f87c3589cf82d359758beb6",
"icons/Icon-maskable-512.png": "aec49a9d90b39dadf894bdf2be1f86e7",
"index.html": "c9a9d437ea5c24c2323a55279c728805",
"/": "c9a9d437ea5c24c2323a55279c728805",
"main.dart.js": "32c3baf7260744c39c701389816a86f3",
"manifest.json": "5e3956bd8c88edf010e26470f2dd75a5",
"version.json": "1dc19ad8cfe7d8102e00593af171037e"};
// The application shell files that are downloaded before a service worker can
// start.
const CORE = ["main.dart.js",
"index.html",
"flutter_bootstrap.js",
"assets/AssetManifest.bin.json",
"assets/FontManifest.json"];

// During install, the TEMP cache is populated with the application shell files.
self.addEventListener("install", (event) => {
  self.skipWaiting();
  return event.waitUntil(
    caches.open(TEMP).then((cache) => {
      return cache.addAll(
        CORE.map((value) => new Request(value, {'cache': 'reload'})));
    })
  );
});
// During activate, the cache is populated with the temp files downloaded in
// install. If this service worker is upgrading from one with a saved
// MANIFEST, then use this to retain unchanged resource files.
self.addEventListener("activate", function(event) {
  return event.waitUntil(async function() {
    try {
      var contentCache = await caches.open(CACHE_NAME);
      var tempCache = await caches.open(TEMP);
      var manifestCache = await caches.open(MANIFEST);
      var manifest = await manifestCache.match('manifest');
      // When there is no prior manifest, clear the entire cache.
      if (!manifest) {
        await caches.delete(CACHE_NAME);
        contentCache = await caches.open(CACHE_NAME);
        for (var request of await tempCache.keys()) {
          var response = await tempCache.match(request);
          await contentCache.put(request, response);
        }
        await caches.delete(TEMP);
        // Save the manifest to make future upgrades efficient.
        await manifestCache.put('manifest', new Response(JSON.stringify(RESOURCES)));
        // Claim client to enable caching on first launch
        self.clients.claim();
        return;
      }
      var oldManifest = await manifest.json();
      var origin = self.location.origin;
      for (var request of await contentCache.keys()) {
        var key = request.url.substring(origin.length + 1);
        if (key == "") {
          key = "/";
        }
        // If a resource from the old manifest is not in the new cache, or if
        // the MD5 sum has changed, delete it. Otherwise the resource is left
        // in the cache and can be reused by the new service worker.
        if (!RESOURCES[key] || RESOURCES[key] != oldManifest[key]) {
          await contentCache.delete(request);
        }
      }
      // Populate the cache with the app shell TEMP files, potentially overwriting
      // cache files preserved above.
      for (var request of await tempCache.keys()) {
        var response = await tempCache.match(request);
        await contentCache.put(request, response);
      }
      await caches.delete(TEMP);
      // Save the manifest to make future upgrades efficient.
      await manifestCache.put('manifest', new Response(JSON.stringify(RESOURCES)));
      // Claim client to enable caching on first launch
      self.clients.claim();
      return;
    } catch (err) {
      // On an unhandled exception the state of the cache cannot be guaranteed.
      console.error('Failed to upgrade service worker: ' + err);
      await caches.delete(CACHE_NAME);
      await caches.delete(TEMP);
      await caches.delete(MANIFEST);
    }
  }());
});
// The fetch handler redirects requests for RESOURCE files to the service
// worker cache.
self.addEventListener("fetch", (event) => {
  if (event.request.method !== 'GET') {
    return;
  }
  var origin = self.location.origin;
  var key = event.request.url.substring(origin.length + 1);
  // Redirect URLs to the index.html
  if (key.indexOf('?v=') != -1) {
    key = key.split('?v=')[0];
  }
  if (event.request.url == origin || event.request.url.startsWith(origin + '/#') || key == '') {
    key = '/';
  }
  // If the URL is not the RESOURCE list then return to signal that the
  // browser should take over.
  if (!RESOURCES[key]) {
    return;
  }
  // If the URL is the index.html, perform an online-first request.
  if (key == '/') {
    return onlineFirst(event);
  }
  event.respondWith(caches.open(CACHE_NAME)
    .then((cache) =>  {
      return cache.match(event.request).then((response) => {
        // Either respond with the cached resource, or perform a fetch and
        // lazily populate the cache only if the resource was successfully fetched.
        return response || fetch(event.request).then((response) => {
          if (response && Boolean(response.ok)) {
            cache.put(event.request, response.clone());
          }
          return response;
        });
      })
    })
  );
});
self.addEventListener('message', (event) => {
  // SkipWaiting can be used to immediately activate a waiting service worker.
  // This will also require a page refresh triggered by the main worker.
  if (event.data === 'skipWaiting') {
    self.skipWaiting();
    return;
  }
  if (event.data === 'downloadOffline') {
    downloadOffline();
    return;
  }
});
// Download offline will check the RESOURCES for all files not in the cache
// and populate them.
async function downloadOffline() {
  var resources = [];
  var contentCache = await caches.open(CACHE_NAME);
  var currentContent = {};
  for (var request of await contentCache.keys()) {
    var key = request.url.substring(origin.length + 1);
    if (key == "") {
      key = "/";
    }
    currentContent[key] = true;
  }
  for (var resourceKey of Object.keys(RESOURCES)) {
    if (!currentContent[resourceKey]) {
      resources.push(resourceKey);
    }
  }
  return contentCache.addAll(resources);
}
// Attempt to download the resource online before falling back to
// the offline cache.
function onlineFirst(event) {
  return event.respondWith(
    fetch(event.request).then((response) => {
      return caches.open(CACHE_NAME).then((cache) => {
        cache.put(event.request, response.clone());
        return response;
      });
    }).catch((error) => {
      return caches.open(CACHE_NAME).then((cache) => {
        return cache.match(event.request).then((response) => {
          if (response != null) {
            return response;
          }
          throw error;
        });
      });
    })
  );
}
