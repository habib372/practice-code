
<ul class="dropdown know-cancer">
    <!-- Your list items go here -->
    <li></li>
    <li></li>
</ul>


{{-- /* CSS for the scrolling behavior */ --}}
<style>
    ul.dropdown.know-cancer.scroll-enabled {
    overflow-y: scroll;
    max-height: 490px;
}
</style>


<script>
			var dropdown = document.querySelector('ul.dropdown.know-cancer');
			// Check if the element's height is greater than 490px
			if (dropdown.clientHeight > 490) {
				// If yes, add the CSS class to enable scrolling
				dropdown.classList.add('scroll-enabled');
			} else {
				// Otherwise, remove the CSS class to revert to normal view
				dropdown.classList.remove('scroll-enabled');
			}

</script>

