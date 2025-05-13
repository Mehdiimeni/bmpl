// service-worker.js
self.addEventListener("install", (event) => {
    event.waitUntil(
        caches.open("my-cache").then((cache) => {
            return cache.addAll([
                "./index.php",
                // دیگر فایل‌ها و منابع مورد نیاز
            ]);
        })
    );
});

self.addEventListener("fetch", (event) => {
    event.respondWith(
        caches.match(event.request).then((response) => {
            return response || fetch(event.request);
        })
    );
});


// service-worker.js
self.addEventListener('push', function(event) {
    const options = {
        body: event.data.text(),
        icon: './', // آیکون اعلان
        badge: './', // بج اعلان
        data: {
            url: '/', // مقصد پس از کلیک بر روی اعلان
        },
    };

    event.waitUntil(
        self.registration.showNotification('خوش‌آمدید!', options)
    );
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data.url)
    );
});
