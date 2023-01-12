class TextSlider {
  constructor(textSliderClass, captionSliderClass) {
    this.textSliderClass = textSliderClass
    this.captionSliderClass = captionSliderClass
    this.timeline
    this.duration = .3
    this.delay = 8
    this.currentIndex = 0
    
    this.resizeParents()
    this.initTimeline()
    this.initSlider(document.querySelector(`.${this.textSliderClass}`).children)
  }

  initSlider(textSlides) {
    this.timeline
    .add(TweenMax.staggerTo(
      textSlides, this.duration,
      {
        css:{className:'+=active'},
        ease:Circ.easeInOut,
        onComplete: () => {
          this.showCaptionsSlider(document.querySelector(`.${this.captionSliderClass}`).children)
        },
      },
      this.delay
    ))
    .add(TweenMax.staggerTo(
      textSlides, this.duration,
      {
        delay: this.duration,
        css:{className:'+=leave'},
        ease:Circ.easeInOut,
        onComplete: () => {
          this.hideCaptionsSlider(document.querySelector(`.${this.captionSliderClass}`).children)
        },
      },
      this.delay
    ), this.delay-1)
  }

  initTimeline() {
    this.timeline = new TimelineLite({
      onComplete: () => {
        setTimeout(() => {
          this.timeline.restart()
        }, (this.duration))
      }
    })
  }

  showCaptionsSlider(captions) {
    captions[this.currentIndex].className += ' active'
    TweenMax.fromTo(captions[this.currentIndex], 0.3, {autoAlpha: 0, scale: 0.8, y: '50'}, {autoAlpha: 1, scale: 1, y: '0', ease: Power2.easeInOut})
  }

  hideCaptionsSlider(captions) {
    captions[this.currentIndex].classList.remove('active')
    TweenMax.fromTo(captions[this.currentIndex], 0.3, {autoAlpha: 1, scale: 1, y: '0'}, {autoAlpha: 0, scale: 0.8, y: '-50', ease: Power2.easeInOut})
    this.incrementIndex()
  }

  incrementIndex() {
    this.currentIndex = (this.currentIndex + 1) % (document.querySelector(`.${this.captionSliderClass}`).children.length)
  }

  resizeParents() {
    document.querySelector(`.${this.textSliderClass}`).style.minWidth = this.getMaxWidthChildren(`.${this.textSliderClass}`)+'px'
    document.querySelector(`.${this.textSliderClass}`).style.minHeight = this.getMaxHeightChildren(`.${this.textSliderClass}`)+'px'
    document.querySelector(`.${this.captionSliderClass}`).style.minHeight = this.getMaxHeightChildren(`.${this.captionSliderClass}`)+'px'
  }

  getMaxWidthChildren(parentClass) {
    return Math.max.apply(Math, $(parentClass).children().map(function(){ return $(this).outerWidth() }).get())
  }

  getMaxHeightChildren(parentClass) {
    return Math.max.apply(Math, $(parentClass).children().map(function(){ return $(this).outerHeight() }).get())
  }
}

module.exports = TextSlider