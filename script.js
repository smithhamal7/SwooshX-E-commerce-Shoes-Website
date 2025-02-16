// Simulate cart
let cart = [];

function addToCart(productName, productPrice) {
    // Add the product to the cart
    cart.push({ name: productName, price: productPrice });

    // Store the cart in localStorage
    localStorage.setItem('cart', JSON.stringify(cart));

    // Alert the user that the item has been added
    alert(`${productName} has been added to your cart!`);
}

// Load cart on page load (for cart.html)
window.onload = function() {
    // Retrieve the cart from localStorage
    const savedCart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = savedCart;

    // Display the cart contents
    updateCartSummary();
};

function updateCartSummary() {
    const totalPrice = cart.reduce((total, item) => total + item.price, 0);
    const cartSummary = document.querySelector('.cart-summary p');
    if (cartSummary) {
        cartSummary.textContent = `Total: $${totalPrice.toFixed(2)}`;
    }
}
