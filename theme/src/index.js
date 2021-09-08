import { createApp } from 'vue'
import { ApolloClient, createHttpLink, InMemoryCache } from '@apollo/client/core'
import { createApolloProvider } from '@vue/apollo-option'
import App from './components/App.vue'


const apolloProvider = createApolloProvider({
  defaultClient: new ApolloClient({
    link: createHttpLink({ uri: `/graphql` }),
    cache: new InMemoryCache(),
  }),
})

const app = createApp(App)
app.use(apolloProvider)
app.mount('#app')
