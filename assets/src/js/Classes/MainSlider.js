class MainSlider {
  constructor(sliderClass, slideClass, captionsClass, navigationClass, tilesClass, numberClass) {
    this.sliderClass = sliderClass
    this.slideClass = slideClass
    this.captionsClass = captionsClass
    this.navigationClass = navigationClass
    this.navigationButtons = document.querySelector(`.${this.navigationClass}`).children
    this.tilesClass = tilesClass
    this.numberDiv = document.querySelector(`.${numberClass}`)
    this.swiper

    $(document).ready(() => {
      this.initSwiper(this.sliderClass)
      this.initCaptionsSlider(document.querySelector(`.${this.captionsClass}`).children)
    })
  }

  initSwiper(sliderClass) {
    this.swiper = new Swiper (`.${sliderClass}`, {
      // Optional parameters
      slideClass: this.slideClass,
  
      // If we need pagination
      pagination: {
        el: `.${this.tilesClass}`,
        bulletClass: this.tilesClass.slice(0, -1),
        bulletActiveClass: 'active',
        clickable: true,
      },

      // Navigation arrows
      navigation: {
        nextEl: this.navigationButtons[1],
        prevEl: this.navigationButtons[0],
        disabledClass: 'disable'
      },
    })
  }

  initCaptionsSlider(captions) {
    this.swiper.on('slideChange', () => {
      let currentIndex = this.swiper.realIndex
      let lastIndex = this.swiper.previousIndex
      captions[lastIndex].classList.remove('active')
      captions[currentIndex].className += ' active'
      TweenMax.fromTo(captions[lastIndex], 0.3, {autoAlpha: 1, scale: 1}, {autoAlpha: 0, scale: 0.8, ease: Power2.easeInOut});
      TweenMax.fromTo(captions[currentIndex], 0.3, {autoAlpha: 0, scale: 0.8}, {autoAlpha: 1, scale: 1, ease: Power2.easeInOut});

      this.changeNumber(currentIndex+1)
    });
  }

  changeNumber(index) {
    this.numberDiv.innerHTML = index
  }
}

module.exports = MainSlider