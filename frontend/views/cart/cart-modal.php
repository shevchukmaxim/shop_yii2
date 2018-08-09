<?php if (!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($session['cart'] as $id => $item): ?>
                <tr>
                    <td><?= yii\helpers\Html::img("@web/images/products/{$item['img']}", ['alt' => $item['name'], 'height' => 50])?></td>
                    <td><?= $item['name']?></td>
                    <td><?= $item['amount']?></td>
                    <td><?= $item['price']?></td>
                    <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4">Итого: </td>
                    <td><?= $session['cart.amount']?></td>
                </tr>
                <tr>
                    <td colspan="4">Сумма: </td>
                    <td><?= $session['cart.sum']?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <h3>Ваша корзина пуста</h3>
<?php endif; ?>