class SimpleSlider {
  constructor(sliderClass, slideClass, captionsClass, tilesClass) {
    this.sliderClass = sliderClass
    this.slideClass = slideClass
    this.captionsClass = captionsClass
    this.tilesClass = tilesClass
    this.swiper
    this.lastIndex = 0;

    $(document).ready(() => {
      this.initSwiper(this.sliderClass)
      this.initCaptionsSlider(document.querySelector(`.${this.captionsClass}`).children)
    })
  }

  initSwiper(sliderClass) {
    this.swiper = new Swiper (`.${sliderClass}`, {
      // Optional parameters
      loop: true,
      slideClass: this.slideClass,
  
      // If we need pagination
      pagination: {
        el: `.${this.tilesClass}`,
        bulletClass: this.tilesClass.slice(0, -1),
        bulletActiveClass: 'active',
        clickable: true,
      },

      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },

      simulateTouch: false,
    })
  }
  
  initCaptionsSlider(captions) {
    this.swiper.on('slideChange', () => {
      let currentIndex = this.swiper.realIndex;
      if(currentIndex != this.lastIndex) {
        captions[this.lastIndex].classList.remove('active')
        captions[currentIndex].className += ' active'
        TweenMax.fromTo(captions[this.lastIndex], 0.3, {autoAlpha: 1, scale: 1, y: '0'}, {autoAlpha: 0, scale: 0.8, y: '+=50', ease: Power2.easeInOut});
        TweenMax.fromTo(captions[currentIndex], 0.3, {autoAlpha: 0, scale: 0.8, y: '+=50'}, {autoAlpha: 1, scale: 1, y: '0', ease: Power2.easeInOut});
        this.lastIndex = currentIndex
      }
    });
  }
}

module.exports = SimpleSlider