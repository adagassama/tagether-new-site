class SocialShare {
  constructor(wrapper, socialNav) {
    this.wrapper = document.querySelector(`.${wrapper}`)
    this.socialNav = document.querySelector(`.${socialNav}`)
    this.totalDuration = this.wrapper.offsetHeight - this.socialNav.offsetHeight;

    this.controller
    this.scenes = []
    this.debug = false;

    this.initScrollMagic()
  }

  initScrollMagic() {
    this.controller = new ScrollMagic.Controller();

    this.initScene(this.wrapper, this.socialNav, this.totalDuration)
  }

  initScene(trigger, pin, totalDuration) {
    this.headerHeight = document.querySelector('header.site-header').offsetHeight

    let scene = new ScrollMagic.Scene({
      triggerElement: trigger,
      duration: totalDuration,
      triggerHook: 'onLeave',
      offset: -(this.headerHeight)-45,
    })
    .setPin(pin)

    if(this.debug) {
      scene.addIndicators({name: `scene global`})
    }
    
    scene.addTo(this.controller)
    this.scenes.push(scene)
  }

}

module.exports = SocialShare