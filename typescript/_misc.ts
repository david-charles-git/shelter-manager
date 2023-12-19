const preventDefault: (event: Event) => void = event => {
  event.preventDefault();
};
const serializeArray: (form: any) => any = form => {
  var formData: any = {};
  for (var i: number = 0; i < form.elements.length; i++) {
    var field = form.elements[i];
    if (
      field.name &&
      !field.disabled &&
      field.type !== 'file' &&
      field.type !== 'reset' &&
      field.type !== 'submit' &&
      field.type !== 'button'
    ) {
      if (field.type === 'select-multiple') {
        for (var j: number = 0; j < field.options.length; j++) {
          if (field.options[j].selected) {
            formData[field.name] = field.options[j].value;
          }
        }
      } else if ((field.type !== 'checkbox' && field.type !== 'radio') || field.checked) {
        formData[field.name] = field.value.trim().replace(/(\r\n|\n|\r)/gm, '%20');
      }
    }
  }
  return formData;
};
const getElementCoordinates: (element: Element) => ElementCoordinates = element => {
  const rect: DOMRect = element.getBoundingClientRect() as DOMRect;
  const elementCoordinates: ElementCoordinates = {
    top: rect.top + window.scrollY,
    left: rect.left + window.scrollX,
    bottom: rect.top + window.scrollY + rect.height,
    right: rect.left + window.scrollX + rect.width,
  };
  return elementCoordinates;
};
const scrollToElement: (element: Element) => void = element => {
  const coordinates: ElementCoordinates = getElementCoordinates(element) as ElementCoordinates;
  window.scrollTo({
    left: 0,
    behavior: 'smooth',
    top: coordinates.top - 100,
  });
};
const clearErrorState: (element: HTMLElement) => void = element => {
  element.classList.remove('error');
};

const handleShelterManagerModalClose: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const modal: HTMLElement = target.closest('.shelter-manager-modal') as HTMLElement;
  modal.classList.remove('active');
};
const handleShelterManagerOpenImageModal: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const index: string = target.getAttribute('data-index') || '0';
  const parent: HTMLElement = target.closest('.shelter-manager-animal-details') as HTMLElement;
  const modal: HTMLElement = parent.getElementsByClassName('shelter-manager-modal')[0] as HTMLElement;
  const modalImages: HTMLCollectionOf<Element> = modal.getElementsByClassName('image') as HTMLCollectionOf<Element>;
  if (parseInt(index) < 1) {
    console.error('handleShelterManagerOpenImageModal error: index is less than 1');
    return;
  }
  modal.classList.add('active');
  for (let i: number = 0; i < modalImages.length; i++) {
    modalImages[i].classList.add('shelter-manager-hidden');
    if (i + 1 === parseInt(index)) {
      modalImages[i].classList.remove('shelter-manager-hidden');
    }
  }
};
