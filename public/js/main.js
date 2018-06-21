// target elements with the "draggable" class
interact('.draggable')
  .draggable({
    // enable inertial throwing
    inertia: true,
    // keep the element within the area of it's parent
    restrict: {
      restriction: "parent",
      endOnly: true,
      elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
    },
    // enable autoScroll
    autoScroll: true,

    // call this function on every dragmove event
    onmove: dragMoveListener,
    // call this function on every dragend event
    onend: function (event) {
      var textEl = event.target.querySelector('p');
      textEl && (textEl.textContent =
        (Math.sqrt(Math.pow(event.pageX - event.x0, 2) +
        Math.pow(event.pageY - event.y0, 2) | 0))
            .toFixed(2) + 'px');
    }
  });

  function dragMoveListener (event) {
    var target = event.target,
    input = document.querySelector('#width_height'),
    // keep the dragged position in the data-x/data-y attributes
    x = Math.ceil((parseFloat(target.getAttribute('data-x')) || 0) + event.dx),
    y = Math.ceil((parseFloat(target.getAttribute('data-y')) || 0) + event.dy);
    input.setAttribute('value', `${x+15}_${y}`);
    // translate the element
    target.style.webkitTransform =
    target.style.transform =
      'translate(' + x + 'px, ' + y + 'px)';

    // update the posiion attributes
    target.setAttribute('data-x', x);
    target.setAttribute('data-y', y);
  }

  // this is used later in the resizing and gesture demos
  window.dragMoveListener = dragMoveListener;

function updateImageDisplay(select, container) {
  const input = getElementWith(select),
        element = getElementWith(container),
        curFiles = input.files,
        imagePath = compose(getUrl, returnFileSize, validate)(curFiles[0]);
        setAsBackgroundImage(imagePath)(element);
}

function getElementWith(attr){
  return document.querySelector(attr);
}

function setAsBackgroundImage (path) {
  return function (data) {
    data.style.backgroundImage = `url(${path})`;
  }
}

function compose (...functions) {
  return function (data) {
    return functions.reduceRight(function(value, func){
      return func(value)
    }, data)
  }
}

function handleMessage (message) {
  const messages = getElementWith('#messages');
    messages.textContent = message;
}

function getUrl (file) {
  if ((file.size/1048576) > 1) { return }
  return window.URL.createObjectURL(file);
}

function validate(file) {
  const validFileTypes = [
    'image/jpeg',
    'image/pjpeg',
    'image/png',
  ], message = 'File selected is not a valid file type. Choose a .png, .jpeg, .jpg or .pjpeg image.';

  const isValid = validFileTypes.some(function(validFileType){
    return validFileType === file.type;
  });

  if (!isValid) { 
    handleMessage(message); 
    return 
  }
  return file;
}

function returnFileSize(file) {
  let result;
  if(file.size < 1024) {
    result = file.size + 'bytes';
  } else if(file.size >= 1024 && file.size < 1048576) {
    result = (file.size/1024).toFixed(1) + 'KB';
  } else if(file.size >= 1048576) {
    result = (file.size/1048576).toFixed(1) + 'MB';
  }
  let message = (file.size/1048576) > 1 ? 'The file selected is too big for this application. Accepted file must have 490 length x 292 width and at most, 1mb file size.' : `An image, with ${result} file size, selected`;
  handleMessage(message);
  return file;
}
