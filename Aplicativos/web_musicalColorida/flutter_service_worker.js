'use strict';
const MANIFEST = 'flutter-app-manifest';
const TEMP = 'flutter-temp-cache';
const CACHE_NAME = 'flutter-app-cache';

const RESOURCES = {"assets/AssetManifest.bin": "0e4da87a73bb9c33e3a5259527e18373",
"assets/AssetManifest.bin.json": "58b09faa79ce0443c42fac30421c56f1",
"assets/AssetManifest.json": "dc667701844b0a76f4f8017d30f9c283",
"assets/assets/images/CNPQ_Logo.png": "26649c6831c5e22bcc1aee92e76381df",
"assets/assets/images/IFSP_Logo.png": "cb22ff2feaba4a2f3caa6550a662a625",
"assets/assets/images/RUMO_Logo.png": "6c3d2bad6f81757d9d4e14e540a49731",
"assets/assets/sounds/baixo/A4_Baixo_Eletrico_Dedo.mp3": "0e9813f759d90571d4840bdcb8995e44",
"assets/assets/sounds/baixo/B4_Baixo_Eletrico_Dedo.mp3": "afbb6ee3e813fc529ef6992a1d2b6e3e",
"assets/assets/sounds/baixo/C24_Baixo_Eletrico_Dedo.mp3": "992b70e631fdc14207819f6cb548103b",
"assets/assets/sounds/baixo/C4_Baixo_Eletrico_Dedo.mp3": "793933bd96669dec02c88da817ee83ce",
"assets/assets/sounds/baixo/D24_Baixo_Eletrico_Dedo.mp3": "a138bd09c4fe065fbbc7eeb2392e0004",
"assets/assets/sounds/baixo/D4_Baixo_Eletrico_Dedo.mp3": "e45fb9e9fadc79b436ac22cdf85f9eaf",
"assets/assets/sounds/baixo/E4_Baixo_Eletrico_Dedo.mp3": "d90fbcd0fc0cf73c2918c539064715e7",
"assets/assets/sounds/baixo/F24_Baixo_Eletrico_Dedo.mp3": "7f390835bd3f78819ed4aa7d2433460d",
"assets/assets/sounds/baixo/F4_Baixo_Eletrico_Dedo.mp3": "111a2c9e2d6bda2e2a6dd90a6a02b18c",
"assets/assets/sounds/baixo/G4_Baixo_Eletrico_Dedo.mp3": "68effc283ea1e9ccb94f37a7cfd2dd41",
"assets/assets/sounds/banjo/A4_Banjo.mp3": "be4882dbbed3c0ebb0806564da977a98",
"assets/assets/sounds/banjo/B4_Banjo.mp3": "0325ae1478ee03c7e7f615ee7a081840",
"assets/assets/sounds/banjo/C24_Banjo.mp3": "b1150bc59f673f7f8a68a12042dc2a7e",
"assets/assets/sounds/banjo/C4_Banjo.mp3": "c44dfc50b88d5ae3a709d35532d18d08",
"assets/assets/sounds/banjo/D24_Banjo.mp3": "6df8b14384c62de883350834d073ed17",
"assets/assets/sounds/banjo/D4_Banjo.mp3": "78d745a741b6d5440f1b6f2d6c61bcd9",
"assets/assets/sounds/banjo/E4_Banjo.mp3": "6dbbbeecd1b2e6e3461c5efaa13539fa",
"assets/assets/sounds/banjo/F24_Banjo.mp3": "15082a841afc07a371354972933f380f",
"assets/assets/sounds/banjo/F4_Banjo.mp3": "dd10821b23839f94b85c22aead1aeb31",
"assets/assets/sounds/banjo/G4_Banjo.mp3": "8fa5a8e810029a43f5bbb6cb2a4c4657",
"assets/assets/sounds/flauta/A4_Flauta.mp3": "c8e47c52f37a7860c780bb588c8c29f2",
"assets/assets/sounds/flauta/B4_Flauta.mp3": "dd779e57d24e48ead8f597634b7249ec",
"assets/assets/sounds/flauta/C24_Flauta.mp3": "12fd0544c9658c06bce201e89329cdaa",
"assets/assets/sounds/flauta/C4_Flauta.mp3": "040a914ad505d080ca5b7eaee646d15b",
"assets/assets/sounds/flauta/D24_Flauta.mp3": "20a11f7efa81276c52415dfed21040f8",
"assets/assets/sounds/flauta/D4_Flauta.mp3": "2e8285413dffd1accb22b191033f5b4c",
"assets/assets/sounds/flauta/E4_Flauta.mp3": "8ea281adb2bb071f18d4640ae538ed4d",
"assets/assets/sounds/flauta/F24_Flauta.mp3": "e8a51f4c4b71efa1401ed5e7d0e80cb7",
"assets/assets/sounds/flauta/F4_Flauta.mp3": "5692eb2fafeb390a9aa58854330208c4",
"assets/assets/sounds/flauta/G4_Flauta.mp3": "fced52a6fe9158003958014ae3957e70",
"assets/assets/sounds/flautadoce/A4_Flauta_Doce.mp3": "3afb52b3b922ca6f90fb455412727b0c",
"assets/assets/sounds/flautadoce/B4_Flauta_Doce.mp3": "14957106adfdef97861c42a5dd1f81b0",
"assets/assets/sounds/flautadoce/C24_Flauta_Doce.mp3": "28d0c90f7024c47c75ffe5c03dd0850d",
"assets/assets/sounds/flautadoce/C4_Flauta_Doce.mp3": "d86074cee88bd36b3683200c7d2fda7e",
"assets/assets/sounds/flautadoce/D24_Flauta_Doce.mp3": "f7a6bad4fe899aabdb60c0dda70a7378",
"assets/assets/sounds/flautadoce/D4_Flauta_Doce.mp3": "9ee33e087d88c70efe9f3b697ba27310",
"assets/assets/sounds/flautadoce/E4_Flauta_Doce.mp3": "ee6dc5eb2a31f6e64c3b5cac26dcb1fa",
"assets/assets/sounds/flautadoce/F24_Flauta_Doce.mp3": "2f35ec376f88ea0be85b2f4648333f0e",
"assets/assets/sounds/flautadoce/F4_Flauta_Doce.mp3": "c475f8ce9f42d69b3372b4a6420fbf60",
"assets/assets/sounds/flautadoce/G4_Flauta_Doce.mp3": "68d74c1f52d554ef423ca988a1656be8",
"assets/assets/sounds/guitarra/A4_Guitarra_Eletrica_Limpa.mp3": "19f82bfe884a92fb74118f1a3e2f320f",
"assets/assets/sounds/guitarra/B4_Guitarra_Eletrica_Limpa.mp3": "c0c578656fdaf4c8529d6ccdd2bcdde7",
"assets/assets/sounds/guitarra/C24_Guitarra_Eletrica_Limpa.mp3": "555c7955cee690150ca43883e41e673d",
"assets/assets/sounds/guitarra/C4_Guitarra_Eletrica_Limpa.mp3": "09c2765c0cf4d712ba08ab248c97d6f7",
"assets/assets/sounds/guitarra/D24_Guitarra_Eletrica_Limpa.mp3": "df336fcb13a4a5632016db1ce6ce4069",
"assets/assets/sounds/guitarra/D4_Guitarra_Eletrica_Limpa.mp3": "8ea76ccb38f20fa6455c79feed64ad93",
"assets/assets/sounds/guitarra/E4_Guitarra_Eletrica_Limpa.mp3": "679e787764fca13781dc15ad0f211ef6",
"assets/assets/sounds/guitarra/F24_Guitarra_Eletrica_Limpa.mp3": "2c9f6d1d52b5912f9aa89fe034699842",
"assets/assets/sounds/guitarra/F4_Guitarra_Eletrica_Limpa.mp3": "710e89674d0a96605b3f7041abe2e386",
"assets/assets/sounds/guitarra/G4_Guitarra_Eletrica_Limpa.mp3": "c965976f374d2bacb36aea4320199045",
"assets/assets/sounds/orgao/A4_%25C3%2593rg%25C3%25A3o_Hammond.mp3": "6b1b04953de20aba2e595f3d1129bf3b",
"assets/assets/sounds/orgao/B4_%25C3%2593rg%25C3%25A3o_Hammond.mp3": "10208449050970016beb0cd0f2948bc3",
"assets/assets/sounds/orgao/C24_%25C3%2593rg%25C3%25A3o_Hammond.mp3": "0309ac9c296deca39bfd0a2e6bc0f42d",
"assets/assets/sounds/orgao/C4_%25C3%2593rg%25C3%25A3o_Hammond.mp3": "3959ee92dc0d522da2e73ceee0f1c89c",
"assets/assets/sounds/orgao/D24_%25C3%2593rg%25C3%25A3o_Hammond.mp3": "222ce0372846d493c40b6f8bb83af0f9",
"assets/assets/sounds/orgao/D4_%25C3%2593rg%25C3%25A3o_Hammond.mp3": "634f2234325d5045390f1da8f51980e0",
"assets/assets/sounds/orgao/E4_%25C3%2593rg%25C3%25A3o_Hammond.mp3": "0288ffe22526c2b4a14258da207d567c",
"assets/assets/sounds/orgao/F24_%25C3%2593rg%25C3%25A3o_Hammond.mp3": "a19cdbca55670e2bb765768f9e128652",
"assets/assets/sounds/orgao/F4_%25C3%2593rg%25C3%25A3o_Hammond.mp3": "e1eeb2c0c209dbcae48141b10ac4385b",
"assets/assets/sounds/orgao/G4_%25C3%2593rg%25C3%25A3o_Hammond.mp3": "b5b77166f035484bbc4adc1ed45486d9",
"assets/assets/sounds/piano/A4_Piano_Acustico.mp3": "aaebbbb6b77f64f02915d11a7a202bc3",
"assets/assets/sounds/piano/B4_Piano_Acustico.mp3": "128198ffcafa92be0a69ab40b770a56b",
"assets/assets/sounds/piano/C24_Piano_Acustico.mp3": "80d5d1a6fd83e0b6ab0d0014f2fb5541",
"assets/assets/sounds/piano/C4_Piano_Acustico.mp3": "945c8003b82f235555ca6d6dabe4aff0",
"assets/assets/sounds/piano/D24_Piano_Acustico.mp3": "bf4a0ca3c2971507218f42ae290ece16",
"assets/assets/sounds/piano/D4_Piano_Acustico.mp3": "2bbbff078406e741cf4ab666dde3b4f0",
"assets/assets/sounds/piano/E4_Piano_Acustico.mp3": "a7073ca62c1c1b7c654689cd4e38cb93",
"assets/assets/sounds/piano/F24_Piano_Acustico.mp3": "d103127214d7d3bf177b7539cc36f5df",
"assets/assets/sounds/piano/F4_Piano_Acustico.mp3": "d8002bd7a39e55af3ebbf28299253643",
"assets/assets/sounds/piano/G4_Piano_Acustico.mp3": "52520f62c180ed4b28db570dd8d7b46b",
"assets/assets/sounds/pianoeletrico/A4_Piano_Eletrico_1.mp3": "de09f2ef31ef47797f8ba2bc12cc5e1c",
"assets/assets/sounds/pianoeletrico/B4_Piano_Eletrico_1.mp3": "2de8b74ae2fdc297a9205312394c7169",
"assets/assets/sounds/pianoeletrico/C24_Piano_Eletrico_1.mp3": "f277b69766ec3e4b094a5738048405c8",
"assets/assets/sounds/pianoeletrico/C4_Piano_Eletrico_1.mp3": "bbfe4ca92bf087460d14534723b93d83",
"assets/assets/sounds/pianoeletrico/D24_Piano_Eletrico_1.mp3": "ac646ee2621ebfbc4b8bf92605f60710",
"assets/assets/sounds/pianoeletrico/D4_Piano_Eletrico_1.mp3": "b89afce5ad08c4d2f152359946c05041",
"assets/assets/sounds/pianoeletrico/E4_Piano_Eletrico_1.mp3": "a661aedc21d6c3caf0cd02149e1942ed",
"assets/assets/sounds/pianoeletrico/F24_Piano_Eletrico_1.mp3": "db0886de00607f1cf350d52aff147c1a",
"assets/assets/sounds/pianoeletrico/F4_Piano_Eletrico_1.mp3": "f6c38e87eee741cb45388c4c8ca143dd",
"assets/assets/sounds/pianoeletrico/G4_Piano_Eletrico_1.mp3": "b944f8d7d151c911492bb0607599637e",
"assets/assets/sounds/silence.mp3": "3bc6b8dd476d36f1b056c144bd06e3c1",
"assets/assets/sounds/sitar/A4_Sitar.mp3": "35f1b54dd945bcc6875d6f9b20c5b6e8",
"assets/assets/sounds/sitar/B4_Sitar.mp3": "34c2cf96139f356e0d3d1f8e2dc310fd",
"assets/assets/sounds/sitar/C24_Sitar.mp3": "bdd87c2428bbba910d929bcd0b78abd9",
"assets/assets/sounds/sitar/C4_Sitar.mp3": "7a0c653aa46624df5d03ba54daed8550",
"assets/assets/sounds/sitar/D24_Sitar.mp3": "fee007727d43f82a39db57881b53c7c3",
"assets/assets/sounds/sitar/D4_Sitar.mp3": "a2d070c9e5a7228cfb8ff5a8c4f021e7",
"assets/assets/sounds/sitar/E4_Sitar.mp3": "bc7957f89c4be830ba7fe88aa9bf277a",
"assets/assets/sounds/sitar/F24_Sitar.mp3": "e125d320d609f36ecf8cc455248d2e60",
"assets/assets/sounds/sitar/F4_Sitar.mp3": "2a5795d760e84f14c07ddc9aa512ada9",
"assets/assets/sounds/sitar/G4_Sitar.mp3": "21cd10dc39d803f347b9c5a2701c3d04",
"assets/assets/sounds/trompete/A4_Trompete.mp3": "681689ec12e6d4cc46460cea99e23417",
"assets/assets/sounds/trompete/B4_Trompete.mp3": "94c87d7e43af56ca06244ffa894ee490",
"assets/assets/sounds/trompete/C24_Trompete.mp3": "9fcc2b47346b9aa55f51eb9329465454",
"assets/assets/sounds/trompete/C4_Trompete.mp3": "565851ee8339d9e3283521b56e6f4bca",
"assets/assets/sounds/trompete/D24_Trompete.mp3": "f0033d3a03621fc41257eaa07e4dca6c",
"assets/assets/sounds/trompete/D4_Trompete.mp3": "42c0654830ab029e6b0605c3d7e90ac0",
"assets/assets/sounds/trompete/E4_Trompete.mp3": "3c8349475c667f3ae8a80e9ee0cb9d72",
"assets/assets/sounds/trompete/F24_Trompete.mp3": "208b9998d1cc3932d134ec61b1c90d7a",
"assets/assets/sounds/trompete/F4_Trompete.mp3": "3969ffce9eb576909432f6d12e4d9327",
"assets/assets/sounds/trompete/G4_Trompete.mp3": "e59d8a3ee1872b9facd5a6d070c4a4d5",
"assets/assets/sounds/violino/A4_Violino.mp3": "c4193338a7eb049c803319825c272b45",
"assets/assets/sounds/violino/B4_Violino.mp3": "cb00c08844592dd617a63a599db01db8",
"assets/assets/sounds/violino/C24_Violino.mp3": "e2d55ea95488658c317500f47a35e7cc",
"assets/assets/sounds/violino/C4_Violino.mp3": "e89d7aa5758507fbdaacf0cb9cf4fcf5",
"assets/assets/sounds/violino/D24_Violino.mp3": "1e73b0a6b64b6bc014ed446b4034582e",
"assets/assets/sounds/violino/D4_Violino.mp3": "56ecfd623151cbc9ecf1e78254dd3131",
"assets/assets/sounds/violino/E4_Violino.mp3": "6698573bcb0b8009d8e1c35e52c62389",
"assets/assets/sounds/violino/F24_Violino.mp3": "f9170e3752186cbaa7225c97179468e5",
"assets/assets/sounds/violino/F4_Violino.mp3": "056ae4b91e8802fb4c02eda4f3c7f0cc",
"assets/assets/sounds/violino/G4_Violino.mp3": "0c64a7305dcc23a49c39c22020a7db13",
"assets/FontManifest.json": "dc3d03800ccca4601324923c0b1d6d57",
"assets/fonts/MaterialIcons-Regular.otf": "675ba8b19dae1dce0dcf28f58f39d923",
"assets/NOTICES": "78039d809cdce5703c5d27a18183c4ae",
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
"favicon.png": "0e4c9f6f51f6e7d9fb79b458d54c7504",
"flutter.js": "76f08d47ff9f5715220992f993002504",
"flutter_bootstrap.js": "77ef69918998776e59e3bc0a5ec397ec",
"icons/Icon-192.png": "37eee64908c451e61b4a30ffef3daae5",
"icons/Icon-512.png": "9472d975433aa122bd089c2157e7e8d9",
"icons/Icon-maskable-192.png": "37eee64908c451e61b4a30ffef3daae5",
"icons/Icon-maskable-512.png": "9472d975433aa122bd089c2157e7e8d9",
"index.html": "462ebfe26459428cea589ed609d9f8b4",
"/": "462ebfe26459428cea589ed609d9f8b4",
"main.dart.js": "995d169164c4a90c5e382ceecef604f7",
"manifest.json": "ab0214c85c55fc45bf17f87f9e8103f6",
"version.json": "46145764b7b46f4ccb2dbac9fc02f4fe"};
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
