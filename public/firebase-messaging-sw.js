/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyAlwdt-UxYXtJ9mc4KCN5B6ylI9uykO03o",
    authDomain: "ddweb-9f5ff.firebaseapp.com",
    databaseURL: "https://ddweb-9f5ff.firebaseio.com",
    projectId: "ddweb-9f5ff",
    storageBucket: "ddweb-9f5ff.appspot.com",
    messagingSenderId: "73865503844",
    appId: "1:73865503844:web:9e7c94d0c44c6ef3726b71",
    measurementId: "G-ZZRY3NP782"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});
