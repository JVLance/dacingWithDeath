import Vue from 'vue'
import Router from 'vue-router'
import Reservation from '@/components/Reservation'

import Summary from '@/components/Summary'

import About from '@/components/About'

import Bookings from '@/components/Bookings'

Vue.use(Router)

export default new Router({
    routes: [{
            path: '/',
            name: 'reservation',
            component: Reservation
        },
        {
            path: '/summary',
            name: 'summary',
            component: Summary
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/bookings',
            name: 'bookings',
            component: Bookings
        }
    ]
})