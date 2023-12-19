const handleShelterManagerFormNavigation: (event: Event, type: string) => void = (event, type) => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const parent: HTMLElement = target.closest('.form') as HTMLElement;
  const form: HTMLFormElement = parent.closest('form') as HTMLFormElement;
  const formButtonsContainer: HTMLElement = form.getElementsByClassName('form-buttons')[0] as HTMLElement;
  const formGroups: HTMLCollectionOf<Element> = form.getElementsByClassName('form-group') as HTMLCollectionOf<Element>;
  const previousButton: HTMLElement = formButtonsContainer.getElementsByClassName('button-previous')[0] as HTMLElement;
  const submitButton: HTMLElement = formButtonsContainer.getElementsByClassName('button-submit')[0] as HTMLElement;
  const nextButton: HTMLElement = formButtonsContainer.getElementsByClassName('button-next')[0] as HTMLElement;
  var index: number = 0;
  for (let i: number = 0; i < formGroups.length; i++) {
    if (formGroups[i].classList.contains('active')) {
      index = i;
    }
    formGroups[i].classList.remove('active');
  }
  switch (type) {
    case 'next':
      const validationError: any = validateShelterManagerGroupInputs(formGroups[index]);
      if (validationError) {
        formGroups[index].classList.add('active');
        return;
      }
      index++;
      break;
    case 'previous':
      index--;
      break;
  }
  if (index < 0) {
    index = 0;
  } else if (index >= formGroups.length) {
    index = formGroups.length - 1;
  }
  formGroups[index].classList.add('active');
  if (index === 0) {
    previousButton.classList.remove('active');
    nextButton.classList.add('active');
    submitButton.classList.remove('active');
  } else if (index === formGroups.length - 1) {
    previousButton.classList.add('active');
    nextButton.classList.remove('active');
    submitButton.classList.add('active');
  } else {
    previousButton.classList.add('active');
    nextButton.classList.add('active');
    submitButton.classList.remove('active');
  }
  scrollToElement(formGroups[index]);
};
const handleShelterManagerFormSubmit: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const form: HTMLFormElement = target.closest('.form') as HTMLFormElement;
  var error: boolean = validateShelterManagerGroupInputs(form);
  form.classList.add('loading');
  if (error) {
    console.error('handleShelterManagerFormSubmit error: Form validation failed');
    form.classList.remove('loading');
    return;
  }
  const callback: (response: any) => void = response => {
    if (response.error) {
      form.classList.add('error');
      console.error(`getShelterManagerAnimalAdoptionFormSubmissionResponse error: ${response.message}`);
    } else {
      form.classList.add('success');
    }
    form.classList.remove('loading');
  };
  const callbackError: (response: any) => void = response => {
    form.classList.add('error');
    form.classList.remove('loading');
    console.error(`getShelterManagerAnimalAdoptionFormSubmissionResponse error: ${response.message}`);
  };
  getShelterManagerAnimalAdoptionFormSubmissionResponse(GLOBAL_shelterManagerAdoptionFormId, callback, callbackError);
};
const handleShelterManagerFormReset: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const form: HTMLFormElement = target.closest('form') as HTMLFormElement;
  form.classList.remove('success');
  form.classList.remove('error');
  form.classList.remove('loading');
};
const handleShelterManagerScrollToAdoptionForm: (event: Event) => void = event => {
  preventDefault(event);
  const adoptionForm: HTMLElement = document.getElementsByClassName(
    'shelter-manager-animal-adoption-form',
  )[0] as HTMLElement;
  scrollToElement(adoptionForm);
};
