
    <li>
        <a href="">
            <?= $category['name'] ?>
            <?php if (isset($category['childs']) ): ?>
                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
            <?php endif; ?>
        </a>
        <?php if (isset($category['childs']) ): ?>
            <ul>
                <li>
                    <a href="">
                        <?= $this->getMenuHtml($category['childs']) ?>
                    </a>
                </li>
            </ul>
        <?php endif; ?>
    </li>

