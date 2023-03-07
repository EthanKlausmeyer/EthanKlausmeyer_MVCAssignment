<?php
include 'view/header.php';
?>

<main>
    <h1>Item List</h1>

    <aside>
        <h2>Categories</h2>
        <nav>
            <ul>
                <?php
                foreach ($categories as $category) :
                ?>
                    <li class='cat_li'><a href="?category_id=<?php echo $category['ID']; ?>"><?php echo $category['categoryName'] ?></a></li>
                <?php
                endforeach;
                ?>
            </ul>
        </nav>
    </aside>

    <section>
        <h2><?php
            echo $category_name;
            ?></h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Click to Delete</th>
            </tr>
            <tr>
                <?php
                foreach ($items as $item) :
                ?>
                    <td><?php echo $item['Title'] ?></td>
                    <td><?php echo $item['Description'] ?></td>
                    <td>
                        <form action="." method="post">
                            <input type="hidden" name="action" value="delete_item">
                            <input type="hidden" name="itemNum" value="<?php echo $item['ItemNum'] ?>">
                            <input type="hidden" name="category_id" value="<?php echo $item['categoryID'] ?>">
                            <input type="submit" value="Delete" class="del_button">
                        </form>
                    </td>
            </tr>
        <?php
                endforeach;
        ?>
        </table>
        <p class="last_paragraph">
            <a href="?action=show_add_form">Submit</a>
        </p>
    </section>
</main>
<?php
include 'view/footer.php';
?>