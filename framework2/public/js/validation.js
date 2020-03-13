function noValidation(input, message) {
    if(input.validity.valueMissing)
    {
        input.setCustomValidity(message);
        input.reportValidity();
        return true;
    }
    return false;
}
