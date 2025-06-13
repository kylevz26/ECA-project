document.addEventListener('DOMContentLoaded', ()=>{

// for opening and closing cart (on home page)
const cartBtn = document.querySelector('#openCart');  
const closeBtn = document.querySelector('.btnClose'); 
const checkoutBtn = document.querySelector('.btnCheckout');

cartBtn.addEventListener('click', (e) => {
  e.preventDefault(); // prevents default link jump
  document.body.classList.add('showCart');  // opens cart when "Cart" button is clicked
});

closeBtn.addEventListener('click', () => {
  document.body.classList.remove('showCart');   // closes cart when "Back" button is clicked
});

checkoutBtn.addEventListener('click', () => {
  window.location.href = 'payment.php';  // goes to payment page when "Checkout" button is clicked
});

const cartList = document.querySelector('.listCart');
const addToCartButtons = document.querySelectorAll('.btnAddToCart');

addToCartButtons.forEach(button => {
  button.addEventListener('click', () => {
    const title = button.getAttribute('data-title');
    const price = button.getAttribute('data-price');
    const image = button.getAttribute('data-image');

    const existingItem = [...cartList.children].find(item =>
      item.querySelector('.name')?.textContent === title
    );

  if (existingItem) {
      const number = existingItem.querySelector('.number');
      number.textContent = parseInt(number.textContent) + 1;
    } else {
      const item = document.createElement('div');
      item.classList.add('item');
      item.innerHTML = `
        <div class="image">
          <img src="${image}" alt="${title}">
        </div>
        <div class="name">${title}</div>
        <div class="totalPrice">R${price}</div>
        <div class="quantity">
          <span class="minus"><</span>
          <span class="number">1</span>
          <span class="plus">></span>
        </div>
      `;
      cartList.appendChild(item);

      const minusBtn = item.querySelector('.minus');
      const plusBtn = item.querySelector('.plus');
      const number = item.querySelector('.number');

      minusBtn.addEventListener('click', () => {
        let qty = parseInt(number.textContent);
        if (qty > 1) {
          number.textContent = qty - 1;
        } else {
          item.remove();
        }
      });

      plusBtn.addEventListener('click', () => {
        let qty = parseInt(number.textContent);
        number.textContent = qty + 1;
      });
    }
  });
});


});