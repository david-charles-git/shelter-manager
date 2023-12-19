const validateShelterManagerInput: (input: HTMLFormElement, type: string) => boolean = (input, type) => {
  const parent: HTMLElement = input.closest('.form-field') as HTMLInputElement;
  const required: string = input.getAttribute('required') || '';
  const inputValue: string = input.value || '';
  if (!required && !inputValue) {
    return false;
  } else if (!inputValue) {
    parent.classList.add('error');
    scrollToElement(parent);
    return true;
  }
  clearErrorState(parent);
  var errorCount: number = 0;
  switch (type) {
    case 'checkbox':
      const checkboxes: HTMLCollectionOf<Element> = parent.getElementsByClassName(
        'checkbox',
      ) as HTMLCollectionOf<Element>;
      const checkboxValues: string[] = [];
      for (var a: number = 0; a < checkboxes.length; a++) {
        const value: string = checkboxes[a].getAttribute('data-value') || '';
        if (!value) {
          continue;
        }
        checkboxValues.push(value);
      }
      if (!checkboxValues.includes(inputValue)) {
        parent.classList.add('error');
        scrollToElement(parent);
        errorCount++;
      }
      break;
    case 'text':
      break;
    case 'textarea':
      break;
    case 'number':
      const parsedValue: number = parseInt(inputValue);
      if (isNaN(parsedValue)) {
        parent.classList.add('error');
        scrollToElement(parent);
        errorCount++;
      }
      break;
    case 'select':
      const options: HTMLCollectionOf<HTMLOptionElement> = input.getElementsByTagName('option');
      const optionValues: string[] = [];
      for (var a: number = 0; a < options.length; a++) {
        const value: string = options[a].value || '';
        if (!value) {
          continue;
        }
        optionValues.push(value);
      }
      if (!optionValues.includes(inputValue)) {
        parent.classList.add('error');
        scrollToElement(parent);
        errorCount++;
      }
      break;
    case 'multi-complex':
      const parsedValues: any[] = JSON.parse(inputValue);
      if (!parsedValues.length) {
        parent.classList.add('error');
        scrollToElement(parent);
        errorCount++;
      }
      break;
    case 'postcode':
      const postcodeRegex: RegExp = /^[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][A-Za-z]{2}$/;
      if (!postcodeRegex.test(inputValue)) {
        parent.classList.add('error');
        scrollToElement(parent);
        errorCount++;
      }
      break;
    case 'date':
      const currentDate: number = new Date().getTime();
      const inputDate: number = new Date(inputValue).getTime();
      if (inputDate > currentDate || !inputDate) {
        parent.classList.add('error');
        scrollToElement(parent);
        errorCount++;
      }
      break;
    case 'phonenumber':
      const phoneNumberRegex: RegExp = /^(\+\d{1,3}\s?)?(\()?(\d{1,5}(\s|\))?)?[\s-]?\d{6,10}$/;
      if (!phoneNumberRegex.test(inputValue)) {
        parent.classList.add('error');
        scrollToElement(parent);
        errorCount++;
      }
      break;
    case 'email':
      const emailRegex: RegExp = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (!emailRegex.test(inputValue)) {
        parent.classList.add('error');
        scrollToElement(parent);
        errorCount++;
      }
      break;
  }
  return errorCount > 0;
};
const validateShelterManagerGroupInputs: (parent: Element) => boolean = parent => {
  const fields: HTMLCollectionOf<Element> = parent.getElementsByClassName('form-field') as HTMLCollectionOf<Element>;
  const inputs: any = [];
  for (var a: number = 0; a < fields.length; a++) {
    const input: HTMLInputElement = fields[a].getElementsByTagName('input')[0] as HTMLInputElement;
    const select: HTMLSelectElement = fields[a].getElementsByTagName('select')[0] as HTMLSelectElement;
    const textarea: HTMLTextAreaElement = fields[a].getElementsByTagName('textarea')[0] as HTMLTextAreaElement;
    if (!input && !select && !textarea) {
      continue;
    } else if (input) {
      inputs.push(input);
    } else if (select) {
      inputs.push(select);
    } else if (textarea) {
      inputs.push(textarea);
    }
  }
  var errorCount: number = 0;
  for (var a: number = 0; a < inputs.length; a++) {
    const type: string = inputs[a].getAttribute('data-type') || '';
    if (!type) {
      continue;
    }
    const error: boolean = validateShelterManagerInput(inputs[a], type);
    if (error) {
      errorCount++;
    }
  }
  return errorCount > 0;
};
