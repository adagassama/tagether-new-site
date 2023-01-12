class Header {
  constructor(container) {
    this.header = container
    this.trigger = container.querySelector('.site-header__nav-trigger')
    this.wrapper = container.querySelector('.site-header__wrapper')

    this.trigger.addEventListener('click', (e) => {
      this.toggleVisibility()
    })
  }

  toggleVisibility() {
    this.wrapper.classList.toggle('site-header__wrapper--hide')
    this.trigger.classList.toggle('open')
  }
  
}

module.exports = Header