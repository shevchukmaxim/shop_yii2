<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="container">
    <?php if (!empty($session['cart'])): ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($session['cart'] as $id => $item): ?>
                    <tr>
                        <td><?= yii\helpers\Html::img("@web/images/products/{$item['img']}", ['alt' => $item['name'], 'height' => 50])?></td>
                        <td><a href="<?= Url::to(['product/view', 'id' => $id])?>"><?= $item['name']?></a></td>
                        <td><?= $item['amount']?></td>
                        <td><?= $item['price']?></td>
                        <td><?= $item['amount'] * $item['price']?></td>
                        <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4">Количество товара: </td>
                    <td><?= $session['cart.amount']?></td>
                </tr>
                <tr>
                    <td colspan="4">На сумму: </td>
                    <td><?= $session['cart.sum']?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <?php $form = ActiveForm::begin()?>
        <?= $form->field($order, 'name')?>
        <?= $form->field($order, 'email')?>
        <?= $form->field($order, 'phone')?>
        <?= $form->field($order, 'address')?>
        <?= Html::submitButton('Заказать', ['class' => 'btn btn-success'])?>
        <?php ActiveForm::end()?>
    <?php else: ?>
        <h3>Ваша корзина пуста</h3>
    <?php endif; ?>
</div>
