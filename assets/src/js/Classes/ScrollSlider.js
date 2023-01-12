class ScrollSlider {
  constructor(debug, container, sliderId, slideClass, captionsClass, duration) {
    this.debug = debug
    this.trigger = document.querySelector(`#${container}`)
    this.sliderId = sliderId
    this.slideClass = slideClass
    this.captionsClass = captionsClass
    this.totalDuration = duration

    this.headerHeight
    this.controller
    this.scenes = []

      if (typeof window.orientation !== 'undefined') {
        $(document).ready(() => {
          this.trigger.className += 'mobile'

          this.initSwiper(this.sliderId)
          this.initCaptionsSlider(document.querySelector(`.${this.captionsClass}`).children)
        })
      }
      else {
        this.initScrollMagic()
      }
  }

  initScrollMagic() {
    this.controller = new ScrollMagic.Controller();

    this.initGlobalScene(this.controller, this.trigger, document.querySelector(`#${this.sliderId}`), this.totalDuration, document.querySelector(`.${this.captionsClass}`).children)
    this.initSlidesScenes(this.controller, this.trigger, this.totalDuration, document.querySelectorAll(`.${this.slideClass}`), document.querySelector(`.${this.captionsClass}`).children)
  }

  initGlobalScene(controller, trigger, pin, totalDuration, captions) {
    this.headerHeight = document.querySelector('header.site-header').offsetHeight

    let scene = new ScrollMagic.Scene({
      triggerElement: trigger,
      duration: totalDuration,
      triggerHook: 'onLeave',
      offset: -(this.headerHeight),
    })
    .on('enter', (event) => {
      captions[0].classList.remove('stay-active')
      captions[captions.length-1].classList.remove('stay-active')
    })
    .on('leave', (event) => {
      if(event.state == 'BEFORE') {
        captions[0].className += ' stay-active'
      }
      else if(event.state == 'AFTER') {
        captions[captions.length-1].className += ' stay-active'
      }
    })
    .setPin(pin)

    if(this.debug) {
      scene.addIndicators({name: `scene global`})
    }
    
    scene.addTo(controller)
    this.scenes.push(scene)
  }

  initSlidesScenes(controller, trigger, totalDuration, slides, captions) {
    let duration = totalDuration / (slides.length-1)
    slides.forEach((slide, index) => {

      if (index !== 0){
        let timeline = new TimelineMax()
        let tween = TweenMax.to(slide, 1, {className: "+=active", ease: Power3.easeIn})

        timeline
          .add(tween, 0)

        if (slides[index-1]) {
          let tween2
          if (slide !== slides[slides.length]) {
            tween2 = TweenMax.to(slides[index-1], 1, {className: "+=left", ease: Power1.easeOut})
          }
          else {
            tween2 = TweenMax.to(slides[index-1], 1, {className: "+=left", ease: Power3.easeOut})
          }
          
          timeline
            .add(tween2, 0)
        }

        if (slides[index+2]) {
          let tween3 = TweenMax.to(slides[index+2], 1, {className: "-=left", ease: Power3.easeIn})
          
          timeline
            .add(tween3, 0)
        }

        let scene = new ScrollMagic.Scene({
          triggerElement: trigger,
          duration: duration,
          triggerHook: 'onLeave',
          offset: ((index-1) * duration) - this.headerHeight,
        })
        .on('enter', (event) => {
        })
        .on('leave', (event) => {
          if (event.scrollDirection == 'FORWARD') {
            captions[index].classList.add('active')
            captions[index-1].classList.remove('active')
          }
          else {
            captions[index-1].classList.add('active')
            captions[index].classList.remove('active')
          }
        })
        .setTween(timeline)

        if(this.debug) {
          scene.addIndicators({name: `scene ${index}`})
        }
        
        scene.addTo(controller)
        this.scenes.push(scene)
      }
    })
  }

  initSwiper(sliderId) {
    this.swiper = new Swiper (`#${sliderId}`, {
      // Optional parameters
      slideClass: this.slideClass,
      slideActiveClass: 'active',
      slidesPerView: 'auto',
      //centeredSlides: true,
      spaceBetween: 25,
  
      scrollbar: {
        el: '.slideScroll__scrollbar',
        hide: false,
      },
    })
  }

  initCaptionsSlider(captions) {
    this.swiper.on('slideChange', () => {
      let currentIndex = this.swiper.realIndex
      let lastIndex = this.swiper.previousIndex
      captions[lastIndex].classList.remove('active')
      captions[currentIndex].className += ' active'
      // TweenMax.fromTo(captions[lastIndex], 0.3, {autoAlpha: 1, scale: 1}, {autoAlpha: 0, scale: 0.8, ease: Power2.easeInOut});
      // TweenMax.fromTo(captions[currentIndex], 0.3, {autoAlpha: 0, scale: 0.8}, {autoAlpha: 1, scale: 1, ease: Power2.easeInOut});
    });
  }
}

module.exports = ScrollSlider