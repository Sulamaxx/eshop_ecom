$(document).ready(function () {
  $('.add-to-cart').on('click', function (e) {
    e.preventDefault();
    let productId = $(this).data('id');
    let quantity = $(this).data('quantity');

    $.ajax({
      url: `/cart/add/${productId}/${quantity}`,
      type: 'GET',
      data: {
        _token: '{{ csrf_token() }}',
      },
      success: function (response) {
        console.log(response);
        if (response.success) {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: response.message,
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.error,
          });
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: error,
        });
      }
    });
  });
});