// // Give the service worker access to Firebase Messaging.
// // Note that you can only use Firebase Messaging here. Other Firebase libraries
// // are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
// importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
// importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
// /*
// Initialize the Firebase app in the service worker by passing in the messagingSenderId.
// */
// firebase.initializeApp({
//         apiKey: "AIzaSyAPcn5Iv4h5N0aMHlWVpBW8pehPKqhdLvw",
//         authDomain: "resinelysium-82b20.firebaseapp.com",
//         projectId: "resinelysium-82b20",
//         storageBucket: "resinelysium-82b20.appspot.com",
//         messagingSenderId: "358781846",
//         appId: "1:358781846:web:3c13750973c0494037c3b7",
//         measurementId: "G-68SV57560L"
//     });

//     console.log(firebase);

// const messaging = firebase.messaging();
// messaging.setBackgroundMessageHandler(function (payload) {
//     console.log("Message received.", payload);
//     const title = "Hello world is awesome";
//     const options = {
//         body: "Your notificaiton message .",
//         icon: "/firebase-logo.png",
//     };
//     return self.registration.showNotification(
//         title,
//         options,
//     );
// });




  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyAPcn5Iv4h5N0aMHlWVpBW8pehPKqhdLvw",
    authDomain: "resinelysium-82b20.firebaseapp.com",
    projectId: "resinelysium-82b20",
    storageBucket: "resinelysium-82b20.appspot.com",
    messagingSenderId: "358781846",
    appId: "1:358781846:web:3c13750973c0494037c3b7",
    measurementId: "G-68SV57560L"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  console.log(app);
  const analytics = getAnalytics(app);