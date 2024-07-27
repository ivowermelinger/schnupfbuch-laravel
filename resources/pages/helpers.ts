export const getHeaders = () => {
    // Fetch CSRF token from meta tag
    const token = document.head
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content');

    return {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token,
    };
};

export const validateForm = (form: HTMLFormElement): HTMLElement[] => {
    const defaultMessage = 'Dieses Feld darf nicht leer sein';
    const inputs = form.querySelectorAll<
        HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement
    >('input, select, textarea');
    const errors: HTMLElement[] = [];

    const removeErrorClass = (input: HTMLElement) => {
        input.parentElement?.classList.remove('form__group--error');
    };

    const addErrorClass = (input: HTMLElement) => {
        input.parentElement?.classList.add('form__group--error');
    };

    const removeErrorMessage = (input: HTMLElement) => {
        const hint =
            input.parentElement?.querySelector<HTMLElement>('.form__hint');
        if (!hint) return;

        hint.textContent = '';
    };

    inputs.forEach((input) => {
        removeErrorClass(input);

        // Validate required fields
        if (!input.checkValidity()) {
            errors.push(input);
        } else {
            removeErrorMessage(input);
        }
    });

    errors.forEach((input) => {
        const parentElement = input.parentElement;
        if (!parentElement) return;

        addErrorClass(input);
        const hint = parentElement.querySelector<HTMLElement>('.form__hint');

        if (!hint) return;

        if (
            input instanceof HTMLInputElement ||
            input instanceof HTMLSelectElement ||
            input instanceof HTMLTextAreaElement
        ) {
            hint.textContent = input.validationMessage || defaultMessage;
        }
    });

    // Focus on first error
    if (errors.length > 0) {
        errors[0].focus();
    }

    return errors;
};
