// Include
import './inc/mailchimp-registration'
import './inc/cookie-banner'

// Classes
import Header from './Classes/Header'
import ScrollSlider from './Classes/ScrollSlider'
import SimpleSlider from './Classes/SimpleSlider'
import MainSlider from './Classes/MainSlider'
import TextSlider from './Classes/TextSlider'
import Dropdown from './Classes/Dropdown'
import SocialShare from './Classes/SocialShare'
import PricesFeatures from './Classes/PricesFeatures'

if (document.querySelector('.site-header')) {
const header = new Header(document.querySelector('.site-header'))
}

if (document.querySelector('#slideScroll__wrapper')) {
  const scrollSlider = new ScrollSlider(
    false,
    'slideScroll__wrapper',
    'slideScroll',
    'slideScroll__slide',
    'slideScroll__captions',
    4500)
}

if (document.querySelector('.simpleSlider__wrapper')) {
  
  const simpleSlider = new SimpleSlider(
    'simpleSlider',
    'pictureSlider__slide',
    'captionSlider__slides',
    'captionSlider__tiles'
  )
}

if (document.querySelector('.mainSlider__wrapper')) {
  
  const mainSlider = new MainSlider(
    'phoneSlider',
    'phoneSlider__slide',
    'phoneSlider__captions',
    'mainSlider__arrows',
    'tileSlider',
    'mainSlider__numbers'
  )
}

if (document.querySelector('.textSlider__wrapper')) {
  
  const textSlider = new TextSlider(
    'textSlider__slides',
    'textSlider__captions'
  )
}

if (document.querySelector('.subscription-info__shopping-cart__dropdown')) {
  
  const shopping_cart_dropdown = new Dropdown(
    'dropdown-container',
    'dropdown-list',
    false
  )
}

if (document.querySelector('.article')) {
  
  const socialShare = new SocialShare(
    'article__content',
    'social-share__content',
    'article__next'
  )
}

if (document.querySelector('.prices__features__wrapper')) {

  const pricesFeatures = new PricesFeatures(
    'prices__features__wrapper',
    'features--premium',
    'features__options__separator',
    'features__mockup__img'
  )
}

if (document.querySelector('.prices__faq')) {

  const pricesFaq = new Dropdown(
    'dropdown-container',
    'dropdown-list',
    true
  )
}

if (document.querySelector('.faq')) {

  const pricesFaq = new Dropdown(
    'dropdown-container',
    'dropdown-list',
    false
  )
}