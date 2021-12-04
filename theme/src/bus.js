
export default class Bus {
  constructor() {
    this.last = {}
    this.callbacks = {}
  }

  once(event, f) {
    if (this.last[event]) {
      f()
      delete this.last[event]
      return
    }

    this.callbacks[event] = this.callbacks[event] || []
    this.callbacks[event].push(f)
  }

  emit(event) {
    if (!this.callbacks[event]?.length) {
      this.last[event] = true
      return
    }

    while (this.callbacks[event]?.length) {
      this.callbacks[event].shift()()
    }
  }
}
