function noValidation(input, message) {
    if(input.validity.valueMissing)
    {
        input.setCustomValidity(message);
        input.reportValidity();
        return true;
    }
    return false;
}

function noValidationNumber(input, message) {
    if(input.validity.valueMissing || input.validity.rangeOverflow || input.validity.rangeUnderflow)
    {
        input.setCustomValidity(message);
        input.reportValidity();
        return true;
    }
    return false;
}