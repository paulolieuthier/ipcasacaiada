import { createApp, provide, h } from 'vue'
import { ApolloClient, createHttpLink, InMemoryCache } from '@apollo/client/core'
import { DefaultApolloClient } from '@vue/apollo-composable'
import App from './components/App.vue'

const apolloClient = new ApolloClient({
  link: createHttpLink({ uri: `/graphql` }),
  cache: new InMemoryCache(),
})

createApp({
  setup: () => provide(DefaultApolloClient, apolloClient),
  render: () => h(App),
})
.mount('#app')
