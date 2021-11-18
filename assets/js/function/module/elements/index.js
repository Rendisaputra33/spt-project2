export default {
	btnUpdate: document.querySelectorAll('.update'),
	btnDelete: document.querySelectorAll('.delete'),
	btnDetail: document.querySelectorAll('.detail'),
	formUpdate: document.querySelector('#form-'),
	baseUrl: document.querySelector('meta[name=baseurl]')?.getAttribute('aria-valuemin'),
	csrfToken: document.querySelector('meta[name=token]')?.getAttribute('content')
};
