type ApiResponse = {
  error: boolean;
  message: string;
  data: any;
};
type Filter = [string, string];

const getShelterManagerAnimalJsonById: (id: string, type: string, callback: Function, error: Function) => void = (
  id,
  type,
  callback,
  error,
) => {
  const response: ApiResponse = {
    error: true,
    message: '',
    data: null,
  };
  if (!id) {
    response.error = true;
    response.message = 'No id provided';
    return response;
  }
  if (!type) {
    type = 'adoptable';
  }
  if (!callback) {
    callback = (response: any) => response;
  }
  if (!error) {
    error = (response: any) => response;
  }
  //@ts-ignore
  $.ajax({
    //@ts-ignore
    url: shelterManagerAjax.shelterManagerAjaxUri,
    type: 'POST',
    data: {
      action: GLOBAL_shelterManagerGetAnimalJsonByIdAjaxFunctionName,
      id: id,
      type: type,
    },
    success: (apiResponse: string) => {
      const parsedResponse: ApiResponse = JSON.parse(apiResponse);
      if (!parsedResponse.data) {
        response.error = true;
        response.message = 'Error retrieving animal';
        error(response);
      } else {
        response.error = false;
        response.message = 'Animal retrieved';
        response.data = JSON.parse(parsedResponse.data);
        callback(response);
      }
    },
    error: () => {
      response.error = true;
      response.message = 'Error retrieving animal';
      error(response);
    },
  });
};
const getShelterManagerAnimalsJsonByType: (
  type: string,
  limit: number,
  filter: Filter,
  callback: Function,
  error: Function,
) => void = (type, limit, filter, callback, error) => {
  const response: ApiResponse = {
    error: true,
    message: '',
    data: null,
  };
  if (!type) {
    type = 'adoptable';
  }
  if (!limit) {
    limit = -1;
  }
  if (!filter) {
    filter = ['all', 'all'];
  }
  if (!callback) {
    callback = (response: any) => response;
  }
  if (!error) {
    error = (response: any) => response;
  }
  //@ts-ignore
  $.ajax({
    //@ts-ignore
    url: shelterManagerAjax.shelterManagerAjaxUri,
    type: 'POST',
    data: {
      action: GLOBAL_shelterManagerGetAnimalJsonByTypeAjaxFunctionName,
      type: type,
      limit: limit,
      filter: filter,
    },
    success: (apiResponse: string) => {
      const parsedResponse: ApiResponse = JSON.parse(apiResponse);
      if (!parsedResponse.data) {
        response.error = true;
        response.message = 'Error retrieving animals';
        error(response);
      } else {
        response.error = false;
        response.message = 'Animals retrieved';
        response.data = JSON.parse(parsedResponse.data);
        callback(response);
      }
    },
    error: () => {
      response.error = true;
      response.message = 'Error retrieving animals';
      error(response);
    },
  });
};
const getShelterManagerAnimalImageById: (id: string, image_id: number, callback: Function, error: Function) => void = (
  id,
  image_id,
  callback,
  error,
) => {
  const response: ApiResponse = {
    error: true,
    message: '',
    data: null,
  };
  if (!id) {
    response.error = true;
    response.message = 'No id provided';
    return response;
  }
  if (!image_id) {
    image_id = 1;
  }
  if (!callback) {
    callback = (response: any) => response;
  }
  if (!error) {
    error = (response: any) => response;
  }
  //@ts-ignore
  $.ajax({
    //@ts-ignore
    url: shelterManagerAjax.shelterManagerAjaxUri,
    type: 'POST',
    data: {
      action: GLOBAL_shelterManagerGetAnimalImageByIdAjaxFunctionName,
      id: id,
      image_id: image_id,
    },
    success: (apiResponse: string) => {
      if (!apiResponse) {
        response.error = true;
        response.message = 'Error retrieving image';
        error(response);
      } else {
        response.error = false;
        response.message = 'Image retrieved';
        response.data = apiResponse;
        callback(response);
      }
    },
    error: () => {
      response.error = true;
      response.message = 'Error retrieving image';
      error(response);
    },
  });

  return response;
};
const getShelterManagerAnimalAdoptionFormSubmissionResponse: (
  formId: string,
  callback: Function,
  error: Function,
) => void = (formId, callback, error) => {
  const form: HTMLFormElement = document.getElementById(formId) as HTMLFormElement;
  const response: ApiResponse = {
    error: true,
    message: '',
    data: null,
  };
  if (!form) {
    response.error = true;
    response.message = 'No form found';
    return response;
  }
  if (!callback) {
    callback = (response: any) => response;
  }
  if (!error) {
    error = (response: any) => response;
  }
  form.classList.add('loading');
  const formData: FormData = new FormData();
  const inputs: any = serializeArray(form);
  // const signatureInput: any = document.getElementById('signature');

  // if (signatureInput) {
  //   const file: any = signatureInput.files[0];

  //   formData.append('signature', file);
  // }
  formData.append('action', GLOBAL_shelterManagerAdoptionFormAjaxFunctionName);
  formData.append('data', JSON.stringify(inputs));
  //@ts-ignore
  $.ajax({
    //@ts-ignore
    url: shelterManagerAjax.shelterManagerAjaxUri,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: (apiResponse: string) => {
      const parsedResponse: ApiResponse = JSON.parse(apiResponse);
      if (!parsedResponse.data) {
        response.error = true;
        response.message = 'Error retrieving adoption form submission response';
        form.classList.remove('loading');
        form.classList.add('error');
        error(response);
      } else {
        response.error = false;
        response.message = 'Animal retrieved';
        response.data = JSON.parse(parsedResponse.data);
        form.classList.remove('loading');
        form.classList.add('success');
        callback(response);
      }
    },
    error: () => {
      response.error = true;
      response.message = 'Error retrieving adoption form submission response';
      form.classList.remove('loading');
      form.classList.add('error');
      error(response);
    },
  });
};
