<div class="container-fluid mt-5">
    <div class="row mb-5">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="col-md-6">
            <div class="card shadow-sm border-light menu-card">
                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                    <h4 class="card-title text-dark">Menu</h4>
                    <form action="" class="d-flex">
                        <select class="form-control" name="id_kategori" id="id_kategori" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategori as $kat): ?>
                                <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($produk as $item): ?>
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm rounded-lg menu-item-card">
                                    <img src="<?= base_url('assets/img/upload/' . $item['foto_produk']) ?>" alt="Nasi Goreng" class="card-img-top product-image">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?= $item['nama_produk'] ?></h5>
                                        <p class="card-text text-dark font-weight-bold">Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                                        <button class="btn btn-dark mt-3 add-to-cart" data-id="<?= $item['id_produk'] ?>" data-nama="<?= $item['nama_produk'] ?>" data-harga="<?= $item['harga'] ?>"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cart Section -->
        <div class="col-md-6">
            <div class="card shadow-sm border-light cart-card">
                <div class="card-header bg-light">
                    <h4 class="card-title text-dark">Cart</h4>
                </div>
                <div class="card-body">
                    <table class="table table-borderless" id="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                        </tbody>
                    </table>
                    <hr>
                    <form id="payment-form" method="post" action="<?= base_url() ?>/snap/finish">
                        <input type="hidden" name="result_type" id="result-type" value="">
                        <input type="hidden" name="result_data" id="result-data" value="">
                        <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="">

                        <!-- Hidden inputs for cart items data -->
                        <input type="hidden" name="cart_data" id="cart_data" value="">

                        <div class="form-group">
                            <label for="fullName">Nama Lengkap</label>
                            <input type="text" class="form-control" name="fullName" id="fullName" placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <label for="total">Total Bayar</label>
                            <input type="text" class="form-control" name="total" id="total" readonly>
                        </div>
                    </form>
                    <hr>
                    <div class="d-flex justify-content-between mt-3">
                        <p id="total-cart">Total: Rp 0</p>
                    </div>
                    <button class="btn btn-success w-100 mt-3" id="pay-button">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var cartItems = [];
    var id_pelanggan = Math.floor(Math.random() * 10000);

    $(function() {
        $('.add-to-cart').on('click', function() {
            var item = {
                id: $(this).data('id'),
                name: $(this).data('nama'),
                price: $(this).data('harga'),
                quantity: 1,
                id_pelanggan: id_pelanggan

            };

            console.log(item);

            var existingItem = cartItems.find(cartItem => cartItem.id === item.id);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                cartItems.push(item);
            }

            renderCart();
        });
    });


    function renderCart() {
        $('#cart-items').empty();
        let total = 0;
        let cartData = [];

        cartItems.forEach(item => {

            const subtotal = (item.price * item.quantity).toFixed(2);

            total += parseFloat(subtotal);

            var id_pelanggan = $("#id_pelanggan").val();
            if (id_pelanggan == "") {
                id_pelanggan = Math.floor(Math.random() * 10000);
                $("#id_pelanggan").val(id_pelanggan);
            }

            $('#cart-items').append(`
            <tr data-name="${item.name}" data-price="${item.price}">
                <td>${item.name}</td>
                <td>
                    <input type="number" class="form-control quantity-input" value="${item.quantity}" min="1" data-id="${item.id}">
                </td>
                <td>Rp ${parseFloat(subtotal).toLocaleString('id-ID')}</td> <!-- Formatted subtotal -->
                <td><button class="btn btn-danger btn-sm remove-from-cart" data-id="${item.id}"><i class="fas fa-trash-alt"></i></button></td>
            </tr>
        `);
            console.log(subtotal);


            cartData.push({
                id: item.id,
                name: item.name,
                price: item.price,
                quantity: item.quantity,
                subtotal: subtotal,
                id_pelanggan: id_pelanggan
            });
        });


        $('#total-cart').text('Total: Rp ' + total.toLocaleString('id-ID'));
        $('#total').val(total);

        $('#cart_data').val(JSON.stringify(cartData));
    }


    $(document).on('change', '.quantity-input', function() {
        const id = $(this).data('id');
        const newQuantity = parseInt($(this).val());

        const item = cartItems.find(item => item.id === id);
        if (item && newQuantity > 0) {
            item.quantity = newQuantity;
            renderCart();
        }
    });

    $(document).on('click', '.remove-from-cart', function() {
        const id = $(this).data('id');
        cartItems = cartItems.filter(item => item.id !== id); // Remove item from cart
        renderCart();
    });

    $('#pay-button').click(function(event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");

        var total = $("#total").val();
        var fullName = $("#fullName").val();

        console.log(cartItems);

        $.ajax({
            type: 'POST',
            url: 'http://localhost/garchik/snap/token',
            data: {
                total: total,
                fullName: fullName,
                cartItems: cartItems,
                id_pelanggan: id_pelanggan

            },
            success: function(data) {
                console.log('token = ' + data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                }

                snap.pay(data, {
                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
</script>