document.addEventListener('DOMContentLoaded', () => {
    console.log('La Pamela tienda lista para Semana Santa ✨');
  
    // Efecto scroll en botones
    const buttons = document.querySelectorAll('button');
    buttons.forEach(btn => {
      btn.addEventListener('mouseover', () => {
        btn.classList.add('shadow-lg');
      });
      btn.addEventListener('mouseout', () => {
        btn.classList.remove('shadow-lg');
      });
    });
  });
  