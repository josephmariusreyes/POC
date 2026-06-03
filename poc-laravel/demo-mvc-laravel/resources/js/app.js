import $ from 'jquery';

window.$ = $;
window.jQuery = $;

$(function () {
	// Toggle the mobile navigation so the layout stays usable on small screens.
	$('[data-nav-toggle]').on('click', function () {
		$('[data-nav-menu]').slideToggle(200);
	});

	// Add a simple interactive highlight on the vehicle cards.
	$('[data-vehicle-card]').on('mouseenter', function () {
		$(this).addClass('is-active');
	}).on('mouseleave', function () {
		$(this).removeClass('is-active');
	});

	// Mirror message length so you can see how much text is left in the inquiry form.
	$('[data-message-input]').on('input', function () {
		const currentLength = $(this).val().length;
		$('[data-message-count]').text(currentLength);
	}).trigger('input');

	// Filter the visible inventory cards on the current paginated page.
	const $searchInput = $('[data-filter-search]');
	const $styleInput = $('[data-filter-style]');
	const $resetButton = $('[data-filter-reset]');
	const $vehicleCards = $('[data-vehicle-results] [data-vehicle-card]');
	const $visibleCount = $('[data-filter-visible-count]');
	const $emptyState = $('[data-filter-empty-state]');

	if ($vehicleCards.length > 0) {
		const updateInventoryFilter = function () {
			const searchTerm = String($searchInput.val() || '').toLowerCase().trim();
			const bodyStyle = String($styleInput.val() || '').toLowerCase().trim();
			let visibleCards = 0;

			$vehicleCards.each(function () {
				const $card = $(this);
				const matchesSearch = searchTerm === '' || $card.data('filterText').includes(searchTerm);
				const matchesStyle = bodyStyle === '' || $card.data('bodyStyle') === bodyStyle;
				const isVisible = matchesSearch && matchesStyle;

				$card.toggle(isVisible);

				if (isVisible) {
					visibleCards += 1;
				}
			});

			$visibleCount.text(visibleCards);
			$emptyState.toggleClass('hidden', visibleCards !== 0);
		};

		$searchInput.on('input', updateInventoryFilter);
		$styleInput.on('change', updateInventoryFilter);
		$resetButton.on('click', function () {
			$searchInput.val('');
			$styleInput.val('');
			updateInventoryFilter();
		});

		updateInventoryFilter();
	}
});
