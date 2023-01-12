class Dropdown {
  constructor(dropdownContainerClass, dropdownClass, isAccordion) {
    this.dropdownContainerClass = dropdownContainerClass
    this.dropdownClass = dropdownClass
    this.isAccordion = isAccordion

    this.initDropdown()
  }

  initDropdown() {
    let dropdownContainers = document.querySelectorAll(`.${this.dropdownContainerClass}`)
    // let dropdowns = document.querySelectorAll(`.${this.dropdownClass}`)

    dropdownContainers.forEach((dropdownContainer) => {

      let dropdown = dropdownContainer.querySelector(`.${this.dropdownClass}`)
      this.setAllHeights(dropdown)

      dropdownContainer.addEventListener('click', () => {

        if(this.isAccordion) {
          dropdownContainers.forEach((dropdownContainerBis) => {
            if (dropdownContainerBis !== dropdownContainer) {
              dropdownContainerBis.classList.add('collapsed')
            }
          })
        }
        
        dropdownContainer.classList.toggle('collapsed')
      })
    })
  }

  setAllHeights(element) {
    let totalHeight = 0
    Array.from(element.children).forEach((child) => {
      totalHeight += child.offsetHeight
      totalHeight += parseInt(window.getComputedStyle(child).marginTop.replace('px', ''))
      totalHeight += parseInt(window.getComputedStyle(child).marginBottom.replace('px', ''))
    })
    element.style.height = `${totalHeight}px`
  }
}

module.exports = Dropdown