const CACHE_NAME = 'bnpl-cache-v3'; // Changed version to force update
const ASSETS_TO_CACHE = [
  '/',
  '/login.php',
  '/assets/icons/android-icon-72.png',
  '/assets/icons/android-icon-192.png',
  '/assets/css/bootstrap.min.css',
  '/assets/css/bootstrap.rtl.min.css',
  '/assets/js/bootstrap.bundle.min.js'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        return cache.addAll(ASSETS_TO_CACHE)
          .catch((err) => {
            console.error('Failed to cache some assets:', err);
            // Even if some assets fail, continue with installation
            return Promise.resolve();
          });
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
        // Return cached response if found
        if (cachedResponse) {
          return cachedResponse;
        }

        // Otherwise fetch from network
        return fetch(event.request)
          .then((response) => {
            // Only cache successful responses
            if (response && response.status === 200) {
              const responseToCache = response.clone();
              caches.open(CACHE_NAME)
                .then((cache) => {
                  cache.put(event.request, responseToCache)
                    .catch(err => console.error('Failed to cache:', event.request.url, err));
                });
            }
            return response;
          })
          .catch(() => {
            // Optional: Return a fallback response if fetch fails
            // return caches.match('/offline.html');
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
          if (!cacheWhitelist.includes(cacheName)) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});