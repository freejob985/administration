<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تيكست أريا وزر</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/13.0.0/material-components-web.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.2/css/mdb.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #ffffff;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .new-text-area {
      border: 2px solid #2196F3;
      border-radius: 10px;
      padding: 15px;
      margin-top: 20px;
      width: 100%;
      box-sizing: border-box;
      background-color: rgba(33, 33, 33, 0.8);
      display: flex;
      align-items: center;
    }

    .new-text-area textarea {
      width: 100%;
      border: none;
      outline: none;
      background-color: transparent;
      font-size: 20px;
      resize: vertical;
      font-family: 'Roboto', sans-serif;
      color: #ffffff;
      padding: 10px;
      line-height: 1.5;
      font-size: 24px;
      font-family: 'Courier New', Courier, monospace;
    }

    button#copyButton {
      display: none;
    }

    .add-button {
      background-color: #4d4d4d !important;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      font-size: 24px;
      cursor: pointer;
      margin-top: 20px;
      padding: 10px 20px;
      transition: background-color 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      position: fixed;
      bottom: 20px;
      right: 20px;
    }

    .text-area-counter {
      font-size: 28px;
      color: #ffffff;
      margin-right: 10px;
    }

    .add-button {
      background-color: #2196F3;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      font-size: 24px;
      cursor: pointer;
      margin-top: 20px;
      padding: 10px 20px;
      transition: background-color 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      position: fixed;
      bottom: 20px;
      right: 20px;
    }

    .add-button:hover {
      background-color: #0d8aed;
    }

    .delete-button {
      background-color: transparent;
      border: none;
      cursor: pointer;
      margin-left: 10px;
      color: #ffffff;
    }

    .delete-button:hover {
      color: #0d8aed;
    }

    .delete-icon {
      font-size: 30px;
    }

    .copy-button {
      background-color: #2196F3;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      font-size: 24px;
      cursor: pointer;
      margin-top: 20px;
      padding: 15px 30px;
      transition: background-color 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 200px;
    }

    .copy-button:hover {
      background-color: #0d8aed;
    }

    .copy-icon {
      margin-right: 10px;
      font-size: 30px;
      color: #ffffff;
    }

    .btn-group {
      position: fixed;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      background-color: rgba(33, 33, 33, 0.8);
      padding: 10px;
      border-radius: 10px;
    }

    .btn-group .btn {
      margin: 0 5px;
      font-family: "Changa", sans-serif;
    }
  </style>
</head>
<body onclick="handleClick(event)">
  <div id="newTextArea1" class="new-text-area">
    <span class="text-area-counter">1-</span>
    <textarea id="textArea1" class="mdc-text-field__input" rows="20" cols="100" placeholder="أدخل النص هنا..."></textarea>
    <button class="delete-button" onclick="deleteTextArea(this.parentNode)"><i class="material-icons delete-icon">delete</i></button>
  </div>
  <button class="add-button" onclick="createNewTextArea()">+</button>

  <div class="btn-group" role="group" aria-label="مجموعة 2">
    <a href="http://localhost/fr.php" class="btn btn-warning">لانسوري </a>
    <a href="#" class="btn btn-info">زر 6</a>
    <a href="#" class="btn btn-light">زر 7</a>
    <a href="#" class="btn btn-dark">زر 8</a>
    <a href="#" class="btn btn-primary">زر 1</a>
    <a href="#" class="btn btn-secondary">زر 2</a>
  </div>
    <button id="copyButton" class="copy-button" onclick="copyText()"><i class="material-icons copy-icon">content_copy</i>نسخ النص</button>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/13.0.0/material-components-web.min.js"></script>
  <script>
    let textAreaCounter = 1;

    function createNewTextArea() {
      textAreaCounter++;
      const newTextArea = document.createElement('div');
      newTextArea.classList.add('new-text-area');
      newTextArea.innerHTML = `
        <span class="text-area-counter">${textAreaCounter}-</span>
        <textarea id="textArea${textAreaCounter}" class="mdc-text-field__input" rows="20" cols="100" placeholder="أدخل النص هنا..."></textarea>
        <button class="delete-button" onclick="deleteTextArea(this.parentNode)"><i class="material-icons delete-icon">delete</i></button>
      `;
      document.body.insertBefore(newTextArea, document.getElementsByClassName('btn-group')[0]);
      newTextArea.querySelector('textarea').focus(); // Focus on the new textarea
      pasteClipboardText(newTextArea.querySelector('textarea')); // Paste clipboard text if available
    }

    function deleteTextArea(textAreaDiv) {
      textAreaDiv.remove();
    }

function copyText() {
  const textAreas = document.querySelectorAll('.new-text-area textarea');

  // تكوين متغير لتخزين النص المنسوخ
  let copiedText = '';

  textAreas.forEach((textArea, index) => {
    // إضافة النص الحالي إلى المتغير المخصص للنص المنسوخ
    copiedText += `${index + 1}- ${textArea.value}\n\n`; // إضافة فراغ بعد كل جملة

    // لا تقوم بإضافة جملة النهاية هنا، سيتم إضافتها في الخطوة التالية
  });

  // إضافة جملة النهاية في النهاية
  copiedText += "يرجي مرعاة النقاط التالية \n" +
"1- الكود كامل بدون أخطاء\n" +
"2- عدم تغير الهيكل القديم الصحيح\n" +
"3- عدم اعطاء الكود ناقص من الاجزاء القديمة في الكود\n\n";

  // نسخ النص المخزن إلى الحافظة
  navigator.clipboard.writeText(copiedText)
    .then(() => {
      Swal.fire({
        icon: 'success',
        title: 'تم نسخ النص بنجاح!',
        showConfirmButton: false,
        timer: 1500
      });
    })
    .catch((error) => {
      Swal.fire({
        icon: 'error',
        title: 'حدث خطأ!',
        text: 'لا يمكن نسخ النص، يرجى المحاولة مرة أخرى.'
      });
      console.error('Error copying text:', error);
    });
}




    function pasteClipboardText(textarea) {
      navigator.clipboard.readText()
        .then(text => {
          if (text) {
            textarea.value = text;
            textarea.select(); // Select all text after pasting
          }
        })
        .catch(err => {
          console.error('Failed to read clipboard contents: ', err);
        });
    }

    function handleClick(event) {
      if (event.detail === 2) {
        createNewTextArea();
      }
    }

    document.addEventListener('keydown', function(event) {
      if (event.ctrlKey && event.key === 'c') {
        copyText();
      } else if (event.shiftKey) {
        // createNewTextArea();
      } else if (event.ctrlKey && event.key === 'ؤ') {
        copyText();
      }
    });
  </script>
</body>
</html>
