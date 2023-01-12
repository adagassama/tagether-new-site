$(document).ready( () => {
  if (document.querySelector('.newsletter')) {
    let $form = $('.newsletter')
    if ($form.length > 0) {
      let button = $('form input[type="submit"]')
      button.bind('click', function (event) {
        if (event) event.preventDefault()
        register($form, $(this))
      })
    }
  }
})

function register(form, button) {
  button.val('En cours d\'envoi...')
  $.ajax({
    type: form.attr('method'),
    url: form.attr('action'),
    data: form.serialize(),
    cache: false,
    dataType: 'json',
    contentType: 'application/json; charset=utf-8',
    error: (err) => {
      // Error
      // console.log(err)
      button.parents('.newsletter__form')[0].querySelector('.newsletter__message').innerHTML = 'Une erreur est survenue, veuillez réessayer plus tard ou nous contacter.'
    },
    success: (data) => {
      button.val('Confirmer')
      if (data.result === 'success') {
        // Success
        button.parents('.newsletter__form')[0].querySelector('.newsletter__message').innerHTML = 'Vous êtes désormais abonné à notre newsletter.'
      } else {
        // Error
        // console.log(data.msg)
        button.parents('.newsletter__form')[0].querySelector('.newsletter__message').innerHTML = 'Une erreur est survenue, veuillez réessayer plus tard ou nous contacter.'
      }
    }
  })
}