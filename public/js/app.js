document.addEventListener('DOMContentLoaded', () => {
    if (window.jQuery) {
        const $ = window.jQuery;
        const $listing = $('#newsListing');
        const $status = $('#newsListingStatus');
        let listingRequest = null;

        const loadListing = (url, updateHistory = true) => {
            if (listingRequest) {
                listingRequest.abort();
            }

            $listing.attr('aria-busy', 'true');
            $status.text('Loading news and events...').prop('hidden', false);

            const request = $.ajax({
                url,
                method: 'GET',
                dataType: 'html',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            });
            listingRequest = request;

            request
                .done((html) => {
                    if (listingRequest !== request) {
                        return;
                    }

                    $listing.html(html);

                    const currentUrl = new URL(url, window.location.href);
                    const category = currentUrl.searchParams.get('category') || '';

                    $('#newsFilters a').each(function () {
                        const linkCategory = new URL(this.href, window.location.href).searchParams.get('category') || '';
                        const isActive = linkCategory === category;

                        $(this)
                            .toggleClass('active', isActive)
                            .attr('aria-current', isActive ? 'true' : null);
                    });

                    if (updateHistory) {
                        window.history.pushState({}, '', currentUrl);
                    }

                    $status.text('').prop('hidden', true);
                })
                .fail((xhr, textStatus) => {
                    if (textStatus !== 'abort' && listingRequest === request) {
                        $status
                            .text('Unable to load news and events. Please try again.')
                            .prop('hidden', false);
                    }
                })
                .always(() => {
                    if (listingRequest === request) {
                        $listing.attr('aria-busy', 'false');
                        listingRequest = null;
                    }
                });
        };

        $(document).on('click', '#newsFilters a, #newsListing .pagination a', function (event) {
            if (event.ctrlKey || event.metaKey || event.shiftKey || event.altKey || event.button !== 0) {
                return;
            }

            const url = new URL(this.href, window.location.href);
            if (url.origin !== window.location.origin) {
                return;
            }

            event.preventDefault();
            loadListing(url.href);
        });

        window.addEventListener('popstate', () => loadListing(window.location.href, false));
    }

    const navToggle = document.getElementById('navToggle');
    const navLinks = document.getElementById('navLinks');
    if (navToggle && navLinks) {
        navToggle.addEventListener('click', () => navLinks.classList.toggle('open'));
    }

    document.querySelectorAll('.faq-toggle').forEach((button) => {
        button.addEventListener('click', () => {
            button.parentElement.classList.toggle('open');
        });
    });

    const form = document.getElementById('enquiryForm');
    if (!form) {
        return;
    }

    const success = document.getElementById('enquirySuccess');
    const submit = document.getElementById('enquirySubmit');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const clearErrors = () => {
        form.querySelectorAll('[data-error]').forEach((el) => {
            el.textContent = '';
        });
    };

    const setSuccessState = (message, tone = 'success') => {
        success.style.background = tone === 'success' ? '#e8fff3' : '#fff4e5';
        success.style.color = tone === 'success' ? '#0f7a45' : '#9a5b00';
        success.textContent = message;
        success.classList.add('show');
    };

    const showErrors = (errors) => {
        Object.entries(errors || {}).forEach(([field, messages]) => {
            const el = form.querySelector(`[data-error="${field}"]`);
            if (el) {
                el.textContent = messages[0];
            }
        });
    };

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        clearErrors();
        success.classList.remove('show');
        success.style.background = '';
        success.style.color = '';
        submit.disabled = true;
        submit.textContent = 'Sending...';

        const data = Object.fromEntries(new FormData(form).entries());

        try {
            const response = await fetch('/admission-enquiry', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify(data),
            });

            const payload = await response.json();

            if (response.ok) {
                form.reset();
                setSuccessState(payload.message, 'success');
            } else if (response.status === 409) {
                setSuccessState(payload.message, 'warning');
            } else if (response.status === 422) {
                showErrors(payload.errors);
            } else if (response.status === 429) {
                setSuccessState('Please wait a moment before sending another enquiry.', 'warning');
            } else {
                showErrors({ message: [payload.message || 'Something went wrong. Please try again.'] });
            }
        } catch (error) {
            showErrors({ message: ['Unable to send right now. Please try again.'] });
        } finally {
            submit.disabled = false;
            submit.textContent = 'Book My Visit';
        }
    });
});
