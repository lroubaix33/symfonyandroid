/**
 * Copyright 2016 Google Inc. All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
*/

// DO NOT EDIT THIS GENERATED OUTPUT DIRECTLY!
// This file should be overwritten as part of your build process.
// If you need to extend the behavior of the generated service worker, the best approach is to write
// additional code and include it using the importScripts option:
//   https://github.com/GoogleChrome/sw-precache#importscripts-arraystring
//
// Alternatively, it's possible to make changes to the underlying template file and then use that as the
// new base for generating output, via the templateFilePath option:
//   https://github.com/GoogleChrome/sw-precache#templatefilepath-string
//
// If you go that route, make sure that whenever you update your sw-precache dependency, you reconcile any
// changes made to this original template file with your modified copy.

// This generated service worker JavaScript will precache your site's resources.
// The code needs to be saved in a .js file at the top-level of your site, and registered
// from your pages in order to be used. See
// https://github.com/googlechrome/sw-precache/blob/master/demo/app/js/service-worker-registration.js
// for an example of how you can register this script and handle various service worker events.

/* eslint-env worker, serviceworker */
/* eslint-disable indent, no-unused-vars, no-multiple-empty-lines, max-nested-callbacks, space-before-function-paren, quotes, comma-spacing */
'use strict';

var precacheConfig = [
  ["/build/css/base-page.css","840d6091a0bc35224e6755da0eb70d2f"],
  ["/build/css/base-page.js","909b8c50bb6e2793745aaf7331d7222c"],
  ["/build/css/connexion-page.css","6fb3fa3cb2be7fbc841cc47f905ef30b"],
  ["/build/css/connexion-page.js","d14c0ff8a9738ee9b5f4c80b557252f5"],
  ["/build/css/home-page.css","721ddb98d4536dad4a85d807c2e0be67"],
  ["/build/css/home-page.js","5a3ca9cc34c8d0ba045730fe29f23437"],
  ["/build/css/qcm-page.css","e72b64b6c4f847065105d27a10875bde"],
  ["/build/css/qcm-page.js","28b9f766665ea5d6b20d5fee7c594d6e"],
  ["/build/css/user-page.css","fdbf0b2c939166564871ca185c98d851"],
  ["/build/css/user-page.js","ea21c786a18f740b8a3a1edd3f451e6f"],
  ["/build/js/category-page.js","85f08f0c4e950f2035cdf740ba50c898"],
  ["/build/js/user-page.js","96be642a725f129daf329e16330f802f"],
  ["/bundles/fosjsrouting/js/router.js","c4ba2ecfada23a70580eff1d2aec741a"],
  ["/bundles/fosjsrouting/js/router.min.js","f40269ad5b7d10d9b28816b63097ded7"],
  ["/images-icons/icons/material-icon.png","782f2cc6a81cf3b6268e4ba90d3ce89e"],
  ["/images-icons/icons/rsz_cat-mat.png","809b959ace8d3416b69de81412cabf93"],
  ["/images-icons/icons/rsz_category-icon.png","4caa077b9227de538f6c2462e878209b"],
  ["/images-icons/icons/rsz_facebook-icon.png","ba24a4ac925d46c3bef4ba4e99c8d038"],
  ["/images-icons/icons/rsz_form-icon.png","d1ff542fce121ca7bc323ba4336a3933"],
  ["/images-icons/icons/rsz_icon-dev.png","dac8f94ec32369e6716bd978f968ee5a"],
  ["/images-icons/icons/rsz_if_linkedin_287553.png","e5cea9ef2b790510691d03ddcaf67475"],
  ["/images-icons/icons/rsz_instagram-new-flat.png","7d4514d84b591fe2d5f47186619923fd"],
  ["/images-icons/icons/rsz_twitter-icon.png","25f11a9cbf0edc06a6e310b40b8de4d6"],
  ["/images-icons/icons/users-icon.png","707fca34ddbee6f6c24a6b7a456b565f"],
  ["templates/base.html.twig","9ba4a3b30468c059614de1eb3d3d3646"],
  ["templates/connexion/connexion.html.twig","0884c82ade2c024813a302eb0e57a1bf"],
  ["templates/connexion/register.html.twig","df4362b2409faa22f323112f874c0981"],
  ["templates/cv/cv.html.twig","085d30fc62926b9301aecf0615a6bf49"],
  ["templates/form/form_connexion.html.twig","d7fe44dc00682fd63bcb02c068d0b20c"],
  ["templates/gestion_materiel/attribloaning.html.twig","79e4b219b44c4520dbbe2d82b82c4d82"],
  ["templates/gestion_materiel/category.html.twig","bbf9e09ca934a95eb38215740ad21a03"],
  ["templates/gestion_materiel/catmat.html.twig","3e91f6e21d66829c2596d93603150d88"],
  ["templates/gestion_materiel/editcategory.html.twig","4dc602ea3a7416ca94a08aca2f2d976f"],
  ["templates/gestion_materiel/editmaterial.html.twig","c23a8b7bbd26b8105b934b2409abe579"],
  ["templates/gestion_materiel/edituser.html.twig","93ac00e34f14e23522a17aec53a6ba5f"],
  ["templates/gestion_materiel/loaningback.html.twig","394d9db83a116aa51676bc024a251a7c"],
  ["templates/gestion_materiel/materiel.html.twig","845b66890efaa162c11a1cdabd4cf00b"],
  ["templates/gestion_materiel/newcategory.html.twig","daadb3c7ce5036ffccb3fff5b0701946"],
  ["templates/gestion_materiel/newmaterial.html.twig","3d6240626ea5cdaf623cbab9b07e4d26"],
  ["templates/gestion_materiel/newuser.html.twig","9ba08547d1eee631c9f264138e56d25c"],
  ["templates/gestion_materiel/user.html.twig","8b72f59aa48f98dcebb240a22871af6c"],
  ["templates/home_page/home_page.html.twig","a6e13e1e0a07329c468624a74c3bdffa"],
  ["templates/modal/delete_categ_modal.html.twig","a86afef2290faf8370cc694db3581afb"],
  ["templates/qcm_cloud/qcmcloud.html.twig","b9c24f3f5f017d187757139937efc15e"]
];

var cacheName = 'sw-precache-v3--' + (self.registration ? self.registration.scope : '');


var ignoreUrlParametersMatching = [/^utm_/];



var addDirectoryIndex = function (originalUrl, index) {
    var url = new URL(originalUrl);
    if (url.pathname.slice(-1) === '/') {
      url.pathname += index;
    }
    return url.toString();
  };

var cleanResponse = function (originalResponse) {
    // If this is not a redirected response, then we don't have to do anything.
    if (!originalResponse.redirected) {
      return Promise.resolve(originalResponse);
    }

    // Firefox 50 and below doesn't support the Response.body stream, so we may
    // need to read the entire body to memory as a Blob.
    var bodyPromise = 'body' in originalResponse ?
      Promise.resolve(originalResponse.body) :
      originalResponse.blob();

    return bodyPromise.then(function(body) {
      // new Response() is happy when passed either a stream or a Blob.
      return new Response(body, {
        headers: originalResponse.headers,
        status: originalResponse.status,
        statusText: originalResponse.statusText
      });
    });
  };

var createCacheKey = function (originalUrl, paramName, paramValue,
                           dontCacheBustUrlsMatching) {
    // Create a new URL object to avoid modifying originalUrl.
    var url = new URL(originalUrl);

    // If dontCacheBustUrlsMatching is not set, or if we don't have a match,
    // then add in the extra cache-busting URL parameter.
    if (!dontCacheBustUrlsMatching ||
        !(url.pathname.match(dontCacheBustUrlsMatching))) {
      url.search += (url.search ? '&' : '') +
        encodeURIComponent(paramName) + '=' + encodeURIComponent(paramValue);
    }

    return url.toString();
  };

var isPathWhitelisted = function (whitelist, absoluteUrlString) {
    // If the whitelist is empty, then consider all URLs to be whitelisted.
    if (whitelist.length === 0) {
      return true;
    }

    // Otherwise compare each path regex to the path of the URL passed in.
    var path = (new URL(absoluteUrlString)).pathname;
    return whitelist.some(function(whitelistedPathRegex) {
      return path.match(whitelistedPathRegex);
    });
  };

var stripIgnoredUrlParameters = function (originalUrl,
    ignoreUrlParametersMatching) {
    var url = new URL(originalUrl);
    // Remove the hash; see https://github.com/GoogleChrome/sw-precache/issues/290
    url.hash = '';

    url.search = url.search.slice(1) // Exclude initial '?'
      .split('&') // Split into an array of 'key=value' strings
      .map(function(kv) {
        return kv.split('='); // Split each 'key=value' string into a [key, value] array
      })
      .filter(function(kv) {
        return ignoreUrlParametersMatching.every(function(ignoredRegex) {
          return !ignoredRegex.test(kv[0]); // Return true iff the key doesn't match any of the regexes.
        });
      })
      .map(function(kv) {
        return kv.join('='); // Join each [key, value] array into a 'key=value' string
      })
      .join('&'); // Join the array of 'key=value' strings into a string with '&' in between each

    return url.toString();
  };


var hashParamName = '_sw-precache';
var urlsToCacheKeys = new Map(
  precacheConfig.map(function(item) {
    var relativeUrl = item[0];
    var hash = item[1];
    var absoluteUrl = new URL(relativeUrl, self.location);
    var cacheKey = createCacheKey(absoluteUrl, hashParamName, hash, false);
    return [absoluteUrl.toString(), cacheKey];
  })
);

function setOfCachedUrls(cache) {
  return cache.keys().then(function(requests) {
    return requests.map(function(request) {
      return request.url;
    });
  }).then(function(urls) {
    return new Set(urls);
  });
}

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(cacheName).then(function(cache) {
      return setOfCachedUrls(cache).then(function(cachedUrls) {
        return Promise.all(
          Array.from(urlsToCacheKeys.values()).map(function(cacheKey) {
            // If we don't have a key matching url in the cache already, add it.
            if (!cachedUrls.has(cacheKey)) {
              var request = new Request(cacheKey, {credentials: 'same-origin'});
              return fetch(request).then(function(response) {
                // Bail out of installation unless we get back a 200 OK for
                // every request.
                if (!response.ok) {
                  throw new Error('Request for ' + cacheKey + ' returned a ' +
                    'response with status ' + response.status);
                }

                return cleanResponse(response).then(function(responseToCache) {
                  return cache.put(cacheKey, responseToCache);
                });
              });
            }
          })
        );
      });
    }).then(function() {
      
      // Force the SW to transition from installing -> active state
      return self.skipWaiting();
      
    })
  );
});

self.addEventListener('activate', function(event) {
  var setOfExpectedUrls = new Set(urlsToCacheKeys.values());

  event.waitUntil(
    caches.open(cacheName).then(function(cache) {
      return cache.keys().then(function(existingRequests) {
        return Promise.all(
          existingRequests.map(function(existingRequest) {
            if (!setOfExpectedUrls.has(existingRequest.url)) {
              return cache.delete(existingRequest);
            }
          })
        );
      });
    }).then(function() {
      
      return self.clients.claim();
      
    })
  );
});


self.addEventListener('fetch', function(event) {
  if (event.request.method === 'GET') {
    // Should we call event.respondWith() inside this fetch event handler?
    // This needs to be determined synchronously, which will give other fetch
    // handlers a chance to handle the request if need be.
    var shouldRespond;

    // First, remove all the ignored parameters and hash fragment, and see if we
    // have that URL in our cache. If so, great! shouldRespond will be true.
    var url = stripIgnoredUrlParameters(event.request.url, ignoreUrlParametersMatching);
    shouldRespond = urlsToCacheKeys.has(url);

    // If shouldRespond is false, check again, this time with 'index.html'
    // (or whatever the directoryIndex option is set to) at the end.
    var directoryIndex = 'index.html';
    if (!shouldRespond && directoryIndex) {
      url = addDirectoryIndex(url, directoryIndex);
      shouldRespond = urlsToCacheKeys.has(url);
    }

    // If shouldRespond is still false, check to see if this is a navigation
    // request, and if so, whether the URL matches navigateFallbackWhitelist.
    var navigateFallback = '';
    if (!shouldRespond &&
        navigateFallback &&
        (event.request.mode === 'navigate') &&
        isPathWhitelisted([], event.request.url)) {
      url = new URL(navigateFallback, self.location).toString();
      shouldRespond = urlsToCacheKeys.has(url);
    }

    // If shouldRespond was set to true at any point, then call
    // event.respondWith(), using the appropriate cache key.
    if (shouldRespond) {
      event.respondWith(
        caches.open(cacheName).then(function(cache) {
          return cache.match(urlsToCacheKeys.get(url)).then(function(response) {
            if (response) {
              return response;
            }
            throw Error('The cached response that was expected is missing.');
          });
        }).catch(function(e) {
          // Fall back to just fetch()ing the request if some unexpected error
          // prevented the cached response from being valid.
          console.warn('Couldn\'t serve response for "%s" from cache: %O', event.request.url, e);
          return fetch(event.request);
        })
      );
    }
  }
});







