const links = document.querySelectorAll(' .header-menu a');

  function ativarLink(link){
    const url = location.href;
    const href = link.href;
    if (url.includes(href)){
     link.classList.add('ativo')
    }

    console.log(url);
    console.log(href);
  }

links.forEach(ativarLink);

// Animação
if(window.SimpleAnime){
  new SimpleAnime();
}
