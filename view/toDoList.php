<?php 
include('view/header.php'); // Include the header part of the HTML page

?>

<!-- Section to Display to Dos -->
<section>

    <!-- Check if there are to dos to display (fetched from index.php) -->
    <?php if ($toDos) : ?>
        <!-- Loop through each to do and display it -->
        <?php foreach ($toDos as $toDo) : ?>
            <div>
                <p><strong><?= htmlspecialchars($toDo['Title']) ?></strong></p> <!-- Display the to do name -->
                <p><?= htmlspecialchars($toDo['Description']) ?></p> <!-- Display the to do description -->
                <!-- Form to delete the toDo, with hidden inputs for passing data -->
                <form action="." method="post">
                    <input type="hidden" name="action" value="delete_toDo">
                    <input type="hidden" name="ItemNum" value="<?= $toDo['ItemNum'] ?>">
                    <button type="submit">Delete this to do</button> <!-- Button to delete the to do -->
                </form>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <!-- Message displayed if no to do's exist -->
        <p>No to do's exist yet.</p>
    <?php endif; ?>
</section>

<!-- Section to add a new to do -->
<section>
    <h2>Add to do</h2>
    <!-- Form for adding a new to do -->
    <form action="." method="post">
        <!-- Input field for the to do Title -->
        <input type="text" name="title" maxlength="120" placeholder="Title" required>
        <!-- Input field for the to do description -->
        <input type="text" name="description" maxlength="120" placeholder="Description" required>
        <button type="submit" name="action" value="add_toDo">Add</button> <!-- Submit button for adding the to do -->
    </form>
</section>


<?php 
include('view/footer.php'); // Include the footer part of the HTML page
?>