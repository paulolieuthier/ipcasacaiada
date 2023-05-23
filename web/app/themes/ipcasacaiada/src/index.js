import * as Vue from 'vue'
import * as VueRouter from 'vue-router'
import * as Apollo from '@apollo/client/core'
import { DefaultApolloClient } from '@vue/apollo-composable'

import App from './components/App.vue'
import Home from './components/Home.vue'
import Page from './components/Page.vue'
import SermonSerie from './components/sermons/Serie.vue'
import SermonSeries from './components/sermons/Series.vue'

var app = Vue.createApp(App)

const apolloClient = new Apollo.ApolloClient({
  link: Apollo.createHttpLink({ uri: '/wp/graphql' }),
  cache: new Apollo.InMemoryCache(),
})

const router = VueRouter.createRouter({
  history: VueRouter.createWebHistory(),
  routes: [
    { path: '/', component: Home, },
    { path: '/sermoes/series', component: SermonSeries },
    { path: '/sermoes/series/:serie', component: SermonSerie, props: true },
    { path: '/ministerio/:uri+', component: Page, props: true, },
    { path: '/:uri+', component: Page, props: true, },
  ],
  scrollBehavior(to, _, savedPosition) {
    return new Promise(resolve => {
      app.once('pageLoaded', () => {
        if (savedPosition) {
          return resolve(savedPosition)
        }

        if (to.hash) {
          // timer was needed to get consistent behaviour
          // maybe vue-router scrolling to hash works after
          // https://github.com/vuejs/vue-router/pull/3592 ?
          // return resolve({ selector: to.hash, behavior: 'smooth' })
          return setTimeout(() => document.querySelector(to.hash)?.scrollIntoView(), 100)
        }

        // timer was needed to get consistent behaviour
        setTimeout(() => resolve({ left: 0, top: 0 }), 50)
      })
    })
  }
})

var app = Vue.createApp(App)
  .use(router)
  .provide(DefaultApolloClient, apolloClient)
  .mount('#app')
