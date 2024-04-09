if (<?php isset($_SESSION['login-successful']) ? 'true' : 'false'; ?>) {
    // Select the meal-list container by its ID
    var mealListContainer = document.getElementById('mealList');

    // Create new elements for the image and title
    var imgElement = document.createElement('img');
    imgElement.src = '<?php echo $image; ?>';

    var titleElement = document.createElement('h3');
    titleElement.textContent = '<?php echo $title; ?>';

    // Append the image and title elements to the meal-list container
    mealListContainer.appendChild(imgElement);
    mealListContainer.appendChild(titleElement);
}