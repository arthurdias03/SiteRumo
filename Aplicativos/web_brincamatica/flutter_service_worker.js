'use strict';
const MANIFEST = 'flutter-app-manifest';
const TEMP = 'flutter-temp-cache';
const CACHE_NAME = 'flutter-app-cache';

const RESOURCES = {"assets/AssetManifest.bin": "2b3a9e8e30e742654c7134f02a765dbe",
"assets/AssetManifest.bin.json": "0d48bee79361b7a712cd77ddca70ec91",
"assets/AssetManifest.json": "5ee9420636e6a927595d46f08eb8c0a1",
"assets/assets/fonts/Poppins-Light.ttf": "fcc40ae9a542d001971e53eaed948410",
"assets/assets/images/buttons/button_assobiar_boy_dark_transp.png": "29a96b46b96172be5a4aa9b9fa066a54",
"assets/assets/images/buttons/button_assobiar_boy_light_transp.png": "b3f1a853c7aa8133e055e41f49736791",
"assets/assets/images/buttons/button_assobiar_girl_dark_transp.png": "0cd18b784d9423c38f043e806734b761",
"assets/assets/images/buttons/button_assobiar_girl_light_transp.png": "7f83790e3d5a052cf490f14be0ea4bad",
"assets/assets/images/buttons/button_bater_palma_dark_transp.png": "abe5abafab721faea100d1370de0420e",
"assets/assets/images/buttons/button_bater_palma_light_transp.png": "ea4fce3a0157230926551b9057c7ca63",
"assets/assets/images/buttons/button_bater_peito_boy_dark_transp.png": "9598cbe7681fdeb8ba9d3f0ff8d460e6",
"assets/assets/images/buttons/button_bater_peito_boy_light_transp.png": "d7c0c4d80f0495893bc263222e19be06",
"assets/assets/images/buttons/button_bater_peito_girl_dark_transp.png": "555656ae579ad1efa4bf5e936eaf4e3f",
"assets/assets/images/buttons/button_bater_peito_girl_light_transp.png": "12d0055c2488def305b7dc315cfa9935",
"assets/assets/images/buttons/button_bater_perna_boy_dark_transp.png": "cd85b7191458e0993119ec2c843d27b0",
"assets/assets/images/buttons/button_bater_perna_boy_light_transp.png": "b4c90ddc9c0d54300df4e470f9f47738",
"assets/assets/images/buttons/button_bater_perna_girl_dark_transp.png": "a0b8efee6b9bf3e4c7382fc6d2d452e1",
"assets/assets/images/buttons/button_bater_perna_girl_light_transp.png": "a490d549cfa18e997cbecdbad12df1ea",
"assets/assets/images/buttons/button_bater_pe_boy_dark_transp.png": "fb79f49375c9c833a09e49320003909f",
"assets/assets/images/buttons/button_bater_pe_boy_light_transp.png": "116b0c7052dd22906c1d0a232b4ade60",
"assets/assets/images/buttons/button_bater_pe_girl_dark_transp.png": "9fb0362f89b8d140d188b1938d620d17",
"assets/assets/images/buttons/button_bater_pe_girl_light_transp.png": "4f80d89ae9c73239caf2ab072bb77c31",
"assets/assets/images/buttons/button_beijo_boy_dark_transp.png": "b8cb34f82612313a3406f65204d705df",
"assets/assets/images/buttons/button_beijo_boy_light_transp.png": "87511eff8a630d7707d11a54908fa03c",
"assets/assets/images/buttons/button_beijo_girl_dark_transp.png": "7397ba2300f5fa04ae9ae2f6613d93c7",
"assets/assets/images/buttons/button_beijo_girl_light_transp.png": "7c5ceff9520f4336138f453ea2e80c11",
"assets/assets/images/buttons/button_estalar_dedo_dark_transp.png": "77e3e10bf1f4deacbbe102abd919ee13",
"assets/assets/images/buttons/button_estalar_dedo_light_transp.png": "46700fe24afbdeb43d77b2f28b227015",
"assets/assets/images/buttons/button_estalar_lingua1_boy_dark_transp.png": "62dfd75a1cc5286678dcde8c2d86714e",
"assets/assets/images/buttons/button_estalar_lingua1_boy_light_transp.png": "1b9f1d930175906e476811493d8f0930",
"assets/assets/images/buttons/button_estalar_lingua1_girl_dark_transp.png": "d96bb267bdeb06d2b331eab929936ccb",
"assets/assets/images/buttons/button_estalar_lingua1_girl_light_transp.png": "ff5da1a78ed3b3d26ec59703f232633b",
"assets/assets/images/buttons/button_estalar_lingua2_boy_dark_transp.png": "3d30e97e4647ad46f5b7dd747992ce07",
"assets/assets/images/buttons/button_estalar_lingua2_boy_light_transp.png": "5cd809cddb4d3a2a5a181b0fc61ce8af",
"assets/assets/images/buttons/button_estalar_lingua2_girl_dark_transp.png": "2575313b0797d36154d712106f331369",
"assets/assets/images/buttons/button_estalar_lingua2_girl_light_transp.png": "5cc0a8b98691daa83c8b78f5c6708a89",
"assets/assets/images/buttons/button_gritar_boy_dark_transp.png": "fc4f0423b7dd76705c3da855cab6f951",
"assets/assets/images/buttons/button_gritar_boy_light_transp.png": "f3060a207759578f4d1e3614899488cd",
"assets/assets/images/buttons/button_gritar_girl_dark_transp.png": "a2a810e534b34bf466eb773243da9348",
"assets/assets/images/buttons/button_gritar_girl_light_transp.png": "f7b5e866cc78bbe805410d2cf48315c1",
"assets/assets/images/characters/character_boy_dark.png": "32e256375530dc392b40a671df0dd575",
"assets/assets/images/characters/character_boy_light.png": "a667fe13df3454b1dee28a1a8668196f",
"assets/assets/images/characters/character_girl_dark.png": "621052cfa5e0479feb405f4e5fb2a6b8",
"assets/assets/images/characters/character_girl_light.png": "21292d9265d97b65c33afbb16dfb1713",
"assets/assets/images/CNPQ_Logo.png": "26649c6831c5e22bcc1aee92e76381df",
"assets/assets/images/icons/icon_assobiar_boy_dark.png": "3a05ec3918b271aad5f8547c2fd3a29f",
"assets/assets/images/icons/icon_assobiar_boy_light.png": "b4b0df82fae4af7b5aa5f1e1c693f81d",
"assets/assets/images/icons/icon_assobiar_girl_dark.png": "592b85085ce9778fd31632118ba8c726",
"assets/assets/images/icons/icon_assobiar_girl_light.png": "e61685ba6661a7087dabf3b612660e78",
"assets/assets/images/icons/icon_bater_palma_dark.png": "698efaabe8ac118bdace5def58dcef86",
"assets/assets/images/icons/icon_bater_palma_light.png": "be27fc09b45101f319d387dfd871a60e",
"assets/assets/images/icons/icon_bater_peito_boy_dark.png": "d96f7e469085b71c4d57732ef20d870e",
"assets/assets/images/icons/icon_bater_peito_boy_light.png": "0737c574cbbfd61a1029082615dc2f70",
"assets/assets/images/icons/icon_bater_peito_girl_dark.png": "b0357d75fc96b08e2be541979b0edcfb",
"assets/assets/images/icons/icon_bater_peito_girl_light.png": "39c4c657d82d62bb38019e59f6c204d1",
"assets/assets/images/icons/icon_bater_perna_boy_dark.png": "646f21c50be4d5ae0a339386fd62c1ae",
"assets/assets/images/icons/icon_bater_perna_boy_light.png": "77ba885c6e7527956f2194950bf00e3e",
"assets/assets/images/icons/icon_bater_perna_girl_dark.png": "846d51ce246512c59e7f98df5cc14d03",
"assets/assets/images/icons/icon_bater_perna_girl_light.png": "ec30a3ce74599ef43b3b2dd2aef99f7c",
"assets/assets/images/icons/icon_bater_pe_boy_dark.png": "6735ba36f0c5eca564bfe75eb736d8cc",
"assets/assets/images/icons/icon_bater_pe_boy_light.png": "f4d72dfc3c0b888fd4b7b44fb90ac877",
"assets/assets/images/icons/icon_bater_pe_girl_dark.png": "70f4b27ec2fffa6f93c8f47e4e4d86af",
"assets/assets/images/icons/icon_bater_pe_girl_light.png": "19293debd112f12e77bc70973c7d83da",
"assets/assets/images/icons/icon_beijo_boy_dark.png": "d59b2db0da2fee4515e63ddbc8018b45",
"assets/assets/images/icons/icon_beijo_boy_light.png": "d3648336d1ea10036063b72016532301",
"assets/assets/images/icons/icon_beijo_girl_dark.png": "e1846aa9d03c913307f2371fbbdf0e1f",
"assets/assets/images/icons/icon_beijo_girl_light.png": "f12b0a78d24fa40caf06e10906a17945",
"assets/assets/images/icons/icon_estalar_dedo_dark.png": "8d1002ab34be1b783d573e4b8e9b2fbd",
"assets/assets/images/icons/icon_estalar_dedo_light.png": "7ff46a737a4fd157b99485c1ea3b270a",
"assets/assets/images/icons/icon_estalar_lingua1_boy_dark.png": "9efaafde5e6ec797588d38a461326309",
"assets/assets/images/icons/icon_estalar_lingua1_boy_light.png": "5b724ef0b5baef750b74de8baefcc2ff",
"assets/assets/images/icons/icon_estalar_lingua1_girl_dark.png": "3911e03d3586f9b3beaf9fc252eae7c1",
"assets/assets/images/icons/icon_estalar_lingua1_girl_light.png": "2c127d8637bac3cb25034971bdcf7e27",
"assets/assets/images/icons/icon_estalar_lingua2_boy_dark.png": "29a602cf502f52302dc21ff73fb4bbf6",
"assets/assets/images/icons/icon_estalar_lingua2_boy_light.png": "8ac152da018c931bc57cac96db24a0b6",
"assets/assets/images/icons/icon_estalar_lingua2_girl_dark.png": "d43a869073e66e93659285a81f5062d0",
"assets/assets/images/icons/icon_estalar_lingua2_girl_light.png": "f7af304990bb4c8425129fc4ff3c8533",
"assets/assets/images/icons/icon_gritar_boy_dark.png": "6b56dc8fdc3b36874a38bfd030300390",
"assets/assets/images/icons/icon_gritar_boy_light.png": "2136ec12d6541c2f4c9e03fc16c57f6d",
"assets/assets/images/icons/icon_gritar_girl_dark.png": "0c6b7271ffec6e2d6be7fead8d4b9aea",
"assets/assets/images/icons/icon_gritar_girl_light.png": "28389b9a667952b7d20dd5bb2dfbb151",
"assets/assets/images/IFSP_Logo.png": "cb22ff2feaba4a2f3caa6550a662a625",
"assets/assets/images/personagem.png": "76ea93c0985ec40fc1418d340fa055a1",
"assets/assets/images/RUMO_Logo.png": "6c3d2bad6f81757d9d4e14e540a49731",
"assets/assets/sounds/assobiar.mp3": "f22de67613255b6e5276daeca486b6f7",
"assets/assets/sounds/baterPalma.mp3": "e14c64be8b1a27a900b5cbec777afb61",
"assets/assets/sounds/baterPeito.mp3": "4e8a3aa7ef1448e4eddd49fbcade97f0",
"assets/assets/sounds/baterPerna.mp3": "72a90aa6c235d5c0afb4e2b1723d15ad",
"assets/assets/sounds/baterPes.mp3": "4b898c998067929f44b60a911e2f24b2",
"assets/assets/sounds/beijo.mp3": "691cd878cede42276a4542ed49391616",
"assets/assets/sounds/correto.mp3": "f9e8873856b228892f98fc1754858e9e",
"assets/assets/sounds/errado.mp3": "88fcc5fee872606cf73a2c88c3cd89a0",
"assets/assets/sounds/estalarDedos.mp3": "e0031630993a3fb7fc9164f247170ab0",
"assets/assets/sounds/estalarLingua1.mp3": "524dc2349c6303de40909b40de978e25",
"assets/assets/sounds/estalarLingua2.mp3": "159da15b86dbfcad13870a1cbe925a91",
"assets/assets/sounds/gritar.mp3": "e7d429effe5794ecb25132832a3ae260",
"assets/FontManifest.json": "d1188ded18ed599549b04a82b4e699cd",
"assets/fonts/MaterialIcons-Regular.otf": "1c143384465836c425c61cb485737388",
"assets/NOTICES": "6491b300c7544eb2cba84e4e186db127",
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
"favicon.png": "9d6695764a29ac2cec66e119f70d09c6",
"flutter.js": "76f08d47ff9f5715220992f993002504",
"flutter_bootstrap.js": "c6f118b6c1da207ed992da7815276e62",
"icons/Icon-192.png": "8f888da4a4c92469048fdb8ae7869d0d",
"icons/Icon-512.png": "bbcd4ab8a701dfebd5b70788bcda46ba",
"icons/Icon-maskable-192.png": "c457ef57daa1d16f64b27b786ec2ea3c",
"icons/Icon-maskable-512.png": "301a7604d45b3e739efc881eb04896ea",
"index.html": "4d2e8f5e5d9340c2748c94f9c69a306c",
"/": "4d2e8f5e5d9340c2748c94f9c69a306c",
"main.dart.js": "8d2d258cc9f2beb2d34b6752c3459742",
"manifest.json": "06d38abb3252a690895977548e4994c9",
"version.json": "5eb66c96605d75664901be3ad53a06c5"};
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
