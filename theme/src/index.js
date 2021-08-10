import { createApp } from 'vue'
import App from './components/App.vue'

const app = createApp(App)
app.config.globalProperties.asset = (asset) => `${wpParams.templateDir}/assets/${asset}`
app.mount('#app')
