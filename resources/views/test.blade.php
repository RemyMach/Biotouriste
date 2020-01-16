<div>
    pomme
</div>
<?php


  $idUser = 1 ;
 return app()->make(\App\Http\Controllers\PaymentController::class)->callAction('showUserPayment', [$idUser]);
