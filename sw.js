const CACHE_NAME = 'bnpl-cache-v2';
const ASSETS_TO_CACHE = [
  {
    url: '/',
    revision: '1'
  },
  {
    url: '/login.php',
    revision: '1'
  },
  {
    url: '/assets/icons/android-icon-72.png',
    revision: '1'
  },
  {
    url: '/assets/icons/android-icon-192.png',
    revision: '1'
  },
  {
    url: './assets/css/bootstrap.min.css',
    revision: '5.3.0'
  },
  {
    url: './assets/css/bootstrap.rtl.min.css',
    revision: '5.3.0'
  },
  {
    url: './assets/js/bootstrap.bundle.min.js',
    revision: '5.3.0'
  }
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        const cachePromises = ASSETS_TO_CACHE.map((asset) => {
          return fetch(asset.url, { cache: 'reload', mode: 'no-cors' })
            .then((response) => {
              if (!response.ok) {
                throw new Error(`Failed to fetch ${asset.url}`);
              }
              return cache.put(asset.url, response);
            })
            .catch((err) => {
              console.warn(`Couldn't cache ${asset.url}:`, err);
            });
        });
        return Promise.all(cachePromises);
      })
  );
});

self.addEventListener('fetch', (event) => {
  if (event.request.method !== 'GET') {
    return;
  }

  event.respondWith(
    caches.match(event.request)
      .then((cachedResponse) => {
        if (cachedResponse) {
          return cachedResponse;
        }

        return fetch(event.request)
          .then((response) => {
            if (!response || response.status !== 200 || response.type !== 'basic') {
              return response;
            }

            const responseToCache = response.clone();
            caches.open(CACHE_NAME)
              .then((cache) => {
                cache.put(event.request, responseToCache);
              });

            return response;
          });
      })
  );
});

self.addEventListener('activate', (event) => {
  const cacheWhitelist = [CACHE_NAME];
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});