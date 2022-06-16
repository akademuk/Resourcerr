const btn = document.querySelector('.read-more-btn');
const text = document.querySelector('.card__read-more');

btn.addEventListener('click', ()=>{
  console.log("clicked");
  text.classList.toggle('card__read-more--open');
btn.textContent = btn.textContent.includes('Read more') ? 'Read less' : 'Read more';
})