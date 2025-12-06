function addToCart(id) {
    fetch('cart-action.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=add&id=' + id
    })
    .then(res => res.json())
    .then(data => updateCart(data));
}

function removeFromCart(id) {
    fetch('cart-action.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=remove&id=' + id
    })
    .then(res => res.json())
    .then(data => updateCart(data));
}

function updateCart(cart) {
    const tbody = document.querySelector('#cartTable tbody');
    tbody.innerHTML = '';
    let totalPrice = 0;

    if(Object.keys(cart).length === 0) {
        tbody.innerHTML = '<tr><td colspan="6">Cart is empty</td></tr>';
        return;
    }

    for(let id in cart) {
        const item = cart[id];
        const row = document.createElement('tr');
        const itemTotal = item.price * item.quantity;
        totalPrice += itemTotal;

        row.innerHTML = `
            <td><img src="${item.image}" width="50"></td>
            <td>${item.name}</td>
            <td>₹ ${item.price}</td>
            <td>${item.quantity}</td>
            <td>₹ ${itemTotal}</td>
            <td><button onclick="removeFromCart(${id})">Remove</button></td>
        `;
        tbody.appendChild(row);
    }

    const totalRow = document.createElement('tr');
    totalRow.innerHTML = `<td colspan="4" style="text-align:right"><strong>Total:</strong></td><td colspan="2">₹ ${totalPrice}</td>`;
    tbody.appendChild(totalRow);
}
