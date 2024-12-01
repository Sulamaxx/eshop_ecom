// Light/Dark mode toggle functionality
document.getElementById('mode-toggle').addEventListener('click', function () {
    document.body.classList.toggle('dark-mode');
});

// Sidebar Toggle on Mobile
document.getElementById('menu-toggle').addEventListener('click', function () {
    document.getElementById('wrapper').classList.toggle('active');
});

// Dark mode CSS adjustments
const darkModeCSS = `
    body.dark-mode {
        background-color: #2c3e50;
        color: #ecf0f1;
    }

    body.dark-mode #sidebar {
        background-color: #34495e !important;
    }

    body.dark-mode .card-body {
        background-color: #34495e !important;
        color: #ecf0f1;
    }

    body.dark-mode table {
        background-color: #34495e;
        color: #ecf0f1;
    }

    body.dark-mode .table-striped tbody tr:nth-of-type(odd) {
        background-color: #2c3e50;
    }

    body.dark-mode button {
        background-color: #ecf0f1;
        color: #2c3e50;
    }
    body.dark-mode .modal-content {
        background-color: #34495e;
    }
`;

const style = document.createElement('style');
style.textContent = darkModeCSS;
document.head.appendChild(style);

// Delete Product functionality with unique class names
document.querySelectorAll('.pm-btn-delete').forEach(button => {
    button.addEventListener('click', function () {
        const productName = this.closest('tr').querySelector('td').textContent;
        console.log('Delete product:', productName);
        // Handle deleting the product (e.g., send a request to the server to delete the product)
    });
});

// Activate/Deactivate Product functionality with unique class names
document.querySelectorAll('.pm-btn-deactivate').forEach(button => {
    button.addEventListener('click', function () {
        const productName = this.closest('tr').querySelector('td').textContent;
        console.log('Deactivate product:', productName);
        // Handle activating/deactivating the product (e.g., send a request to the server)
    });
});



// Handle customer search functionality (this can be extended for backend integration)
document.getElementById('searchCustomers').addEventListener('input', function (event) {
    let query = event.target.value.toLowerCase();
    let rows = document.querySelectorAll('#customerList tr');

    rows.forEach(function (row) {
        let name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
        let email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        let status = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

        if (name.includes(query) || email.includes(query) || status.includes(query)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Handle Deactivate/Activate toggle status
document.querySelectorAll('.pm-btn-toggle-status').forEach(function (button) {
    button.addEventListener('click', function () {
        let statusCell = this.closest('tr').querySelector('td:nth-child(3)');
        let currentStatus = statusCell.textContent.trim().toLowerCase();

        if (currentStatus === 'active') {
            statusCell.innerHTML = '<span class="badge badge-secondary">Inactive</span>';
            this.textContent = 'Activate';
        } else {
            statusCell.innerHTML = '<span class="badge badge-success">Active</span>';
            this.textContent = 'Deactivate';
        }
    });
});

// Handle Delete functionality (this can be extended with a confirmation modal)
document.querySelectorAll('.pm-btn-delete').forEach(function (button) {
    button.addEventListener('click', function () {
        if (confirm('Are you sure you want to delete this customer?')) {
            this.closest('tr').remove();
        }
    });
});



// Handle the form submission (this can be extended to send the data to the server)
document.getElementById('profile-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form from submitting the traditional way

    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;
    const contact = document.getElementById('contact').value;
    const password = document.getElementById('password').value;

    // Validate the inputs (basic validation)
    if (!firstName || !lastName || !email || !contact || !password) {
        alert('All fields are required!');
        return;
    }

    // Simulate saving the profile (this should be sent to the backend)
    alert('Profile updated successfully!');

    // In a real scenario, here you would send the data to the backend via AJAX, fetch API, etc.
});



// Handle changing order status
document.querySelectorAll('.order-action-btn').forEach(button => {
    button.addEventListener('click', function () {
        const orderId = this.getAttribute('data-order-id');
        const status = this.getAttribute('data-status');

        // Simulate changing the status of the order (this should ideally be an AJAX call)
        console.log(`Changing status of order ${orderId} to ${status}`);

        // Update the UI to show the new status
        const row = this.closest('tr');
        const statusCell = row.querySelector('td:nth-child(4)');
        statusCell.innerHTML = `<span class="badge badge-${status === 'Delivered' ? 'success' : 'primary'}">${status}</span>`;

        // Optionally, you can also disable the buttons once an order reaches "Completed"
        if (status === 'Completed') {
            this.disabled = true;
        }
    });
});

// Handle viewing order details (for modal display)
document.querySelectorAll('.view-order-details-btn').forEach(button => {
    button.addEventListener('click', function () {
        const orderId = this.getAttribute('data-order-id');

        // Fetch order details (this can be an AJAX call)
        const orderDetails = `Order Details for Order ID #${orderId}:<br><strong>Items:</strong> Product A, Product B, Product C<br><strong>Total Price:</strong> $200<br><strong>Shipping Address:</strong> 1234 Main St, City, Country`;

        // Inject order details into the modal
        const modalBody = document.querySelector('#orderDetailsModal .modal-body');
        modalBody.innerHTML = orderDetails;

        // Show the modal
        $('#orderDetailsModal').modal('show');
    });
});


function previewImage(event, boxNumber) {
    const input = event.target;
    const reader = new FileReader();

    reader.onload = function () {
        const preview = document.getElementById(`preview${boxNumber}`);
        preview.src = reader.result;
        preview.style.display = 'block';
        preview.nextElementSibling.style.display = 'none';
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}
