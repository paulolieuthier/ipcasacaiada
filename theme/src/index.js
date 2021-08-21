import { createApp } from 'vue'
import { ApolloClient, createHttpLink, InMemoryCache } from '@apollo/client/core'
import { createApolloProvider } from '@vue/apollo-option'
import App from './components/App.vue'


// wpParams is set in functions.php

const apolloProvider = createApolloProvider({
  defaultClient: new ApolloClient({
    link: createHttpLink({ uri: `/graphql` }),
    cache: new InMemoryCache(),
  }),
})

const app = createApp(App)
app.config.globalProperties.asset = (asset) => `${wpParams.templateDir}/assets/${asset}`
app.use(apolloProvider)
app.mount('#app')
