flag = false;
document.querySelector('.searchicon').addEventListener('click', () => {
  if (!flag) 
  {
    // Toggle/click to open.
    document.querySelector('.searchicon').classList.add('hamburgertogglemenu');
    document.querySelector('.searchHam').classList.add('searchHamburger');
    document.querySelector('.hamburgerfooter').classList.add('hamburgerFooter');
    flag = true;
  }
  else
  {
    // Toggle/click to close.
    document.querySelector('.searchicon').classList.remove('hamburgertogglemenu');
    document.querySelector('.searchHam').classList.remove('searchHamburger');
    document.querySelector('.hamburgerfooter').classList.remove('hamburgerFooter');
    flag = false;
  }
});
