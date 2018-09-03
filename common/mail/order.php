<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Цена</th>
            <th>Сумма</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($session['cart'] as $id => $item): ?>
            <tr>
                <td><?= $item['name']?></td>
                <td><?= $item['amount']?></td>
                <td><?= $item['price']?></td>
                <td><?= $item['amount'] * $item['price']?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3">Количество товаров: </td>
            <td><?= $session['cart.amount']?></td>
        </tr>
        <tr>
            <td colspan="3">Сумма: </td>
            <td><?= $session['cart.sum']?></td>
        </tr>
        </tbody>
    </table>
</div>