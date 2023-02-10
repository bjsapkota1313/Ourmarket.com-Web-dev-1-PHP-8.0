<div class="container">
    <div class="row">
        <div class="col-12 pt-5">
            <h1 class="text-center">Payment Successful</h1>
            <p class="text-center">Thank you for your purchase! You have paid <strong>€ <?= htmlspecialchars_decode(number_format($total, 2, '.')) ?></strong> and your payment has been received and your product will be shipped soon.</p>
            <div class="text-center">
                <button class="btn btn-primary" onClick="window.location.href='/home'">Shop Again !</button>
            </div>
        </div>
    </div>
</div>