if (!window._babelPolyfill) {
    window._babelPolyfill = require('babel-polyfill');
}

window.Vue = require('vue');
window.axios = require('axios');
window._ = require("lodash");

import { cacheAdapterEnhancer, throttleAdapterEnhancer } from 'axios-extensions';

window.http = axios.create({
	baseURL: '/',
	headers: { 'Cache-Control': 'no-cache' },
	adapter: throttleAdapterEnhancer(axios.defaults.adapter, { threshold: 2 * 1000 })
});

require('./load-components')

import {VueMasonryPlugin} from 'vue-masonry';
Vue.use(VueMasonryPlugin)

import PortalVue from 'portal-vue';
Vue.use(PortalVue);

import VueParallaxJs from 'vue-parallax-js'
Vue.use(VueParallaxJs)

import VueLazyload from 'vue-lazyload';
Vue.use(VueLazyload, {
    preLoad: 1.1,
    error: '',
    loading: '',
    attempt: 1
})

import vueScrollto from 'vue-scrollto'
Vue.use(vueScrollto, {
    container: "body",
    duration: 1000,
    easing: "ease",
    offset: -90,
    force: true,
    cancelable: true,
    onStart: false,
    onDone: false,
    onCancel: false,
    x: false,
    y: true
})

const app = new Vue({
    el: '#app',

    data: {
        clientHeight: 0,
        windowHeight: 0,
        windowWidth: 0,
        isScrolling: false,
        scrollPosition: 0,
        footerStuck: false,
        playMenuOpen: false,
        galleryIsOpen: false,
        mounted: false
    },

    methods: {
        handleScroll () {
            this.scrollPosition = window.scrollY;
            this.isScrolling = this.scrollPosition > 40;
        },
        toggleplayMenu() { 
            this.playMenuOpen = ! this.playMenuOpen;
        },
        openGallery() {
            this.galleryIsOpen = true;
        },
        closeGallery() {
            this.galleryIsOpen = false;
        }
    },

    mounted () {
        this.footerStuck = window.innerHeight > this.$root.$el.children[0].clientHeight;
        this.clientHeight = this.$root.$el.children[0].clientHeight;
        this.windowHeight = window.innerHeight;
        this.windowWidth = window.innerWidth;
        this.handleScroll();
        this.mounted = true;
    },

    created () {
        window.addEventListener('scroll', this.handleScroll);
    },

    destroyed () {
        window.removeEventListener('scroll');
    }

})
