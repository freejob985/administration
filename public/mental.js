  const cardContainer = document.getElementById('card-container');

    const sortable = new Sortable(cardContainer, {
      animation: 150,
      ghostClass: 'ghost',
      dragClass: 'sortable-drag',
      group: 'shared',
    });

    function createCard(className, title, hasBadge = false) {
      const newElement = document.createElement('div');
      newElement.className = 'card ' + className;
      if (hasBadge) {
        newElement.innerHTML = '<h2 class="card-title ' + className + '-title">' + title + '<span class="badge">1</span></h2>';
      } else {
        newElement.innerHTML = '<h2 class="card-title ' + className + '-title">' + title + '</h2>';
      }

      newElement.addEventListener('dblclick', function() {
        this.remove();
      });

      cardContainer.appendChild(newElement);

      // تم استبدال الدالة addDrag بالدالة الصحيحة بإضافة العنصر لمجموعة sortable
      sortable.option("add", newElement);

      // لم يعد هناك حاجة لإنشاء مرة أخرى Sortable بالنسبة لكل بطاقة
    }

    document.querySelector('.home.idea').addEventListener('click', function() {
      Swal.fire({
        title: 'أدخل عنوان الفكرة:',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'تأكيد',
        cancelButtonText: 'إلغاء',
        showLoaderOnConfirm: true,
        preConfirm: (title) => {
          if (!title) {
            Swal.showValidationMessage('الرجاء إدخال عنوان الفكرة');
          }
          return title;
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          createCard('idea-card', result.value, true);
        }
      });
    });

    document.querySelector('.favorite.requirements').addEventListener('click', function() {
      Swal.fire({
        title: 'أدخل عنوان المتطلبات:',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'تأكيد',
        cancelButtonText: 'إلغاء',
        showLoaderOnConfirm: true,
        preConfirm: (title) => {
          if (!title) {
            Swal.showValidationMessage('الرجاء إدخال عنوان المتطلبات');
          }
          return title;
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          createCard('requirements-card', result.value);
        }
      });
    });

    document.querySelector('.shopping_cart.mistakes').addEventListener('click', function() {
      Swal.fire({
        title: 'أدخل عنوان الأخطاء:',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'تأكيد',
        cancelButtonText: 'إلغاء',
        showLoaderOnConfirm: true,
        preConfirm: (title) => {
          if (!title) {
            Swal.showValidationMessage('الرجاء إدخال عنوان الأخطاء');
          }
          return title;
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          createCard('mistakes-card', result.value, true);
        }
      });
    });

    document.querySelector('.settings.number').addEventListener('click', function() {
      Swal.fire({
        title: 'أدخل عنوان الأرقام:',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'تأكيد',
        cancelButtonText: 'إلغاء',
        showLoaderOnConfirm: true,
        preConfirm: (title) => {
          if (!title) {
            Swal.showValidationMessage('الرجاء إدخال عنوان الأرقام');
          }
          return title;
        },
        allowOutsideClick: () => !Swal.isLoading
      }).then((result) => {
        if (result.isConfirmed) {
          createCard('number-card', result.value);
        }
      });
    });
