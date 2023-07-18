<script>
    var countrySelect = document.getElementById('country');
    var citySelect = document.getElementById('city');

    countrySelect.addEventListener('change', function() {
        citySelect.innerHTML = 'City..';


        // countries = @json($countries);
        countries = <?php echo json_encode($countries); ?>;


        var countryId = this.value;
        countries[countryId-1].city.forEach(function(city) {
            var option = document.createElement('option');
            option.value = city.id;
            option.text = city.name;
            citySelect.appendChild(option);
        });


    });
</script>