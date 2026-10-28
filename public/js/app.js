document.addEventListener('DOMContentLoaded', () => {
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
