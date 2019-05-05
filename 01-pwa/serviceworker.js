const version = 'v3';

self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open(version)
            .then(function (cache) {
                return cache.addAll([
                    '/',
                    '/index.php',
                    '/process.php',
                    '/recommendations.php',
                    '/assets/bootstrap/css/bootstrap.min.css',
                    '/assets/bootstrap/js/bootstrap.min.js',
                    '/assets/images/white-roses-photo-wallpaper-1920x1200.jpg',
                    '/assets/images/3022cf58cbc1c5a01de004e504d16ad8-128x128.png',
                    '/assets/mobirise/css/mbr-additional.css',
                    '/assets/theme/css/style.css',
                    '/assets/theme/js/script.js'
                ]);
            }));
});

self.addEventListener('activate', function (event) {
    event.waitUntil(
        console.log('Activated SW')
    )
});

self.addEventListener('fetch', function (event) {
    event.respondWith(fetch(event.request)
        .catch(function (error) {
            return caches.open(version)
                .then(function (cache) {
                    return cache.match(event.request);
                })
        }).then(function (data) {
            if (data === undefined) {
                data = caches.open(version)
                    .then(function (cache) {
                        return cache.match('/offline')
                    })
            }
            return data;
        }));

    event.respondWith(
        caches.match(event.request)
            .then(function (res) {
                if (res) {
                    return res;
                }
                if (!navigator.onLine) {
                    return caches.match(new Request('/offline'));
                }
                return fetchAndUpdate(event.request);
            }));

});

function fetchAndUpdate(request) {
    if (request.method === 'GET') {
        return fetch(request)
            .then(function (res) {
                if (res) {
                    return caches.open(version)
                        .then(function (cache) {
                            return cache.put(request, res.clone())
                                .then(function () {
                                    return res;
                                });
                        });
                }
            });
    } else {
        return fetch(request, {headers: {'Cache-Control': 'no-cache'}});
    }
}
