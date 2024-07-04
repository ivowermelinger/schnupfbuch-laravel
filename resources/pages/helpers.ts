export const getHeaders = () => {
	// Fetch CSRF token from meta tag
	const token = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');

	return {
		'Content-Type': 'application/json',
		'X-CSRF-TOKEN': token,
	};
};
