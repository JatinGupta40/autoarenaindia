flag = false;
document.querySelector('.hamburger').addEventListener('click', () => {
  if (!flag) 
  {
    // Toggle/click to open.
    document.querySelector('.hamburger').classList.add('hamburgertogglemenu');
    document.querySelector('.searchHam').classList.add('searchHamburger');
    document.querySelector('.hamburgerfooter').classList.add('hamburgerFooter');
    flag = true;
  }
  else
  {
    // Toggle/click to close.
    document.querySelector('.hamburger').classList.remove('hamburgertogglemenu');
    document.querySelector('.searchHam').classList.remove('searchHamburger');
    document.querySelector('.hamburgerfooter').classList.remove('hamburgerFooter');
    flag = false;
  }
});
