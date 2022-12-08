let preveiwContainere = document.querySelector('.products-preview');
let previewBox = preveiwContainere.querySelectorAll('.preview');

document.querySelectorAll('.products-containere .product').forEach(product =>{
  product.onclick = () =>{
    preveiwContainere.style.display = 'flex';
    let name = product.getAttribute('data-name');
    previewBox.forEach(preview =>{
      let target = preview.getAttribute('data-target');
      if(name == target){
        preview.classList.add('active');
      }
    });
  };
});

previewBox.forEach(close =>{
  close.querySelector('.fa-times').onclick = () =>{
    close.classList.remove('active');
    preveiwContainere.style.display = 'none';
  };
});