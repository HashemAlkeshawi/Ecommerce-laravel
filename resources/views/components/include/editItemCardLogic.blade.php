<script>
    const nameInput = document.getElementById('name');
    const itemNameDisplay = document.getElementById('itemName');
    const itemNotesDisplay = document.getElementById('itemNotes');

    // Add event listener to the name input
    nameInput.addEventListener('input', function() {
        // Update the displayed text with the input value
        itemNameDisplay.innerText = nameInput.value;
    });

  
    const iconInput = document.getElementById('imageInput');
    const itemImage = document.getElementById('itemImage');

    iconInput.addEventListener('change', function() {
        const file = iconInput.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            // Update the image source with the data URL of the selected file
            itemImage.src = e.target.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });
</script>