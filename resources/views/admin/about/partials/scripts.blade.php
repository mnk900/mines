<script>
    // Function to generate a slug from the title
function generateSlug(title) {
    return title.trim()               // Trim whitespace
                .toLowerCase()        // Convert to lowercase
                .replace(/[^a-z0-9]/g, '-') // Replace non-alphanumeric characters with dashes
                .replace(/-+/g, '-')  // Replace multiple dashes with single dash
                .replace(/^-|-$/g, ''); // Remove leading and trailing dashes
}

// Get references to the title and slug input fields
const titleInput = document.getElementById('title');
const slugInput = document.getElementById('slug');

// Add event listener to title input field
titleInput.addEventListener('input', function() {
    const title = titleInput.value;
    const slug = generateSlug(title);
    slugInput.value = slug;
});

</script>
