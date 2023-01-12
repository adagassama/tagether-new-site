class PricesFeatures {
  constructor(wrapper, featuresItem, separator, img) {
    this.wrapper = document.querySelector(`.${wrapper}`)
    this.trigger = this.wrapper.querySelectorAll('.features__options__title')
    this.item = this.wrapper.querySelectorAll(`.${featuresItem}`)
    this.separator = this.wrapper.querySelector(`.${separator}`)
    this.img = this.wrapper.querySelectorAll(`.${img}`)

    this.trigger.forEach((element) => {
      element.addEventListener('click', () => {
        if (element.classList.contains('feature--active')) {
         return false
        } else{
          this.toggleVisibility()
        }
      })
    })
  }

  toggleVisibility(){

    // Displaying features list item
    this.item.forEach(function (element) {
      element.classList.toggle('feature--active')
    })

    // Displaying feature title
    this.trigger.forEach(function (element) {
      element.classList.toggle('feature--active')
    })
    
    // Animation for the separator
    this.separator.classList.toggle('separator--active')

    // Displaying images
    this.img.forEach(function (element) {
      element.classList.toggle('mockup--active')
    })
  }
}

module.exports = PricesFeatures