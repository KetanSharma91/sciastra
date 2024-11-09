<?php
include('db.php');

$query = "SELECT * FROM courses";
$result = $conn->query($query);
?>

<div id="courses-list">
    <?php while ($course = $result->fetch_assoc()) { ?>
        <div class="course-item">
            <h3><?php echo $course['title']; ?></h3>
            <p><?php echo $course['description']; ?></p>
            <p>Price: <strike><?php echo $course['price']; ?></strike> <strong><?php echo $course['price']; ?></strong> (Discount: <?php echo $course['discount']; ?>)</p>
            <button onclick="location.href='payment.php?course_id=<?php echo $course['id']; ?>'">Buy Now</button>
        </div>
    <?php } ?>
</div>
