import * as Vue from 'vue'
import * as VueRouter from 'vue-router'
import * as Apollo from '@apollo/client/core'
import { DefaultApolloClient } from '@vue/apollo-composable'

import App from './components/App.vue'
import Home from './components/Home.vue'

const router = VueRouter.createRouter({
  history: VueRouter.createWebHistory(),
  routes: [
    { path: '/', component: Home, },
  ],
})

const apolloClient = new Apollo.ApolloClient({
  link: Apollo.createHttpLink({ uri: `/graphql` }),
  cache: new Apollo.InMemoryCache(),
})

Vue.createApp(App)
  .use(router)
  .provide(DefaultApolloClient, apolloClient)
  .mount('#app')
