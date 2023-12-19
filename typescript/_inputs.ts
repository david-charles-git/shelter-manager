const handleShelterManagerInputChange: (event: Event, type: string, callback: Function) => void = (
  event,
  type,
  callback,
) => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const parent: HTMLElement = target.closest('.form-field') as HTMLElement;
  const input: HTMLInputElement = parent.getElementsByTagName('input')[0] as HTMLInputElement;
  var value: string = '';
  clearErrorState(parent);
  switch (type) {
    case 'checkbox':
      value = target.getAttribute('data-value');
      if (!value) {
        console.error('handleShelterManagerInputChange error: No value found for checkbox');
        return;
      }
      const checkboxes: HTMLCollectionOf<Element> = parent.getElementsByClassName(
        'checkbox',
      ) as HTMLCollectionOf<Element>;
      for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].classList.remove('active');
      }
      target.classList.add('active');
      input.value = value;
      break;
    case 'true_false':
      value = input.value;
      if (!value) {
        console.error('handleShelterManagerFormTrueFalseClick error: No value found for input');
        return;
      } else if (value === 'yes') {
        input.value = 'no';
        target.classList.remove('active');
      } else if (value === 'no') {
        input.value = 'yes';
        target.classList.add('active');
      }
      break;
    case 'text':
      break;
    case 'number':
      break;
    case 'textarea':
      break;
    case 'select':
      break;
  }
  if (callback && typeof callback === 'function') {
    callback(event);
  }
};
const handleShelterManagerInputConditional: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const parent: HTMLElement = target.closest('.conditional-handler') as HTMLElement;
  const input: HTMLInputElement = parent.getElementsByTagName('input')[0] as HTMLInputElement;
  var conditionsString: string = parent.getAttribute('data-conditions') || '[]';
  conditionsString = conditionsString.replace(/\&quot;/g, '"');
  const conditionsJSON: any[] = JSON.parse(conditionsString);
  if (conditionsJSON.length === 0) {
    console.error('handleShelterManagerInputConditional error: Conditions is not an array');
    return;
  }
  for (let i = 0; i < conditionsJSON.length; i++) {
    const id: string = conditionsJSON[i].id;
    const value: string = conditionsJSON[i].value;
    const condition: string = conditionsJSON[i].condition;
    const element: HTMLElement = document.getElementById(id) as HTMLElement;
    const container: HTMLElement = element.closest('.conditional') as HTMLElement;
    switch (condition) {
      case 'equal_to':
        if (value === input.value) {
          container.classList.remove('shelter-manager-hidden');
        } else {
          container.classList.add('shelter-manager-hidden');
        }
        break;
    }
  }
};
const handleShelterManagerFormMultiInputAdd: (event: Event) => void = event => {
  preventDefault(event);
  const newItem: any = {};
  const target: any = event.currentTarget || event.target;
  const parent: HTMLElement = target.closest('.form-field') as HTMLElement;
  const input: HTMLInputElement = parent.getElementsByTagName('input')[0] as HTMLInputElement;
  const multiInputValues: HTMLElement = parent.getElementsByClassName('multi-input-values')[0] as HTMLElement;
  const multiInputsContainer: HTMLElement = parent.getElementsByClassName('multi-input-inputs')[0] as HTMLElement;
  const value: string = input.value || '[]';
  const valueJSON: any[] = JSON.parse(value);
  const multiInput: HTMLElement = multiInputsContainer.children[0] as HTMLElement;
  const formFields: HTMLCollectionOf<Element> = multiInput.getElementsByClassName(
    'form-field',
  ) as HTMLCollectionOf<Element>;
  var occupantHTML: string = `<div class="value">`;
  clearErrorState(parent);
  for (let i = 0; i < formFields.length; i++) {
    const label: HTMLElement = formFields[i].getElementsByTagName('label')[0] as HTMLElement;
    const input: HTMLInputElement = formFields[i].getElementsByTagName('input')[0] as HTMLInputElement;
    const inputId: string = input.getAttribute('id') || '';
    var inputLabel: string = label.innerText || '';
    var inputValue: string = input.value || '';
    if (!inputId) {
      console.error('handleShelterManagerFormMultiInputAdd error: No id found for formField');
      continue;
    }
    newItem[inputId] = inputValue;
    occupantHTML += `<p>${inputLabel}: ${inputValue}</p>`;
    input.value = '';
  }
  occupantHTML += `<button class="button-remove" onclick="handleShelterManagerFormMultiInputRemove(event)">Remove</button>`;
  occupantHTML += `</div>`;
  valueJSON.push(newItem);
  input.value = JSON.stringify(valueJSON);
  multiInputValues.innerHTML = multiInputValues.innerHTML + occupantHTML;
};
const handleShelterManagerFormMultiInputRemove: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const item: HTMLElement = target.closest('.value') as HTMLElement;
  const parent: HTMLElement = target.closest('.input-multi-complex') as HTMLElement;
  const input: HTMLInputElement = parent.getElementsByTagName('input')[0] as HTMLInputElement;
  const multiInputsValues: HTMLElement = parent.getElementsByClassName('multi-input-values')[0] as HTMLElement;
  const items: HTMLCollectionOf<Element> = multiInputsValues.getElementsByClassName(
    'value',
  ) as HTMLCollectionOf<Element>;
  var index: number = -1;
  var value: string = input.value || '[]';
  const valueJSON: any[] = JSON.parse(value);
  for (let i: number = 0; i < items.length; i++) {
    if (items[i] === item) {
      index = i;
      break;
    }
  }
  if (index === -1) {
    console.error('handleShelterManagerFormMultiInputRemove error: No index found for item');
    return;
  }
  valueJSON.splice(index, 1);
  multiInputsValues.removeChild(item);
  input.value = JSON.stringify(valueJSON);
};
