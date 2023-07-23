<script>
  // Get the selected value from the select element
  brandSelect = document.getElementById('brand');

  brandSelect.addEventListener('change', function() {
    document.getElementById('brand_filter_form').submit();
   
  });

  
</script>