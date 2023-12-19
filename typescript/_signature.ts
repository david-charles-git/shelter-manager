const handleShelterManagerSignatureInputMouseDown: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const parent: HTMLElement = target.closest('.input-signature') as HTMLElement;
  //@ts-ignore
  var offsetX: any = event.offsetX || 0;
  //@ts-ignore
  var offsetY: any = event.offsetY || 0;
  parent.setAttribute('data-drawing', 'true');
  parent.setAttribute('data-last_x', offsetX.toString());
  parent.setAttribute('data-last_y', offsetY.toString());
};
const handleShelterManagerSignatureInputMouseUp: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const parent: HTMLElement = target.closest('.input-signature') as HTMLElement;
  const canvas: HTMLCanvasElement = parent.getElementsByTagName('canvas')[0] as HTMLCanvasElement;
  const input: HTMLInputElement = parent.getElementsByTagName('input')[0] as HTMLInputElement;
  const imageURL: string = canvas.toDataURL('image/png');
  const fileList: DataTransfer = new DataTransfer();
  const blob: Blob = handleShelterManagerSignatureDataURItoBlob(imageURL);
  const file: File = new File([blob], 'signature.png', { type: 'image/png' });
  fileList.items.add(file);
  input.files = fileList.files;
  parent.setAttribute('data-drawing', 'false');
};
const handleShelterManagerSignatureDataURItoBlob: (dataURI: string) => Blob = dataURI => {
  const byteString: string = atob(dataURI.split(',')[1]);
  const mimeString: any = dataURI.split(',')[0].split(':')[1].split(';')[0];
  const arrayBuffer: ArrayBuffer = new ArrayBuffer(byteString.length);
  const unitArray: Uint8Array = new Uint8Array(arrayBuffer);
  for (let i: number = 0; i < byteString.length; i++) {
    unitArray[i] = byteString.charCodeAt(i);
  }
  return new Blob([arrayBuffer], { type: mimeString });
};
const handleShelterManagerSignatureInputMouseOut: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const parent: HTMLElement = target.closest('.input-signature') as HTMLElement;
  parent.setAttribute('data-drawing', 'false');
};
const handleShelterManagerSignatureInputDraw: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const parent: HTMLElement = target.closest('.input-signature') as HTMLElement;
  const isDrawing: string = parent.getAttribute('data-drawing') || '';
  const canvas = parent.getElementsByTagName('canvas')[0];
  //@ts-ignore
  const offsetX: any = event.offsetX;
  //@ts-ignore
  const offsetY: any = event.offsetY;
  const context: CanvasRenderingContext2D = canvas.getContext('2d') as CanvasRenderingContext2D;
  var lastX: string | number = parent.getAttribute('data-last_x') || '0';
  var lastY: string | number = parent.getAttribute('data-last_y') || '0';
  if ((!offsetX && offsetX !== 0) || (!offsetY && offsetY !== 0) || isDrawing !== 'true') {
    return;
  }
  lastX = parseInt(lastX);
  lastY = parseInt(lastY);
  context.strokeStyle = '#000000';
  context.lineWidth = 2;
  context.beginPath();
  context.moveTo(lastX, lastY);
  //@ts-ignore
  context.lineTo(event.offsetX, event.offsetY);
  context.stroke();
  //@ts-ignore
  [lastX, lastY] = [event.offsetX, event.offsetY];
  parent.setAttribute('data-last_x', lastX.toString());
  parent.setAttribute('data-last_y', lastY.toString());
};
const handleShelterManagerSignatureInputClear: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const parent: HTMLElement = target.closest('.input-signature') as HTMLElement;
  const canvas: HTMLCanvasElement = parent.getElementsByTagName('canvas')[0] as HTMLCanvasElement;
  const context: CanvasRenderingContext2D = canvas.getContext('2d') as CanvasRenderingContext2D;
  const input: HTMLInputElement = parent.getElementsByTagName('input')[0] as HTMLInputElement;
  context.clearRect(0, 0, canvas.width, canvas.height);
  input.value = '';
};
