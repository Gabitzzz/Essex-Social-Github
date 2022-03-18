require('./bootstrap');



import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()


InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 10,

    // The color of the progress bar.
    color: '#000000',

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: true,
})


// Vue.mixin({
//     methods: {
//         route: window.route,
//         isRoute(...routes) {
//             return routes.some(route => this.route().current(route))
//         }
//     }
// })


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});






InertiaProgress.init({ color: '#4B5563' });


