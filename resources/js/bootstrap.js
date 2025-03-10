/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

// console.log('Hello From bootstrap js file');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });



/** Websockets Echo */

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "MyCustomApplicationKey",
    cluster: 'eu',
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
})



// public channel


//If the event in default path just type the => event Name

//And if you wanna use the full path to the event , type (.) before the path => .App\\Events\\NewUserRegisteredEvent

//And if you use the broadcastAs Function, type (.) before the Name => .NewUserRegisteredEventCustom

window.Echo.channel(`orders`)
.listen('NewOrderPlaced', (e) => {
        console.log(e);
        $(".notifications-icon").load(" .notifications-icon > *");
        $("#notificationsModal").load(" #notificationsModal > *");
    });


// //Privet Channel

//     window.Echo.private(`new_user_channel`)

//     .listen('NewUserRegisteredEvent', (e) => {
//         console.log(e['message']);
//         $(".notifications-icon").load(" .notifications-icon > *");
//         $("#notificationsModal").load(" #notificationsModal > *");
//     }).listen('NewUserRegisteredEvent2', (e) => {
//         console.log(e['message']);
//     }) ;

//     //You can chain more than event on the same channel


