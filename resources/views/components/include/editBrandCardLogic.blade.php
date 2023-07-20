<script>
    const nameInput = document.getElementById('name');
    const brandNameDisplay = document.getElementById('brandName');
    const brandNotesDisplay = document.getElementById('brandNotes');

    // Add event listener to the name input
    nameInput.addEventListener('input', function() {
        // Update the displayed text with the input value
        brandNameDisplay.innerText = nameInput.value;
    });

    // Add event listener to the notes textarea (optional, if you want to update the notes display)
    const notesInput = document.querySelector('textarea[name="notes"]');
    notesInput.addEventListener('input', function() {
        // Update the displayed text with the textarea value
        brandNotesDisplay.innerText = notesInput.value;
    });

    const iconInput = document.getElementById('iconInput');
    const brandImage = document.getElementById('brandImage');

    iconInput.addEventListener('change', function() {
        const file = iconInput.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            // Update the image source with the data URL of the selected file
            brandImage.src = e.target.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });
</script>